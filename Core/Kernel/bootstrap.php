<?php

namespace Core\Kernel;

use App\Services\NewTestService;
use App\Services\testInterface;
use Core\Cache\Cache;
use Core\Cache\Redis\RedisDriver;

class bootstrap
{
    public static $binds = [];
    //TODO : fix cache interface
    public static $registers = [
        Cache::class => RedisDriver::class,
        testInterface::class => NewTestService::class,
    ];
}