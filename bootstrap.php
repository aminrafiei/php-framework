<?php

use App\Services\NewTestService;
use App\Services\testInterface;
use Core\Cache\Cache;
use Core\Cache\Redis\RedisDriver;
use Core\Kernel\Middleware\Rules\Auth;
use Core\Kernel\Middleware\Rules\Trim;

/**
 * Class bootstrap
 */
class bootstrap
{
    /**
     * @var array
     */
    public static $binds = [];

    /**
     * @var array
     */
    public static $registers = [
        Cache::class => RedisDriver::class,
    ];

    /**
     * apply this middlewares for all routes
     *
     * @var array
     */
    public static $routeMiddlewares = [
        'trim',
    ];

    /**
     * register middlewares
     *
     * @var array
     */
    public static $middlewares = [
        'trim' => Trim::class,
        'auth' => Auth::class,
    ];
}