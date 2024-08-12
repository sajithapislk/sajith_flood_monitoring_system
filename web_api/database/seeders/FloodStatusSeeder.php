<?php

namespace Database\Seeders;

use App\Models\FloodStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FloodStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FloodStatus::insert([
            [
                 'monitor_place_id' => '1',
                 'water_level' => '10',
                 'created_at' => '2024-08-06 06:41:15'
            ],
            [
                'monitor_place_id' => '1',
                 'water_level' => '14',
                 'created_at' => '2024-08-06 07:41:15'
            ],
            [
                'monitor_place_id' => '1',
                 'water_level' => '0',
                 'created_at' => '2024-08-06 08:41:15'
            ],
            [
                'monitor_place_id' => '1',
                'water_level' => '10',
                'created_at' => '2024-08-07 07:41:15'
           ],
           [
               'monitor_place_id' => '1',
                'water_level' => '5',
                'created_at' => '2024-08-07 08:41:15'
           ],
           [
               'monitor_place_id' => '1',
                'water_level' => '20',
                'created_at' => '2024-08-07 09:41:15'
           ],
        ]);
    }
}
