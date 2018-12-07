<?php

use Core\Request;

require 'vendor/autoload.php';

require 'Core/bootstrap.php';
require 'routes/routes.php';

Router::redirect(Request::uri(),Request::method());