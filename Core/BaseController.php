<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/14/2018
 * Time: 7:55 PM
 */

namespace Core;


/**
 * Class BaseController
 * @package Core
 */
class BaseController
{
    /**
     * @param $path
     */
    public function redirect($path)
    {
        header('Location: ' . $path);
    }

    /**
     * @param $path
     * @param array $data
     */
    public function view($path, $data = [])
    {
        extract($data);

        require 'View/' . $path . '.view.php';
    }
}