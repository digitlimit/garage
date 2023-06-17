<?php

use App\Models\Booking;
use App\Models\Client;
use App\Models\Slot;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

it('can create booking with model', function () {
    $vehicle = Vehicle::factory()->create();
    $slot = Slot::factory()->create();
    $client = Client::factory()->create();

    $inputs = [
        'client_id' => $client->id,
        'vehicle_id' => $vehicle->id,
        'slot_id' => $slot->id,
        'date' => Carbon::now()->next(fake()->dayOfWeek()),
    ];

    Booking::create($inputs);

    $this->assertDatabaseHas('bookings', $inputs);

})->group('model', 'booking-model', 'booking-model-create');

it('can fetch booking with scopes', function () {
    $booking1 = Booking::factory()->create();
    $booking2 = Booking::factory()->create();

    // scopeForDate
    $forDate = Booking::forDate($booking1->date)->first();
    expect($forDate->id)->toEqual($booking1->id);

    // scopeList
    $lists = Booking::list()->get();
    expect($lists)->toHaveCount(2);

    expect($lists[1]->toArray())
        ->toMatchArray([
            'id' => $booking2->id,
            'date' => $booking2->date->format('Y-m-d'),
            'make' => $booking2->vehicle->make,
            'model' => $booking2->vehicle->model,
            'name' => $booking2->client->name,
            'email' => $booking2->client->email,
            'phone' => $booking2->client->phone,
            'slot' => $booking2->slot->name,
        ]);

})->group('model', 'booking-model', 'booking-model-scope');
