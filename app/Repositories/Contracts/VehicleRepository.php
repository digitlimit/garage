<?php

namespace App\Repositories\Contracts;

interface VehicleRepository
{
    public function firstOrCreate(array $vehicle) : int;
}