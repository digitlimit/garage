<?php

namespace App\Helpers;

use Illuminate\Log\Logger;

class LogHelper
{
    public function __construct(
        readonly private Logger $log
    ) {
    }

    /**
     * Send logs to log channel
     */
    public function info($logs): void
    {
        $this->log->info($logs);
    }
}
