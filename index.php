<?php

use Core\Kernel\Request;

require 'vendor/autoload.php';

require 'Core/Kernel/bootstrap.php';
require 'routes/routes.php';

Router::redirect(Request::uri(),Request::method());