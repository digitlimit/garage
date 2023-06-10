<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\Booking;
use App\Models\User;

uses(RefreshDatabase::class);

it('can create new bookings', function () 
{
    $response = $this
        ->postJson("/api/bookings",[
            'name'  => 'Emeka',
            'email' => 'frankemeks77@yahoo.com'
        ])
        ->assertOk();

    $this->assertDatabaseMissing('bookings', ['client_id' => 1]);

})->group('api', 'api-booking', 'api-booking-create-new');


it('can only allow 30 minutes booking intervals', function () 
{

})->group('api', 'api-booking', 'api-booking-interval');

it('can only allow bookings within the opening time', function () 
{

})->group('api', 'api-booking', 'api-booking-opening-time');

it('can only allow 1 bookings per slot', function () 
{

})->group('api', 'api-booking', 'api-booking-per-slot');

it('can only allow admin to fetch a list of upcoming bookings', function () 
{
    $paul     = User::factory()->create(['name' => 'Paul', 'admin' => true]);
    $booking  = Booking::factory()->create();

    Sanctum::actingAs($paul);

    $response = $this->getJson("/api/bookings/upcoming")->assertOk();
    $content  = $response->decodeResponseJson()['data'];

    expect($content)
        ->toMatchArray(['id' => $booking->id]);

})->group('api', 'api-booking', 'api-booking-upcoming');

it('can filter bookings to a specific day', function () 
{
   

})->group('api', 'api-booking', 'api-booking-filter');

it('can send bookings confirmation email to admin and customer', function () 
{
   

})->group('api', 'api-booking', 'api-booking-emails');