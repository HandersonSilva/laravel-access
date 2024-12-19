<?php

namespace SecurityTools\LaravelAccess\Adapters;

use SecurityTools\LaravelAccess\Contracts\Adapters\AccessSessionAbstract;
use SecurityTools\LaravelAccess\Models\AccessSessionModel;
use SecurityTools\LaravelAccess\Traits\CryptoTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class AccessSessionAdapter extends AccessSessionAbstract
{
    use CryptoTrait;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create access session
     * @return void
     */
    public function createAccessSession($userId, $nonce): void
    {
        AccessSessionModel::updateOrCreate(
            [
                'user_id' => $userId,
            ],
            [
                'user_id' => $userId,
                'nonce' => $nonce,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function setAccess($sessionExpires, $nonce, $model, $id): void
    {
        $accessSession = AccessSessionModel::where(
            [
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'nonce' => $nonce,
            ],
        )->first();

        if (!$accessSession) {
            throw new \Exception('Access session not found');
        }

        $accessSession->last_activity = time();
        $accessSession->expires_at = now()->addSeconds($sessionExpires);
        $accessSession->access_cookie = Str::uuid()->toString();
        $accessSession->save();

        $encryptCookie = $this->encrypt($accessSession->access_cookie);

        setcookie(self::COOKIE_NAME, $encryptCookie, $this->getExpires(), '/');

        $cookieKey = $this->getKey($accessSession->access_cookie);

        Cache::put(self::COOKIE_NAME . ":{$cookieKey}", $encryptCookie, $sessionExpires);

        $this->loginGuard($accessSession, $model, $id);
    }

    /**
     * Get key
     */
    private function getKey(?string $content): string
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();

        return md5($ip . $userAgent . $content);
    }

    /**
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        try {
            if (!Cookie::has(self::COOKIE_NAME)) {
                return false;
            }

            $encryptCookie = Cookie::get(self::COOKIE_NAME);
            $cookieValue = $this->decrypt($encryptCookie);

            $cookieKey = self::COOKIE_NAME . ":" . $this->getKey($cookieValue);

            if (!Cache::has($cookieKey)) {
                return false;
            }

            $cacheValue = $this->decrypt(Cache::get($cookieKey));

            return $cacheValue === $cookieValue;

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Login guard
     * @throws \Exception
     */
    private function loginGuard($accessSession, $model, $id): void {
        $autoLogin = config('access.auth.auto_login');
        $guard = config('access.auth.guard');

        if (!$autoLogin) {
            return;
        }

        if(!$guard) {
            throw new \Exception('Guard not configured');
        }

        $user = $model::where($id, $accessSession->user_id)->first();

        auth()->guard($guard)->login($user);
    }

    /**
     * @return void
     */
    public function logout($nonce = null): void
    {
        if (Cookie::has(self::COOKIE_NAME)) {
            $cookieValue = Cookie::get(self::COOKIE_NAME);
            $cookieKey = self::COOKIE_NAME . ":" . $this->getKey($cookieValue);

            Cache::forget($cookieKey);
            Cookie::queue(Cookie::forget(self::COOKIE_NAME));
        }

        if ($nonce) {
            AccessSessionModel::where('nonce', $nonce)->delete();
        }
    }
}
