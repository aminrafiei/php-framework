<?php

$config = require 'config.php';
require 'functions.php';
require 'Database/Connection.php';
require 'Database/QueryBuilder.php';
require 'Router.php';
require 'Request.php';

$database = new QueryBuilder(
    Connection::make($config['database'])
);