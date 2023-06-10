<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\Booking;
use App\Models\User;

uses(RefreshDatabase::class);

it('can close some slots from being booked', function () 
{
    $paul     = User::factory()->create(['name' => 'Paul', 'admin' => true]);
    $booking  = Booking::factory()->create();

    Sanctum::actingAs($paul);

    $response = $this->postJson("/api/slots/close")->assertOk();
    $content  = $response->decodeResponseJson()['data'];

    expect($content)
        ->toMatchArray(['id' => $booking->id]);

})->group('api', 'api-slot', 'api-slot-close');

it('can open closed slots for new bookings', function () 
{
    $response = $this
        ->postJson("/api/slots/open",[
            'name'  => 'Emeka',
            'email' => 'frankemeks77@yahoo.com'
        ])
        ->assertOk();

    $this->assertDatabaseMissing('bookings', ['client_id' => 1]);

})->group('api', 'api-slot', 'api-slot-open');
