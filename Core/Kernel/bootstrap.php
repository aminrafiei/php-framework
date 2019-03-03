<?php

use Core\Kernel\Request;
use Core\Kernel\Session;
use Core\Kernel\Validation;

require 'helper.php';

app()->bind('config',require 'config.php');
app()->bind('request', new Request());
app()->bind('session', Session::getInstance());
app()->bind('validation', new Validation());
app()->bind('database', new MySqlQueryBuilder(
    Connection::make(app()->get('config')['database'])
));