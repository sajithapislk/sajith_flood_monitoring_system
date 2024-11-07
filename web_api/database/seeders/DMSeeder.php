<?php

namespace Database\Seeders;

use App\Models\DM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DM::insert([
            [
                'name' => 'Test DM',
                'email' => 'dm@test.com',
                'password' => Hash::make('12345678'),
                'area_id' => '1',
                'tp'=>'1234567890',
            ],
            [
                'name' => 'Sajith',
                'email' => 'dm@test.com',
                'password' => Hash::make('12345678'),
                'area_id' => '2',
                'tp'=>'713596504',
            ],
            [
                'name' => 'Saheer',
                'email' => 'dm@test.com',
                'password' => Hash::make('12345678'),
                'area_id' => '3',
                'tp'=>'734509675',
            ]
           
        ]);
    }
}
