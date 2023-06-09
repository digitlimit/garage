<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClosedSlot>
 */
class ClosedSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $slotStart = Carbon::parse(fake()->dateTime());
        $slotEnd   = $slotStart->addMinute(config('setting.interval'));
        
        return [
            'slot_start' => $slotStart,
            'slot_end'   => $slotEnd
        ];
    }
}
