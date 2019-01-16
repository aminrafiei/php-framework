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

    public static function doAction($controller, $action)
    {
        $pathController = "App\Controller\\".$controller;
        $controller = new $pathController;

        if(!method_exists($controller,$action)){
            return new Exception('no');
        }


        return $controller->$action();
    }
}