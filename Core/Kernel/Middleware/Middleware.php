<?php

namespace Core\Kernel\Middleware;

use bootstrap;
use Core\Kernel\Request;

/**
 * Class Middleware
 */
class Middleware
{
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
        $this->middlewares = array_merge(bootstrap::$middlewares, $this->middlewares);
    }

    /**
     * @param Request|null $request
     */
    public function handleRequest(Request $request = null)
    {
        $this->request = $request ?? request();

        foreach ($this->middlewares as $name => $middleware) {
            $params = $this->getParams(explode(':', $name));

            if ($middleware::handle($params) != true) {
                break;
            }
        }
    }

    /**
     * @throws \Exception
     */
    protected function handleException()
    {
        throw new \Exception();
    }

    /**
     * @param array $params
     * @return mixed|null
     */
    private function getParams(array $params)
    {
        if (count($params) == 1) {
            return null;
        }
        array_pop($params);

        return $params;
    }
}