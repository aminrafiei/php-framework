<?php

use Core\Kernel\App;
use Core\Kernel\Request;

require 'functions.php';

App::bind('config',require 'config.php');

App::bind('request', new Request());

App::bind('database',new QueryBuilder(
    Connection::make(App::get('config')['database'])
));