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
        MonitorPlace::create([
            'area_id'=>'1',
            'is_danger'=>'0',
            'd_level'=>'60',
            'longitude'=>'13.5454545',
            'latitude'=>'12.4554545',
            'name'=>'Matale',
        ]);
    }
}
