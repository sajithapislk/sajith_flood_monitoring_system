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
        User::insert([
            [
                'name' => 'User',
                'email' => 'user@test.com',
                'password' => Hash::make('12345678'),
                'guardian_name' => 'Test Guardian',
                'tp' => '0772193832',
                'guardian_tp' => '0777493085',
                'area_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User',
                'email' => 'user2@test.com',
                'password' => Hash::make('12345678'),
                'guardian_name' => 'Test Guardian',
                'tp' => '0772193833',
                'guardian_tp' => '0777493087',
                'area_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User',
                'email' => 'user3@test.com',
                'password' => Hash::make('12345678'),
                'guardian_name' => 'Test Guardian',
                'tp' => '0772193834',
                'guardian_tp' => '0777493088',
                'area_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User',
                'email' => 'user4@test.com',
                'password' => Hash::make('12345678'),
                'guardian_name' => 'Test Guardian',
                'tp' => '0772193835',
                'guardian_tp' => '0777493089',
                'area_id' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
