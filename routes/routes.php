<?php

use Core\Router;

Router::make()->get('','PagesController@home');
Router::make()->get('login','AuthController@showLogin');
Router::make()->post('login','AuthController@login');
Router::make()->get('register','AuthController@showRegister');
Router::make()->post('register','AuthController@register');