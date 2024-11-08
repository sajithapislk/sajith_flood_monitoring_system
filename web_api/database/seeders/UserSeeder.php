<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => '12345678',
            'guardian_name'=>'Test Guardian',
            'tp'=>'0772193832',
            'guardian_tp'=>'0777493085',
            'area_id'=>'1',
        ]);
    }
}
