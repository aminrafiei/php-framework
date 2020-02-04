<?php

namespace Core\Kernel\Middleware;

use bootstrap;
use Core\Kernel\Middleware\Exceptions\AuthException;
use Core\Kernel\Request;

/**
 * Class Middleware
 */
class Middleware
{
    /**
     * @var Middleware|null
     */
    private static $instance = null;

    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @var
     */
    protected $request;

    /**
     * Middleware constructor.
     */
    public function __construct()
    {
        $this->middlewares = array_merge(bootstrap::$routeMiddlewares, $this->middlewares);
    }

    /**
     * @return Middleware|null
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Middleware();
        }

        return self::$instance;
    }

    /**
     * @param null $middlewares
     * @param Request|null $request
     * @throws \Exception
     */
    public function handleRequest($middlewares = null, Request $request = null)
    {
        $this->request = $request ?? request();
        $middlewares = $middlewares ?? $this->middlewares;

        foreach ($middlewares as $middleware) {
            $middlewareClass = $this->checkAndGetMiddleware($middleware);

            try {
                $middlewareClass::handle(array_values($middleware));
            } catch (AuthException $exception) {
                dd($exception->getMessage());
            }
        }
    }

    /**
     * @param $msg
     * @throws \Exception
     */
    protected function handleException($msg)
    {
        throw new \Exception($msg);
    }

    /**
     * @param $middleware
     * @return
     * @throws \Exception
     */
    private function checkAndGetMiddleware($middleware)
    {
        $middleware = is_string($middleware) ? $middleware : array_values($middleware)[0];

        if (!array_key_exists($middleware, bootstrap::$middlewares)) {
            $this->handleException('middleware not found!2');
        }

        return bootstrap::$middlewares[$middleware];
    }
}