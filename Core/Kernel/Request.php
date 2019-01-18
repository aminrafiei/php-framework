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
     * @param array $values
     * @return mixed
     */
    public function get(array $values = [])
    {
        if (empty($values))
            return $_REQUEST;
        else {
            $res = null;
            foreach ($values as $value) {
                $res .= $_REQUEST[$value];
            }

            return $res;
        }
    }

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
        if ($this->has('_method')) {
            return $_REQUEST['_method'];
        }

        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function has($attribute)
    {
        return !empty($_REQUEST[$attribute]);
    }
}