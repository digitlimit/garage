<?php

namespace App\Repositories\Eloquent;

use App\Models\Vehicle as Model;
use App\Values\Vehicle;
use App\Repositories\Contracts\VehicleRepository as RepositoryInterface;

class VehicleRepository implements RepositoryInterface
{
    public function __construct(
        /**
         * An instance of the vehicle eloquent model
         */
        private Model $model
    ){}

   /**
     * Find the given vehicle or create, if not exists
     * 
     * @param Vehicle $vehicle The vehicle value object
     */
    public function firstOrCreate(Vehicle $vehicle) : int
    {
        $newVehicle = $this
        ->model
        ->firstOrCreate([
            'make'  => $vehicle->getMake(),
            'model' => $vehicle->getModel()
        ]);

        return $newVehicle->id;
    }
}
