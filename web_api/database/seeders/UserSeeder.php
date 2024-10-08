<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'password' => Hash::make('12345678'),
            'guardian_name'=>'Test Guardian',
            'tp'=>'0777777777',
            'guardian_tp'=>'0888888888',
            'area_id'=>'1',
        ]);
    }
}
