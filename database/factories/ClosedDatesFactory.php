<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Slot;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClosedDates>
 */
class ClosedDatesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date()
        ];
    }
}
