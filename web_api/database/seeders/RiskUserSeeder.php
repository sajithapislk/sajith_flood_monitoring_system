<?php

namespace Database\Seeders;

use App\Models\RiskUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiskUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RiskUser::insert([
            [
                'user_id' => 1,
                'monitor_place_id' => 1,
                'distance' => 1,
                'longitude' => 12.0000,
                'latitude' => 12.0000,
                'created_at' => "2024-11-01 10:00:00",
                'updated_at' => "2024-11-01 10:00:00"
            ],
            [
                'user_id' => 1,
                'monitor_place_id' => 1,
                'distance' => 1,
                'longitude' => 12.0000,
                'latitude' => 12.0000,
                'created_at' => "2024-11-02 10:37:25",
                'updated_at' => "2024-11-02 10:37:25"
            ],
            [
                'user_id' => 1,
                'monitor_place_id' => 1,
                'distance' => 1,
                'longitude' => 12.0000,
                'latitude' => 12.0000,
                'created_at' => "2024-11-03 06:55:25",
                'updated_at' => "2024-11-03 06:55:25"
            ],
            [
                'user_id' => 1,
                'monitor_place_id' => 1,
                'distance' => 1,
                'longitude' => 12.0000,
                'latitude' => 12.0000,
                'created_at' => "2024-11-04 15:15:25",
                'updated_at' => "2024-11-04 15:15:25"
            ],
            [
                'user_id' => 1,
                'monitor_place_id' => 1,
                'distance' => 1,
                'longitude' => 12.0000,
                'latitude' => 12.0000,
                'created_at' => "2024-11-05 20:40:15",
                'updated_at' => "2024-11-05 20:40:15"
            ],
            [
                'user_id' => 3,
                'monitor_place_id' => 1,
                'distance' => 1,
                'longitude' => 12.0000,
                'latitude' => 12.0000,
                'created_at' => "2024-11-05 20:40:15",
                'updated_at' => "2024-11-05 20:40:15"
            ],
            [
                'user_id' => 2,
                'monitor_place_id' => 1,
                'distance' => 1,
                'longitude' => 12.0000,
                'latitude' => 12.0000,
                'created_at' => "2024-11-05 20:40:15",
                'updated_at' => "2024-11-05 20:40:15"
            ],
        ]);
    }
}
