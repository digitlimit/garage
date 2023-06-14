<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Slot;
use App\Helpers\SettingHelper;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function __construct(
        readonly private SettingHelper $setting
    ){}

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SlotSeeder::class);

        User::factory()->create([
            'name'     => 'Paul',
            'email'    => $this->setting->get('demo_email'),
            'password' => Hash::make($this->setting->get('demo_password')),
            'admin'    => true
        ]);

        $client = Client::factory()->create([
           'name'  => 'Emeka Mbah',
           'phone' => '07366713094',
           'email' => 'frankemeks77@yahoo.com'
        ]);

        $vehicle = Vehicle::factory()->create([
            'make'  => 'Honda',
            'model' => '2023 Honda CR-V'
        ]);

        Booking::factory()->create([
            'client_id'  => $client->id,
            'vehicle_id' => $vehicle->id,
            'slot_id'    => Slot::all(['id'])->random()->id
        ]);
    }
}
