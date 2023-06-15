<?php

namespace App\Repositories\Contracts;

use Carbon\CarbonInterface;

interface ClosedSlotRepository
{
    public function closedFromToday() : mixed;

    public function close(int $slotId, CarbonInterface $date) : int;

    public function open(int $slotId, CarbonInterface $date) : bool;
}