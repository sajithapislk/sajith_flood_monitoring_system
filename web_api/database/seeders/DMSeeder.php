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
        DM::create([
            'name' => 'Test DM',
            'email' => 'dm@test.com',
            'password' => Hash::make('12345678'),
            'area_id' => '1',
            'tp'=>'1234567890',
        ]);
    }
}
