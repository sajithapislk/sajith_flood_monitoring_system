<?php

namespace Database\Seeders;

use App\Models\SafetyPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SafetyPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SafetyPlace::insert([
            [
                'area_id' => '1',
                'longitude' => '7.4583784',
                'latitude' => ',80.6081052',
                'name' => 'Matale',
                'tp' => '7897897899',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'area_id' => '2',
                'longitude' => '132.5454545',
                'latitude' => '143.4554545',
                'name' => 'Kandy',
                'tp' => '712805509',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'area_id' => '3',
                'longitude' => '13.5454545',
                'latitude' => '12.4554545',
                'name' => 'Kurunegala',
                'tp' => '74324534',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'area_id' => '4',
                'longitude' => '12.54324545',
                'latitude' => '12.4342545',
                'name' => 'Jaffna',
                'tp' => '764534276',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
