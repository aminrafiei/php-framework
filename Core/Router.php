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
     * @param $method
     * @return Exception
     */
    public static function redirect($uri, $method)
    {


        if (array_key_exists($uri,self::$route[$method])){

            return self::$route[$method][$uri];
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


}