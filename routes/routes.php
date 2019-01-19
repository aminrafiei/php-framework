<?php

Router::get('','PagesController@home');
Router::get('about','PagesController@about');
Router::get('task','TasksController@index');
Router::delete('task','TasksController@store');
Router::get('login', 'AuthController@showLogin');
Router::post('login', 'AuthController@login');
Router::get('register', 'AuthController@showRegister');
Router::post('register', 'AuthController@register');