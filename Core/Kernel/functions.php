<?php

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
    return \Core\Kernel\App::get('request');
}

/**
 * @return mixed
 */
function auth()
{
    return \Core\Kernel\App::get('session')->getUser();
}