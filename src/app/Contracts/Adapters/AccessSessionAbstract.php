<?php

namespace SecurityTools\LaravelAccess\Contracts\Adapters;

abstract class AccessSessionAbstract
{
    /**
     * Cookie name
     */
    const COOKIE_NAME = '_ac_ck';

    /**
    * Expiration time session
    */
    protected ?int $sessionExpires;

    public function __construct()
    {
        $this->sessionExpires = config('access.auth.session.expires');
    }

    abstract function setAccess($sessionExpires, $nonce, $model, $id): void;

    abstract function isAuthenticated(): bool;

    abstract function logout($nonce = null): void;

    /**
     * Get expires
     */
    protected function getExpires(): int {
        return time() + $this->sessionExpires;
    }
}
