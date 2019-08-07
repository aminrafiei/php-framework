<?php

use Core\Router;

Router::make()->get('','PagesController@home');
Router::make()->get('login','AuthController@showLogin');
Router::make()->post('login','AuthController@login');