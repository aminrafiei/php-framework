<?php

namespace Core\Kernel\Middleware;

interface MiddlewareContract
{
    public static function handle(array $params = null): bool;

    public static function message(): string;
}