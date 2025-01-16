<?php

namespace SecurityTools\LaravelAccess\Services;

use Illuminate\Support\Facades\RateLimiter;
use SecurityTools\LaravelAccess\Adapters\AccessSessionAdapter;
use SecurityTools\LaravelAccess\Mail\SendCodeMail;
use SecurityTools\LaravelAccess\Traits\NonceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class AccessService
{
    use NonceTrait;

    /**
     * Model check user
     */
    private $model;

    /**
     * Field email
     */
    private string $email;

    /**
     * Field id
     */
    private mixed $id;

    /**
     * Expiration time code
     */
    private int $expires;

    /**
     * Redirect prefix
     */
    private string $redirectPrefix;

    /**
     * Enable
     */
    private bool $enable;

    /**
     * Block prefixes
     */
    private array $blockPrefixes;

    /**
     * Prefix access
     */
    private string $prefixAccess = '/access';

    /**
     * excludePrefixes
     */
    private array $excludePrefixes;

    /**
     * Default error message
     */
    private string $errorMessage;

    private string $maxAttempts;

    public function __construct(protected readonly AccessSessionAdapter $accessSessionAdapter)
    {
        $this->setConfigs();
    }

    /**
     * Set Configs
     */
    public function setConfigs(): void
    {
        $this->model = config('access.auth.user.model');
        $this->email = config('access.auth.user.email');
        $this->id = config('access.auth.user.id');
        $this->expires = config('access.auth.code.expires');
        $this->errorMessage = config('access.messages.invalid_code');
        $this->redirectPrefix = config('access.redirect_prefix');
        $this->enable = config('access.enable');
        $this->blockPrefixes = config('access.block_prefixes');
        $this->excludePrefixes = config('access.exclude_prefixes');
        $this->maxAttempts = config('access.rate_limit.max_attempts');
    }

    /**
     * Block access
     */
    public function isBlocked(Request $request): bool
    {
        $isAuthenticated = $this->accessSessionAdapter->isAuthenticated();
        $isBlockEnv = in_array(config('app.env'), config('access.block_env'));
        $isBlockPrefix = $this->isBlockedByPrefix($request);

        if (!$this->enable) {
            return false;
        }

        if (($isBlockPrefix && $isBlockEnv) && !$isAuthenticated) {
            return true;
        }

        return false;
    }

    /**
     * Is blocked by prefix
     */
    private function isBlockedByPrefix(Request $request): bool
    {
        $prefix = $this->getPrefix($request);

        if(in_array($prefix, $this->excludePrefixes)) {
            return false;
        }

        if (empty($this->blockPrefixes) && $prefix !== $this->prefixAccess) {
            return true;
        }

        return in_array($prefix, $this->blockPrefixes);
    }

    /**
     * Get prefix from session
     * @throws \Exception
     */
    public function getRedirectPrefix(): ?string
    {
        if ($this->enable && !$this->redirectPrefix) {
            throw new \Exception('Redirect prefix not found');
        }

        return $this->redirectPrefix;
    }

    /**
     * Generate auth
     * @throws \Exception
     */
    public function generateAuth(string $email): array
    {
        $formId = "form_send_code_" . time();

        $this->checkRateLimit();

        try {
            $user = $this->getUser($email);

            $expires = $user ? $this->expires : 0;

            $nonce = $this->generateNonce($formId, 25, $expires);

            if (!$user) {
                return [
                    $formId,
                    $nonce
                ];
            }

            $code = $this->generateAccessCode();

            $this->sendCodeByEmail($email, $code);

            $key = $this->getKeyAuthCache($formId, $nonce);

            Cache::put($key, md5($code), $expires);

            $this->accessSessionAdapter->createAccessSession($user->{$this->id}, $nonce);

            return [
                $formId,
                $nonce
            ];
        }catch (\Exception $e) {
            \Log::error('Error generate auth', [
                'message' => $e->getMessage()
            ]);
        }

        return [
            $formId,
            $this->generateNonce($formId, 25, 0)
        ];
    }

    /**
     * Get key auth cache
     */
    public function getKeyAuthCache(string $formId, string $nonce): string
    {
        return 'access:' . md5("{$formId}_{$nonce}");
    }

    /**
     * Get prefix
     */
    public function getPrefix(Request $request): string
    {
        return $request->route()?->getPrefix() ?? '/' . explode('/', $request->path())[0];
    }

    /**
     * Validate access code
     * @throws \Exception
     */
    public function validate(array $inputs): void
    {
        $nonce = $inputs['nonce'];
        $formId = $inputs['form_id'];
        $code = md5($inputs['code']);

        try {
            if (!$this->verifyNonce($nonce, $formId)) {
                throw new \Exception('Invalid nonce');
            }

            if ($code !== $this->getAccessCode($formId, $nonce)) {
                throw new \Exception('Invalid code');
            }

            $this->accessSessionAdapter->setAccess($this->expires, $nonce, $this->model, $this->id);
        } catch (\Exception $e) {
            \Log::error('Error validate code', [
                'message' => $e->getMessage()
            ]);
            $this->logout($nonce);
            throw new \Exception($this->errorMessage);
        }
    }

    /**
     * Get user
     * @throws \Exception
     */
    public function getUser(string $email): mixed
    {
        $user = $this->model::where($this->email, $email)->first();

        if (!$user) {
            throw new \Exception('User not found');
        }

        return $user;
    }

    /**
     * Get access code
     */
    private function getAccessCode(string $id, string $nonce): ?string
    {
        $key = $this->getKeyAuthCache($id, $nonce);

        if (Cache::has($key)) {
            return Cache::get($key);
        }

        return null;
    }

    /**
     * Generate access code
     */
    private function generateAccessCode(): int
    {
        return rand(100000, 999999);
    }

    /**
     * Private rate limit
     * @throws \Exception
     */
    private function checkRateLimit(): void {
        $ip = request()->ip();
        $key = 'access_rate_limit_' . $ip;
        $decay = config('access.rate_limit.decay');

        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            throw new \Exception(config('access.messages.too_many_requests'));
        }

        RateLimiter::increment($key, $decay);
    }

    /**
     * Logout
     */
    public function logout($nonce): void
    {
        $this->accessSessionAdapter->logout($nonce);
    }

    /**
     * Send code by email
     */
    public function sendCodeByEmail(string $email, string $code): void
    {
        Mail::to($email)
            ->send(new SendCodeMail($code));
    }
}
