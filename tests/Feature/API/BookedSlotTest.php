<?php

use App\Helpers\ResponseHelper;
use App\Models\Slot;
use App\Services\BookingService;
use App\Values\Client;
use App\Values\Vehicle;
use Database\Seeders\SlotSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

it('can allow guests to fetch booked slots', function () {
    $this->seed(SlotSeeder::class);

    // book a slot
    $booking = app(BookingService::class);
    $slot = Slot::all(['id', 'name'])->random();

    $date = Carbon::now()->next(day());
    $booking->addNew(
        $slot->id,
        new Client(fake()->name(), fake()->phoneNumber(), fake()->email()),
        new Vehicle('Honda', 'CRV'),
        $date
    );

    // fetch booked slots
    $response = $this
        ->getJson('/api/slots/booked-slots')
        ->assertOk();

    $content = $response->decodeResponseJson();

    expect($content[0])->toMatchArray([
        'id' => $slot->id,
        'name' => $slot->name,
        'date' => $date->format('Y-m-d'),
    ]);

})->group('api', 'api-booked-slot', 'api-booked-slot-list');

it('cannot allow customer to book a booked slot', function () {
    $this->seed(SlotSeeder::class);

    // book a slot
    $booking = app(BookingService::class);
    $slot = Slot::all(['id', 'name'])->random();

    $date = Carbon::now()->next(day());
    $booking->addNew(
        $slot->id,
        new Client(fake()->name(), fake()->phoneNumber(), fake()->email()),
        new Vehicle('Honda', 'CRV'),
        $date
    );

    // customer try booking a booked slot
    $response = $this
        ->postJson('/api/bookings', [
            'date' => $date->format('Y-m-d'),
            'slot' => $slot->id,
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => '1234567',
            'make' => 'Mazda',
            'model' => 'TFG',
        ])->assertStatus(ResponseHelper::UNPROCESSABLE_ENTITY);

    $content = $response->decodeResponseJson();

    expect($content['message'])->toEqual('Slot is not available');

    expect($content['errors'])
        ->toMatchArray(['slot' => ['Slot is not available']]);

})->group('api', 'api-booked-slot', 'api-booked-slot-customer-cannot-book-closed-slot');
