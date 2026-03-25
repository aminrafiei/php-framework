<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'routes/routes.php';

use Core\Kernel\App;
use Core\Kernel\Env;
use Core\Kernel\ExceptionHandler;

Env::load(__DIR__ . '/.env');
ExceptionHandler::register();

$app = App::instance();
$app->handle();
