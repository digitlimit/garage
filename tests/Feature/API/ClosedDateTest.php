<?php

use App\Helpers\ResponseHelper;
use App\Models\Slot;
use App\Models\User;
use App\Repositories\Contracts\ClosedDateRepository;
use Database\Seeders\SlotSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

it('can allow guests to fetch closed dates', function () {
    $this->seed(SlotSeeder::class);

    // close a date
    $closedDate = app(ClosedDateRepository::class);
    $date = Carbon::now()->next(day());
    $closedId = $closedDate->close($date);

    $response = $this
        ->getJson('/api/slots/closed-dates')
        ->assertOk();

    $content = $response->decodeResponseJson();

    expect($content[0])->toMatchArray([
        'id' => $closedId,
        'date' => $date->format('Y-m-d'),
    ]);

})->group('api', 'api-closed-date', 'api-closed-date-list');

it('cannot allow guest to close a date', function () {
    $this->seed(SlotSeeder::class);

    $this
        ->postJson('/api/slots/close-date', [
            'date' => Carbon::now()->next(day())->format('Y-m-d'),
        ])
        ->assertStatus(ResponseHelper::UNAUTHORIZED);

})->group('api', 'api-closed-date', 'api-closed-date-guest-cannot-close-date');

it('cannot allow non admin to close a date', function () {
    $this->seed(SlotSeeder::class);
    $this->actingAs(User::factory()->create(['admin' => false]));

    $this
        ->postJson('/api/slots/close-date', [
            'date' => Carbon::now()->next(day())->format('Y-m-d'),
        ])
        ->assertStatus(ResponseHelper::FORBIDDEN);

})->group('api', 'api-closed-date', 'api-closed-date-nonadmin-cannot-close-date');

it('can allow admin to close a date', function () {
    $this->seed(SlotSeeder::class);
    $this->actingAs(User::factory()->create(['admin' => true]));

    $this
        ->postJson('/api/slots/close-date', [
            'date' => Carbon::now()->next(day())->format('Y-m-d'),
        ])
        ->assertStatus(ResponseHelper::NO_CONTENT);

})->group('api', 'api-closed-date', 'api-closed-date-admin-can-close-date');

it('cannot allow customer to book a closed date', function () {
    $this->seed(SlotSeeder::class);

    // close a date
    $closedSlot = app(ClosedDateRepository::class);
    $date = Carbon::now()->next(day());
    $closedSlot->close($date);

    // assert the repository closed the date
    $this->assertDatabaseHas('closed_dates', ['date' => $date]);

    // customer to book a closed slot
    $response = $this
        ->postJson('/api/bookings', [
            'date' => $date->format('Y-m-d'),
            'slot' => Slot::all(['id'])->random()->id,
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => '020655489',
            'make' => 'Honda',
            'model' => 'CR-V',
        ])->assertStatus(ResponseHelper::UNPROCESSABLE_ENTITY);

    $content = $response->decodeResponseJson();

    expect($content['message'])->toEqual('Slot is not available');

    expect($content['errors'])
        ->toMatchArray(['slot' => ['Slot is not available']]);

})->group('api', 'api-closed-date', 'api-closed-date-customer-cannot-book-closed-date');
