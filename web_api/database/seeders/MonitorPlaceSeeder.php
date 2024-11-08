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
            'area_id'=>'1',
            'is_danger'=>'0',
            'd_level'=>'60',
            'longitude'=>'13.5454545',
            'latitude'=>'12.4554545',
            'name'=>'Matale',
            'created_at'=>'now',
                'updated_at'=>'now'
           ],
           [
            'area_id'=>'2',
            'is_danger'=>'0',
            'd_level'=>'40',
            'longitude'=>'12.54545453',
            'latitude'=>'12.4554545',
            'name'=>'Kandy',
            'created_at'=>'now',
                'updated_at'=>'now'
           ],
           [
            'area_id'=>'3',
            'is_danger'=>'0',
            'd_level'=>'90',
            'longitude'=>'132.5454545',
            'latitude'=>'122.45534545',
            'name'=>'Kurunegala',
            'created_at'=>'now',
                'updated_at'=>'now'
           ],
           [
            'area_id'=>'4',
            'is_danger'=>'0',
            'd_level'=>'30',
            'longitude'=>'11.5343545',
            'latitude'=>'17.4532545',
            'name'=>'Kekirawa',
            'created_at'=>'now',
                'updated_at'=>'now'
           ]
        ]);
    }
}
