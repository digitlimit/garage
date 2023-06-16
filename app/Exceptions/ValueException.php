<?php

namespace App\Exceptions;

use Exception;

class ValueException extends Exception
{
    protected $message = 'Invalid value';
}
