<?php

use App\Helpers\ResponseHelper;
use App\Mail\Admin\BookingConfirmation as EmailAdmin;
use App\Mail\Client\BookingConfirmation as EmailClient;
use App\Models\Booking;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('can create new bookings', function () {
    $slot = Slot::factory()->create();

    $input = (object) [
        'name' => fake()->name(),
        'email' => fake()->email(),
        'phone' => '020655489',
        'make' => 'Honda',
        'model' => 'CR-V',
        'slot' => $slot->id,
        'date' => Carbon::now()->next(day())->format('Y-m-d'),
    ];

    $this
        ->postJson('/api/bookings', [
            'name' => $input->name,
            'email' => $input->email,
            'phone' => $input->phone,
            'make' => $input->make,
            'model' => $input->model,
            'slot' => $input->slot,
            'date' => $input->date,
        ])
        ->assertStatus(ResponseHelper::NO_CONTENT);

    $booking = Booking::first();

    $this->assertDatabaseHas('bookings', [
        'id' => $booking->id,
        'client_id' => $booking->client->id,
        'slot_id' => $booking->slot->id,
        'vehicle_id' => $booking->vehicle->id,
        'date' => $booking->date,
    ]);

    $this->assertDatabaseHas('clients', [
        'phone' => $input->phone,
        'email' => $input->email,
        'name' => $input->name,
    ]);

    $this->assertDatabaseHas('slots', ['name' => $slot->name]);

})->group('api', 'api-booking', 'api-booking-create-new');

it('can not book weekends', function () {
    $slot = Slot::factory()->create();
    $weekend = fake()->randomElement(['Saturday', 'Sunday']);

    $response = $this
        ->postJson('/api/bookings', [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => '020655489',
            'make' => 'Honda',
            'model' => 'CR-V',
            'slot' => $slot->id,
            'date' => Carbon::now()->next($weekend)->format('Y-m-d'),
        ])
        ->assertStatus(ResponseHelper::UNPROCESSABLE_ENTITY);

    $content = $response->decodeResponseJson();

    expect($content['message'])->toEqual('We currently do not open on weekends');

    expect($content['errors'])
        ->toMatchArray(['date' => ['We currently do not open on weekends']]);

})->group('api', 'api-booking', 'api-booking-interval');

it('cannot allow non admin user to fetch list of upcoming bookings', function () {
    Booking::factory()->create();

    $user = User::factory()->create(['name' => 'Jack', 'admin' => false]);
    Sanctum::actingAs($user);
    $response = $this->getJson('/api/bookings')->assertStatus(ResponseHelper::FORBIDDEN);

    expect(json_decode($response->getContent(), true))->toMatchArray(['message' => 'Access Denied']);

})->group('api', 'api-booking', 'api-booking-upcoming-user');

it('can allow admin to fetch a list of upcoming bookings', function () {
    $booking = Booking::factory()->create();
    $admin = User::factory()->create(['name' => 'Paul', 'admin' => true]);

    $this->actingAs($admin);
    $response = $this->getJson('/api/bookings')->assertOk();
    $content = $response->decodeResponseJson()['data'][0];

    expect($content['id'])->toBe($booking->id);

})->group('api', 'api-booking', 'api-booking-upcoming-admin');

it('can filter bookings to a specific date', function () {
    $booking1 = Booking::factory()->create([
        'date' => Carbon::now()->next('Monday'),
    ]);

    $booking2 = Booking::factory()->create([
        'date' => Carbon::now()->next('Tuesday'),
    ]);

    $admin = User::factory()->create(['name' => 'Paul', 'admin' => true]);

    $this->actingAs($admin);

    $date = $booking2->date->format('Y-m-d');
    $response = $this->getJson("/api/bookings?date=$date")->assertOk();

    $content = $response->decodeResponseJson()['data'];

    expect($content)->toHaveCount(1);
    expect($content[0])->toMatchArray(['id' => $booking2->id, 'date' => $date]);

})->group('api', 'api-booking', 'api-booking-filter');

it('can send bookings confirmation to the customer', function () {
    $slot = Slot::factory()->create();

    $booking = [
        'name' => fake()->name(),
        'email' => fake()->email(),
        'phone' => '020655489',
        'make' => 'Honda',
        'model' => 'CR-V',
        'slot' => $slot->name,
        'date' => Carbon::now()->next(day())->format('Y-m-d'),
    ];

    $mailable = new EmailClient($booking);

    $mailable->assertSeeInText('Booking Confirmation');
    $mailable->assertSeeInText($booking['slot']);
    $mailable->assertSeeInText($booking['make']);
    $mailable->assertSeeInText($booking['model']);

})->group('api', 'api-booking', 'api-booking-email-client');

it('can send bookings confirmation to the admin', function () {
    $slot = Slot::factory()->create();

    $booking = [
        'name' => fake()->name(),
        'email' => fake()->email(),
        'phone' => '020655489',
        'make' => 'Honda',
        'model' => 'CR-V',
        'slot' => $slot->name,
        'date' => Carbon::now()->next(day())->format('Y-m-d'),
    ];

    $mailable = new EmailAdmin($booking);

    $mailable->assertSeeInText('New Booking');
    $mailable->assertSeeInText($booking['slot']);
    $mailable->assertSeeInText($booking['make']);
    $mailable->assertSeeInText($booking['model']);

})->group('api', 'api-booking', 'api-booking-email-admin');
