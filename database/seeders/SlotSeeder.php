<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SlotHelper;
use App\Helpers\SettingHelper;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = app(SettingHelper::class);
        $helper  = new SlotHelper(
            $setting->get('interval'), 
            $setting->get('open'), 
            $setting->get('close')
        );

        $slots = $helper->slots();

        DB::table('slots')->insert($slots);
    }
}
