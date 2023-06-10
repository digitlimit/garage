<?php

namespace App\Repositories\Eloquent;

use App\Models\Vehicle as Model;
use App\Repositories\Contracts\VehicleRepository as RepositoryInterface;

class VehicleRepository implements RepositoryInterface
{
    public function __construct(private Model $model)
    {}

    /**
     * Find a vehicle with the given email or create one if doesn't exist
     * 
     * @param  array $vehicle A array for vehicle
     * @return int Returns the vehicle ID
     */
    public function firstOrCreate(array $vehicle) : int
    {
 
    }
}
