<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 2:38 PM
 */

namespace Core;

use Exception;
use ReflectionException;

/**
 * Class Router
 * @package Core
 */
class Router
{
    /**
     * @var array
     */
    protected static $route = [
        'GET' => [],
        'POST' => [],
        'DELETE' => [],
    ];

    public static function make()
    {
        return new Router();
    }

    /**
     * @var array
     */
    protected static $names = [];

    /**
     * @param $uri
     * @param $path
     * @return Router
     */
    public function post($uri, $path)
    {
        self::$route['POST'][$uri] = $path;

        return $this;
    }

    /**
     * @param $uri
     * @param $path
     * @return Router
     */
    public function get($uri, $path)
    {
        self::$route['GET'][$uri] = $path;

        return $this;
    }

    /**
     * @param $uri
     * @param $path
     * @return Router
     */
    public function delete($uri, $path)
    {
        self::$route['DELETE'][$uri] = $path;

        return $this;
    }

    public function middleware()
    {
        
    }

    /**
     * @param $uri
     * @param $method
     * @return Exception
     */
    public static function redirect($uri, $method)
    {
        if (array_key_exists($uri, self::$route[$method])) {
            return self::handleRedirect($uri, $method);
        }

        return new Exception("Request method not found!");
    }

    /**
     * @param $uri
     * @param $method
     * @return Exception|mixed
     */
    private static function handleRedirect($uri, $method)
    {
        if (!is_callable($action = self::$route[$method][$uri])) {
            return self::doAction(
                ...explode('@', $action)
            );
        }

        return is_string($do = call_user_func($action)) ? var_dump($do) : $do;
    }

    /**
     * @return array
     */
    public static function getRoute(): array
    {
        return self::$route;
    }

    /**
     * @param $controller
     * @param $action
     * @return Exception
     */
    private static function doAction($controller, $action)
    {
        $controller = "App\Controller\\" . $controller;

        try {
            app()->resolveDependency($controller);
        } catch (ReflectionException $e) {
            $e->getMessage();
        }

        if (!method_exists($controller, $action)) {
            return new Exception('no');
        }

        return $controller->$action();
    }
}