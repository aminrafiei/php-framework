<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 2:39 PM
 */

namespace Core\Kernel;

/**
 * Class Request
 * @package Core\Kernel
 */
class Request
{
    /**
     * @return string
     */
    public function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
    }

    /**
     * @return mixed
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}