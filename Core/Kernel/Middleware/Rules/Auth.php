<?php

namespace Core\Kernel\Middleware\Rules;

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
     */
    public static function handle(array $params = null): bool
    {
        if (is_null(session()->getUser())) {
            return false;
        };

        return true;
    }

    /**
     * @return string
     */
    public static function message(): string
    {
        return 'unauthorized';
    }
}