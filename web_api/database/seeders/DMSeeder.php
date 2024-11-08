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
                'password' => ('12345678'),
                'area_id' => '1',
                'tp'=>'1234567890',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Sajith',
                'email' => 'sajith@test.com',
                'password' => ('12345678'),
                'area_id' => '2',
                'tp'=>'713596504',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Saheer',
                'email' => 'saheer@test.com',
                'password' => ('12345678'),
                'area_id' => '3',
                'tp'=>'734509675',
                'created_at'=> now(),
                'updated_at'=> now()
            ]

        ]);
    }
}
