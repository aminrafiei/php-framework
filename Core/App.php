<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:36 PM
 */

namespace Core;

class App
{

    public static $register;

    public static function bind($key,$value)
    {
        self::$register[$key] = $value;
    }

    public static function get($key)
    {
        return self::$register[$key];
    }
}