<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ClosedSlot;
use Carbon\Carbon;

uses(RefreshDatabase::class);
beforeEach(fn () => $this->seed(DatabaseSeeder::class));

it('create closedslot with model', function () 
{
    $inputs = [
        'slot_start' => Carbon::now(),
        'slot_end'   => Carbon::now()->addMinute(60)
    ];

    ClosedSlot::create($inputs);

    $this->assertDatabaseHas('closed_slots', $inputs);

})->group('closed-slot', 'closed-slot-model');
