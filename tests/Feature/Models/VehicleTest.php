<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Vehicle;

uses(RefreshDatabase::class);
beforeEach(fn () => $this->seed(DatabaseSeeder::class));

it('create vehicle with model', function () 
{
    $inputs = [
        'make'  => fake()->name(),
        'model' => fake()->name(),
    ];

    Vehicle::create($inputs);

    $this->assertDatabaseHas('vehicles', $inputs);

})->group('vehicle', 'vehicle-model');
