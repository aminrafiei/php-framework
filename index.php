<?php

require 'Core/bootstrap.php';
require 'routes.php';

require Router::redirect(Request::uri(),Request::method());