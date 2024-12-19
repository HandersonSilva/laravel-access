<?php

namespace SecurityTools\LaravelAccess\Traits;

use Exception;

trait CryptoTrait
{
    /**
     * @var string
     */
    private string $key = '';

    /**
     * @var string
     */
    private string $hmacKey = '';

    /**
     * Algorithm
     */
    private string $encryptAlgo = 'aes-256-cbc';

    /**
     * HMAC Algorithm
     */
    private string $hmacAlgo = 'sha256';


    public function __construct()
    {
        $this->key = $this->getEncryptKey();
        $this->hmacKey = $this->getHmacKey();
    }

    /**
     * Get Key
     */
    private function getEncryptKey(): string {
        $appKey = config('app.key');
        $key = explode(':', $appKey);

        if(isset($key[1])) {
            return $key[1];
        }

        return $appKey ?? $this->getHmacKey();
    }

    /**
     * Get HMAC Key
     */
    private function getHmacKey(): ?string {
        return config('access.secret');
    }

    /**
     * @throws RandomException
     */
    public function encrypt($content, bool $compress = false): string
    {
        $iv = random_bytes(openssl_cipher_iv_length($this->encryptAlgo));
        if ($compress) {
            $content = gzcompress($content);
        }

        $encryptedData = openssl_encrypt($content, $this->encryptAlgo, $this->key, 0, $iv);
        $hmac = hash_hmac($this->hmacAlgo, $encryptedData, $this->hmacKey);

        return base64_encode($iv . $hmac . $encryptedData);
    }

    /**
     * @throws Exception
     */
    public function decrypt($content, bool $compress = false): false|string
    {
        $content = base64_decode($content);
        $ivLength = openssl_cipher_iv_length($this->encryptAlgo);
        $iv = substr($content, 0, $ivLength);
        $hmac = substr($content, $ivLength, 64);
        $encryptedData = substr($content, $ivLength + 64);
        $calculatedHmac = hash_hmac($this->hmacAlgo, $encryptedData, $this->hmacKey);

        if (!hash_equals($hmac, $calculatedHmac)) {
            return false;
        }

        $decryptedData = openssl_decrypt($encryptedData, $this->encryptAlgo, $this->key, 0, $iv);

        return $compress ? gzuncompress($decryptedData) : $decryptedData;
    }
}
