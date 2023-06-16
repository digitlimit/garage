<?php

namespace App\Policies;

use App\Exceptions\PolicyException;

class BasePolicy
{
    /**
     * Throws an exception to deny user access
     * 
     * @throws \App\Exceptions\PolicyException
     */
    protected function deny(string $message=null, int $code=403)
    {
        throw new PolicyException($message, $code);
    }

    /**
     * Simple return true which means to allow access
     */
    protected function allow() : bool
    {
        return true;;
    }
}
