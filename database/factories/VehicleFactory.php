<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $makes  = ['Ford', 'BMW','Honda'];
        
        $models = [
            'Ford'  => ['2022 Ford S-MAX',   '2022 Ford Mustang'],
            'BMW'   => ['2023 BMW 5 Series', '2023 BMW 3 Series'],
            'Honda' => ['2023 Honda Civic',  '2023 Honda CR-V']
        ];

        $make = fake()->randomElement($makes);
        
        return [
            'make'  => $make,
            'model' => fake()->randomElement($models[$make]),
        ];
    }
}
