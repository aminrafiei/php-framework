<?php

use Core\Kernel\App;

/**
 * @param $data
 */
function dd($data)
{
    echo "<pre>";
    die(var_dump($data));
    echo "</pre>";
}

/**
 * @param $path
 */
function redirect($path)
{
    header('Location: '.$path);
}

/**
 * @param $path
 * @param array $data
 */
function view($path, $data = [])
{
    extract($data);

    require 'View/'.$path.'.view.php';
}

/**
 * @return mixed
 */
function request()
{
    return App::get('request');
}

/**
 * @return mixed
 */
function auth()
{
    return App::get('session')->getUser();
}

/**
 * @return mixed
 */
function validation()
{
    return App::get('validation');
}

/**
 * @return mixed
 */
function session()
{
    return App::get('session');
}

/**
 * @param string $message
 */
function flashMessage($message = '')
{
    if (!empty($message)) {
        session()->setMessage($message);
    }
}