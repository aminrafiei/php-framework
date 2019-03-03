<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 2:38 PM
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

    /**
     * @var array
     */
    protected  static $names = [];

    /**
     * @param $uri
     * @param $path
     */
    public static function post($uri, $path)
    {
        self::$route['POST'][$uri] = $path;
    }

    /**
     * @param $uri
     * @param $path
     */
    public static function get($uri, $path)
    {
        self::$route['GET'][$uri] = $path;
    }

    /**
     * @param $uri
     * @param $path
     */
    public static function delete($uri, $path)
    {
        self::$route['DELETE'][$uri] = $path;
    }

    /**
     * @param $uri
     * @param $method
     * @return Exception
     * @throws ReflectionException
     */
    public static function redirect($uri, $method)
    {
        if (array_key_exists($uri,self::$route[$method])){

            return self::doAction(

                ...explode('@',self::$route[$method][$uri])
            );
        }

        return new Exception();
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
     * @throws ReflectionException
     */
    public static function doAction($controller, $action)
    {
        $controller = "App\Controller\\".$controller;

        app()->resolveDependency($controller);

        if(!method_exists($controller,$action)){
            return new Exception('no');
        }

        return $controller->$action();
    }
}