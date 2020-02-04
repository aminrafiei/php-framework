<?php

namespace Core\Kernel\Middleware\Rules;

use Core\Kernel\Middleware\Exceptions\AuthException;
use Core\Kernel\Middleware\MiddlewareContract;

/**
 * Class Trim
 * @package Core\Kernel\Middleware
 */
class Auth implements MiddlewareContract
{
    /**
     * @param array|null $params
     * @return bool
     * @throws \Exception
     */
    public static function handle(array $params = null): bool
    {
        if (is_null(session()->getUser())) {
           throw new AuthException();
        };

        return true;
    }
}