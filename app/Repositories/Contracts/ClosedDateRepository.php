<?php

namespace App\Repositories\Contracts;

use Carbon\CarbonInterface;

interface ClosedDateRepository
{
    public function closedFromToday(): mixed;

    public function close(CarbonInterface $date): int;

    public function open(CarbonInterface $date): bool;
}
