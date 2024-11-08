<?php

namespace Database\Seeders;

use App\Models\MonitorPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonitorPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MonitorPlace::insert([
            [
                'area_id' => '1',
                'is_danger' => '0',
                'd_level' => '60',
                'longitude' => '7.4583784',
                'latitude' => ',80.6081052',
                'name' => 'Matale',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'area_id' => '2',
                'is_danger' => '0',
                'd_level' => '40',
                'longitude' => '7.2946286',
                'latitude' => ',80.5845813',
                'name' => 'Kandy',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'area_id' => '3',
                'is_danger' => '0',
                'd_level' => '90',
                'longitude' => '7.4807829',
                'latitude' => '80.2753771',
                'name' => 'Kurunegala',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'area_id' => '4',
                'is_danger' => '0',
                'd_level' => '30',
                'longitude' => '8.0457586',
                'latitude' => '80.573816',
                'name' => 'Kekirawa',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
