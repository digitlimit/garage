<?php

namespace App\Policies;

use App\Exceptions\PolicyException;

class BasePolicy
{
     /**
     * Simply return false which means to deny access
     */
    protected function deny() : bool
    {
        return false;
    }

    /**
     * Simply return true which means to allow access
     */
    protected function allow(): bool
    {
        return true;
    }
}
