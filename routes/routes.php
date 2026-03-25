<?php

use Core\Router;
use Core\Kernel\Response;

Router::make()->get('','PagesController@home');
Router::make()->get('login','AuthController@showLogin');
Router::make()->post('login','AuthController@login');
Router::make()->get('register','AuthController@showRegister');
Router::make()->post('register','AuthController@register');

Router::make()->get('api/test', function() {
    Response::json(['status' => 'success']);
});

Router::make()->get('fail', function() {
    throw new \Exception("Testing global exception handler!");
});
