<?php

use Core\Kernel\App;
require 'vendor/autoload.php';

require 'Core/Kernel/bootstrap.php';
require 'routes/routes.php';

$app = App::instance();
$app->handle();