<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Slot;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

it('can create booking with model', function () 
{
    $vehicle = Vehicle::factory()->create();
    $slot    = Slot::factory()->create();
    $client  = Client::factory()->create();

    $inputs = [
        'client_id'  => $client->id,
        'vehicle_id' => $vehicle->id,
        'slot_id'    => $slot->id,
        'date'       => Carbon::now()->next(fake()->dayOfWeek())
    ];

    Booking::create($inputs);

    $this->assertDatabaseHas('bookings', $inputs);

})->group('booking', 'booking-model');

it('can can return booking with scopes', function () 
{
    $booking1 = Booking::factory()->create();
    $booking2 = Booking::factory()->create();

    // scopeForDate
    $forDate = Booking::forDate($booking1->date)->first();
    expect($forDate->id)->toEqual($booking1->id);

    // scopeList
    $lists = Booking::list()->get();
    expect($lists)->toHaveCount(2);

    expect($lists[1])
        ->toMatchObject([
            'id' => $booking2->id,
        ]);

})->group('booking', 'booking-model-scope');