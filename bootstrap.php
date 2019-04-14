<?php

use App\Services\NewTestService;
use App\Services\testInterface;
use Core\Cache\Cache;
use Core\Cache\Redis\RedisDriver;

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
        testInterface::class => NewTestService::class,
    ];
}