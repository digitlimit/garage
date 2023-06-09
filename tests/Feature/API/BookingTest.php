<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Booking;
use Carbon\Carbon;

uses(RefreshDatabase::class);
beforeEach(fn () => $this->seed(DatabaseSeeder::class));

it('can fetch upcoming bookings', function () 
{
    $booking  = Booking::factory()->create();
    $response = $this->getJson("/api/bookings");

    $data = [
        'message' => 'Retrieved To-do',
        'booking' => [
            'id' => $booking->id,
            'name' => $booking->name,
            'completed' => $booking->completed,
        ]
    ];

    $response->assertStatus(200)->assertJson($data);
})->group('api', 'booking-api');
