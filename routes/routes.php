<?php

Router::get('','PagesController@home');
Router::get('about','PagesController@about');
Router::get('task','TasksController@index');
Router::post('task','TasksController@store');