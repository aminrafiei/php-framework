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
        if (empty($values)) {
            return $_REQUEST;
        } else {
            $result = null;

            foreach ($values as $value) {
                $result .= $_REQUEST[$value];
            }

            return $result;
        }
    }

    /**
     * @return string
     */
    public function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
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

    /**
     * redirect back
     */
    public function back()
    {
        return redirect($_SERVER['HTTP_REFERER']);
    }
}