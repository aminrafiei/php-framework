<?php

use Core\App;

App::bind('config',require 'config.php');

require 'functions.php';

App::bind('database',new QueryBuilder(
    Connection::make(App::get('config')['database'])
));