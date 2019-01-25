<?php

use Core\Kernel\App;
use Core\Kernel\Request;
use Core\Kernel\Session;
use Core\Kernel\Validation;

require 'helper.php';

App::bind('config',require 'config.php');
App::bind('request', new Request());
App::bind('session', Session::getInstance());
App::bind('validation', new Validation());
App::bind('database',new QueryBuilder(
    Connection::make(App::get('config')['database'])
));