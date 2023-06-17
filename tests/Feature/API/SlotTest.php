<?php

use Database\Seeders\SlotSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can allow guests to fetch slots', function () {
    $this->seed(SlotSeeder::class);

    $slots = slots();
    $response = $this
        ->getJson('/api/slots')
        ->assertOk();

    $content = json_decode($response->decodeResponseJson()->json, true);

    expect(count($content))->toBeGreaterThan(0);
    expect($content)->toHaveCount(count($slots));

    expect($content[0]['name'])->toBe($slots[0]['name']);
    expect(end($content)['name'])->toBe(end($slots)['name']);

})->group('api', 'api-slot', 'api-slot-list');
