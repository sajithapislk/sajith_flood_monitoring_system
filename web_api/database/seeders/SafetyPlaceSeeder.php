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
        SafetyPlace::create([
            'area_id' => '1',
            'longitude' => '13.5454545',
            'latitude' => '12.4554545',
            'name' => 'Matale',
            'tp' => '7897897899'
        ]);
    }
}
