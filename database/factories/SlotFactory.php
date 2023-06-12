<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SlotHelper;
use App\Helpers\SettingHelper;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slot>
 */
class SlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $setting = app(SettingHelper::class);
        $helper  = new SlotHelper(
            $setting->get('interval'), 
            $setting->get('open'), 
            $setting->get('close')
        );

        return fake()->randomElement($helper->slots());
    }
}
