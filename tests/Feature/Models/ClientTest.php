<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Client;

uses(RefreshDatabase::class);
beforeEach(fn () => $this->seed(DatabaseSeeder::class));

it('create client with model', function () 
{
    $inputs = [
        'name'  => fake()->name(),
        'email' => fake()->email(),
        'phone' => fake()->phoneNumber()
    ];

    Client::create($inputs);

    $this->assertDatabaseHas('clients', $inputs);

})->group('client', 'client-model');
