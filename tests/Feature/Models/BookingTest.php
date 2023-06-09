<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Booking;
use Carbon\Carbon;

uses(RefreshDatabase::class);
beforeEach(fn () => $this->seed(DatabaseSeeder::class));

it('can create booking with model', function () 
{
    $inputs = [
        'client_id'  => 1,
        'vehicle_id' => 1,
        'slot_start' => Carbon::now(),
        'slot_end'   => Carbon::now()->addMinute(30)
    ];

    Booking::create($inputs);

    $this->assertDatabaseHas('bookings', $inputs);

})->group('booking', 'booking-model');
