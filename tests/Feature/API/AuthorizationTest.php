<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\ClosedSlot;
use App\Models\ClosedDate;
use App\Models\Slot;

uses(RefreshDatabase::class);

it('can allow guest to access non-auth protected routes', function () 
{
    Slot::factory()->create();
    $closedSlot = ClosedSlot::factory()->create(); 
    $closedDate = ClosedDate::factory()->create(); 

    // booked slots list
    $response = $this->getJson(route('slots.booked-slots'))->assertOk();
    $content = $response->decodeResponseJson();
    expect($content)->toMatchArray([]);

    // closed slots list
    $response = $this->getJson(route('slots.closed-slots'))->assertOk();
    $content  = $response->decodeResponseJson();
    expect($content)->toHaveCount(1);
    expect($content[0])->toMatchArray([
        'id'   => $closedSlot->slot->id,
        'name' => $closedSlot->slot->name,
        'date' => $closedSlot->date
    ]);

    Sanctum::actingAs(
        User::factory()->create(),
        ['*']
    );
 
    // closed dates list
    $response = $this->getJson(route('slots.closed-dates'))->assertOk();
    $content  = $response->decodeResponseJson();
    expect($content)->toHaveCount(1);
    expect($content[0])->toMatchArray(['date' => $closedDate->date->format('Y-m-d')]);

})->group('api', 'api-authorization', 'non-auth-routes');