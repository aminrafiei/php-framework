<?php

declare(strict_types=1);

namespace app;

use Core\Cache\Cache;
use Core\Cache\Redis\RedisDriver;
use Core\Kernel\Middleware\Rules\Auth;
use Core\Kernel\Middleware\Rules\Trim;

/**
 * Class bootstrap
 */
class Bootstrap
{
    /**
     * @var array<mixed>
     */
    public static array $binds = [];

    /**
     * @var array<string, string>
     */
    public static array $registers = [
        Cache::class => RedisDriver::class,
    ];

    /**
     * Apply these middlewares for all routes
     *
     * @var array<string>
     */
    public static array $routeMiddlewares = [
        'trim',
    ];

    /**
     * Register middlewares
     *
     * @var array<string, string>
     */
    public static array $middlewares = [
        'trim' => Trim::class,
        'auth' => Auth::class,
    ];
}
