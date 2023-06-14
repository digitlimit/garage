<?php

namespace App\Repositories\Contracts;

use Carbon\CarbonInterface;

interface SlotRepository
{
    public function all(array $columns) : mixed;

    public function closedFromToday() : mixed;

    public function isAvailable(int $slotId, CarbonInterface $date) : bool;

    public function close(int $slotId, CarbonInterface $date) : int;

    public function open(int $slotId, CarbonInterface $date) : bool;
}