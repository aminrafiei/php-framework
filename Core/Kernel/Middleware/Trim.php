<?php

namespace Core\Kernel\Middleware;

/**
 * Class Trim
 * @package Core\Kernel\Middleware
 */
class Trim implements MiddlewareContract
{
    /**
     * @param array|null $params
     * @return bool
     */
    public static function handle(array $params = null): bool
    {
        foreach (request()->get() as $key => $value) {
            $_REQUEST[$key] = trim($value);
        }

        return true;
    }
}