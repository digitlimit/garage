<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Slot;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id'  => Client::factory(),
            'vehicle_id' => Vehicle::factory(),
            'slot_id'    => Slot::factory(),
            'date'       => Carbon::now()->next(fake()->dayOfWeek())
        ];
    }
}
