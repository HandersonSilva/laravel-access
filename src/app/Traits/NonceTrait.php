<?php

namespace SecurityTools\LaravelAccess\Traits;

use Illuminate\Support\Facades\Session;

trait NonceTrait
{
    /**
     * Get nonce secrete
     */
    private function getNonceSecret(): mixed
    {
        return config('access.secret');
    }

    /**
     * @param string $form_id
     * @param string $nonce
     * @return bool
     */
    private function storeNonce(string $form_id, string $nonce): bool
    {
        Session::put($form_id, $nonce);

        return true;
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateSalt(int $length = 10): string
    {
        $chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $char_len = strlen($chars) - 1;
        $output = '';

        while (strlen($output) < $length) {
            $output .= $chars[rand(0, $char_len)];
        }

        return $output;
    }


    /**
     * @param string $keyId
     * @param int $length
     * @param int $expiry_time in minutes
     * @return string
     */
    public function generateNonce(string $keyId, int $length = 25, int $expiry_time = 60): string
    {
        $secret = $this->getNonceSecret();
        $salt = self::generateSalt($length);
        $time = time() + (60 * ($expiry_time));
        $toHash = $secret . $salt . $time;
        $nonce = $salt . ':' . $keyId . ':' . $time . ':' . hash('sha256', $toHash);

        self::storeNonce($keyId, $nonce);

        return md5($nonce);
    }

    /**
     * @param $nonce
     * @param $keyId
     * @return bool
     */
    public function verifyNonce($nonce, $keyId): bool
    {
        $nonceSession = Session::get($keyId);
        $secret = $this->getNonceSecret();

        $split = explode(':', $nonceSession);
        if (count($split) !== 4) {
            return false;
        }

        $salt = $split[0];
        $time = intval($split[2]);
        $oldHash = $split[3];

        if (time() > $time) {
            return false;
        }

        if (md5($nonceSession) !== $nonce) {
            return false;
        }

        $toHash = $secret . $salt . $time;
        $reHashed = hash('sha256', $toHash);

        if ($reHashed !== $oldHash) {
            return false;
        }

        Session::forget($keyId);

        return true;
    }
}
