<?php

use Core\Kernel\App;

require 'functions.php';

App::bind('config',require 'config.php');

App::bind('database',new QueryBuilder(
    Connection::make(App::get('config')['database'])
));