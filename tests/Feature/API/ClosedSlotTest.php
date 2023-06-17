<?php

use App\Helpers\ResponseHelper;
use App\Models\Slot;
use App\Models\User;
use App\Repositories\Contracts\ClosedSlotRepository;
use Database\Seeders\SlotSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

it('can allow guests to fetch closed slots', function () {
    $this->seed(SlotSeeder::class);

    // close a slot
    $closedSlot = app(ClosedSlotRepository::class);
    $slot = Slot::all(['id', 'name'])->random();
    $date = Carbon::now()->next(day());
    $closedId = $closedSlot->close($slot->id, $date);

    $response = $this
        ->getJson('/api/slots/closed-slots')
        ->assertOk();

    $content = $response->decodeResponseJson();

    expect($content[0])->toMatchArray([
        'id' => $closedId,
        'slot_id' => $slot->id,
        'name' => $slot->name,
        'date' => $date->format('Y-m-d'),
    ]);

})->group('api', 'api-closed-slot', 'api-closed-slot-list');

it('cannot allow guest to close a slot', function () {
    $this->seed(SlotSeeder::class);

    $response = $this
        ->postJson('/api/slots/close-slot', [
            'date' => Carbon::now()->next(day())->format('Y-m-d'),
            'slot' => Slot::all(['id'])->random()->id,
        ])
        ->assertStatus(ResponseHelper::UNAUTHORIZED);

})->group('api', 'api-closed-slot', 'api-closed-slot-guest-cannot-close-slot');

it('cannot allow non admin to close a slot', function () {
    $this->seed(SlotSeeder::class);
    $this->actingAs(User::factory()->create(['admin' => false]));

    $response = $this
        ->postJson('/api/slots/close-slot', [
            'date' => Carbon::now()->next(day())->format('Y-m-d'),
            'slot' => Slot::all(['id'])->random()->id,
        ])
        ->assertStatus(ResponseHelper::FORBIDDEN);

})->group('api', 'api-closed-slot', 'api-closed-slot-nonadmin-cannot-close-slot');

it('can allow admin to close a slot', function () {
    $this->seed(SlotSeeder::class);
    $this->actingAs(User::factory()->create(['admin' => true]));

    $response = $this
        ->postJson('/api/slots/close-slot', [
            'date' => Carbon::now()->next(day())->format('Y-m-d'),
            'slot' => Slot::all(['id'])->random()->id,
        ])
        ->assertStatus(ResponseHelper::NO_CONTENT);

})->group('api', 'api-closed-slot', 'api-closed-slot-admin-can-close-slot');

it('cannot allow customer to book a closed slot', function () {
    $this->seed(SlotSeeder::class);

    // close a slot
    $closedSlot = app(ClosedSlotRepository::class);
    $slotId = Slot::all(['id'])->random()->id;
    $date = Carbon::now()->next(day());
    $closedSlot->close($slotId, $date);

    // assert the repository closed the  slot
    $this->assertDatabaseHas('closed_slots', ['slot_id' => $slotId, 'date' => $date]);

    // customer to book a closed slot
    $response = $this
        ->postJson('/api/bookings', [
            'date' => $date->format('Y-m-d'),
            'slot' => $slotId,
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

})->group('api', 'api-closed-slot', 'api-closed-slot-customer-cannot-book-closed-slot');
