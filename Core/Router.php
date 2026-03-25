<?php

declare(strict_types=1);

namespace Core;

use Exception;
use ReflectionException;

/**
 * Class Router
 * High-performance regex compiling router mimicking fastest frameworks
 */
class Router
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected static array $staticRoutes = [
        'GET' => [], 'POST' => [], 'DELETE' => [], 'PUT' => [], 'PATCH' => []
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected static array $dynamicRoutes = [
        'GET' => [], 'POST' => [], 'DELETE' => [], 'PUT' => [], 'PATCH' => []
    ];

    /**
     * @return Router
     */
    public static function make(): Router
    {
        return new Router();
    }

    /**
     * @param string $method
     * @param string $uri
     * @param mixed $path
     */
    private function addRoute(string $method, string $uri, mixed $path): void
    {
        // If route has no variables, use blazing fast O(1) static lookup
        if (strpos($uri, '{') === false) {
            self::$staticRoutes[$method][$uri] = $path;
        } else {
            // Compile parameters like {id} to named capture groups (?P<id>[^/]+)
            $regex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[^/]+)', $uri);
            $regex = '#^' . $regex . '$#';
            self::$dynamicRoutes[$method][$regex] = $path;
        }
    }

    /**
     * @param string $uri
     * @param mixed $path
     * @return self
     */
    public function post(string $uri, mixed $path): self
    {
        $this->addRoute('POST', $uri, $path);
        return $this;
    }

    /**
     * @param string $uri
     * @param mixed $path
     * @return self
     */
    public function get(string $uri, mixed $path): self
    {
        $this->addRoute('GET', $uri, $path);
        return $this;
    }

    /**
     * @param string $uri
     * @param mixed $path
     * @return self
     */
    public function delete(string $uri, mixed $path): self
    {
        $this->addRoute('DELETE', $uri, $path);
        return $this;
    }

    public function middleware()
    {
        // Can build middleware pipelines here later
    }

    /**
     * @param string $uri
     * @param string $method
     * @return mixed
     * @throws Exception
     */
    public static function redirect(string $uri, string $method): mixed
    {
        $method = strtoupper($method);

        if (isset(self::$staticRoutes[$method][$uri])) {
            return self::handleRedirect(self::$staticRoutes[$method][$uri], []);
        }

        // 2. Fallback to Regex execution for parameterized routes
        if (!empty(self::$dynamicRoutes[$method])) {
            foreach (self::$dynamicRoutes[$method] as $regex => $action) {
                if (preg_match($regex, $uri, $matches)) {
                    // Extract only the string keys (named groups)
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    return self::handleRedirect($action, $params);
                }
            }
        }

        throw new Exception("404 - Request route or method not found for URI: $uri");
    }

    /**
     * @param mixed $action
     * @param array<string, mixed> $params
     * @return mixed
     * @throws Exception
     */
    private static function handleRedirect(mixed $action, array $params): mixed
    {
        if (!is_callable($action)) {
            $parts = explode('@', $action);
            return self::doAction($parts[0], $parts[1] ?? 'index', $params);
        }

        // Call closures directly
        $do = call_user_func_array($action, array_values($params));
        return is_string($do) ? var_dump($do) : $do;
    }

    /**
     * @param string $controller
     * @param string $action
     * @param array<string, mixed> $params
     * @return mixed
     * @throws Exception
     */
    private static function doAction(string $controller, string $action, array $params): mixed
    {
        $controllerClass = "App\\Controller\\" . $controller;
        if (!class_exists($controllerClass)) {
            $controllerClass = "App\\Controllers\\" . $controller;
        }

        try {
            app()->checkMiddleware($controllerClass);
            app()->resolveDependency($controllerClass);
        } catch (ReflectionException $e) {
            throw new Exception("Reflection Error: " . $e->getMessage(), 0, $e);
        }

        if (!method_exists($controllerClass, $action)) {
            throw new Exception("Method $action does not exist on controller $controllerClass");
        }

        /** @var object $controllerClass */
        return call_user_func_array([$controllerClass, $action], array_values($params));
    }
}
