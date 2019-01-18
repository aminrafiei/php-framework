<?php

Router::get('','PagesController@home');
Router::get('about','PagesController@about');
Router::get('task','TasksController@index');
Router::delete('task','TasksController@store');
Router::get('login', 'AuthController@show');
Router::post('login', 'AuthController@auth');