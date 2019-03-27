<?php

use Core\Kernel\App;

/**
 * @param $data
 */
function dd($data)
{
    echo "<pre>";
    die(var_dump($data));
}

/**
 * @param $path
 */
function redirect($path)
{
    header('Location: ' . $path);
}

/**
 * @param $path
 * @param array $data
 */
function view($path, $data = [])
{
    //TODO : fix this :)

    $loader = new Twig_Loader_Filesystem('View');
    $twig = new Twig_Environment($loader);

    $twig->addFilter((new \Twig_Filter('auth', function () {
        return auth();
    })));

    $twig->addFilter((new \Twig_Filter('authName', function () {
        return auth()->name;
    })));

    $view = $path . '.view.php';
    $data = !empty($data) ? extract($data) : [];

    try {
        echo $twig->render($view, $data);
    } catch (Twig_Error $e) {
        $e->getMessage();
    }

//    require 'View/'.$path.'.view.php';
}

/**
 * @return App
 */
function app()
{
    return App::instance();
}

/**
 * @return \Core\Kernel\Request
 */
function request()
{
    return app()->get('request');
}

/**
 * @return \Core\Kernel\Session
 */
function auth()
{
    return app()->get('session')->getUser();
}

/**
 * @return \Core\Kernel\Validation\Validation
 */
function validation()
{
    return app()->get('validation');
}

/**
 * @return \Core\Kernel\Session
 */
function session()
{
    return app()->get('session');
}

/**
 * @return Core\Cache\Cache
 */
function cache()
{
    return app()->get('cache');
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