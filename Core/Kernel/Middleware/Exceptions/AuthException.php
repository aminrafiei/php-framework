<?php

namespace Core\Kernel\Middleware\Exceptions;

use Exception;

class AuthException extends Exception
{
    protected $code = 401;

    protected $message = 'UnAuthorized';
}