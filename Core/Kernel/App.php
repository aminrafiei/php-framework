<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:36 PM
 */

namespace Core\Kernel;

/**
 * Class App
 * @package Core\Kernel
 */
class App
{
    /**
     * @var
     */
    public static $register;

    /**
     * @param $key
     * @param $value
     */
    public static function bind($key, $value)
    {
        self::$register[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        return self::$register[$key];
    }
}