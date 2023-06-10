<?php

namespace App\Repositories\Contracts;

use App\Values\Vehicle;

interface VehicleRepository
{
    /**
     * Find the given vehicle or create, if not exists
     * 
     * @param Vehicle $vehicle The vehicle value object
     */
    public function firstOrCreate(Vehicle $vehicle) : int;
}