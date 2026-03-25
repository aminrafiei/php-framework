<?php

declare(strict_types=1);

namespace Core\Kernel\Middleware;

use app\Bootstrap;
use Core\Kernel\Middleware\Exceptions\AuthException;
use Core\Kernel\Request;
use Exception;

/**
 * Class Middleware
 */
class Middleware
{
    /**
     * @var Middleware|null
     */
    private static ?Middleware $instance = null;

    /**
     * @var array<mixed>
     */
    protected array $middlewares = [];

    /**
     * @var Request|null
     */
    protected ?Request $request = null;

    /**
     * Middleware constructor.
     */
    public function __construct()
    {
        $this->middlewares = array_merge(Bootstrap::$routeMiddlewares, $this->middlewares);
    }

    /**
     * @return Middleware
     */
    public static function getInstance(): Middleware
    {
        if (self::$instance === null) {
            self::$instance = new Middleware();
        }

        return self::$instance;
    }

    /**
     * @param array<mixed>|null $middlewares
     * @param Request|null $request
     * @throws Exception
     */
    public function handleRequest(?array $middlewares = null, ?Request $request = null): void
    {
        $this->request = $request ?? request();
        $middlewaresToRun = $middlewares ?? $this->middlewares;

        foreach ($middlewaresToRun as $middleware) {
            $middlewareClass = $this->checkAndGetMiddleware($middleware);

            try {
                if (method_exists($middlewareClass, 'handle')) {
                    $middlewareClass::handle(is_array($middleware) ? array_values($middleware) : [$middleware]);
                }
            } catch (AuthException $exception) {
                throw new Exception($exception->getMessage(), 0, $exception);
            }
        }
    }

    /**
     * @param string $msg
     * @throws Exception
     */
    protected function handleException(string $msg): void
    {
        throw new Exception($msg);
    }

    /**
     * @param mixed $middleware
     * @return string
     * @throws Exception
     */
    private function checkAndGetMiddleware($middleware): string
    {
        $middlewareName = is_string($middleware) ? $middleware : array_values($middleware)[0];

        if (!array_key_exists($middlewareName, Bootstrap::$middlewares)) {
            $this->handleException('Middleware not found!');
        }

        return Bootstrap::$middlewares[$middlewareName];
    }
}
