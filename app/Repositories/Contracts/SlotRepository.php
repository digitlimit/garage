<?php

namespace App\Repositories\Contracts;

use Carbon\CarbonInterface;

interface SlotRepository
{
    public function all(array $columns) : mixed;

    public function isAvailable(int $slotId, CarbonInterface $date) : bool;

    public function bookedFromToday() : mixed;
}