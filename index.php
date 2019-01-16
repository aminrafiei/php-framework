<?php

require 'vendor/autoload.php';

require 'Core/Kernel/bootstrap.php';
require 'routes/routes.php';

Router::redirect(request()->uri(), request()->method());