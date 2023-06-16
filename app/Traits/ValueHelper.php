<?php

namespace App\Traits;

use App\Exceptions\ValueException;

trait ValueHelper
{
    /**
     * Throw an exception
     *
     * @throws
     */
    protected function fail(string $message): ValueException
    {
        throw new ValueException($message);
    }

    /**
     * Check if value is valid ID
     */
    protected function isValidId($value): bool
    {
        return is_int($value) && $value > 0;
    }
}
