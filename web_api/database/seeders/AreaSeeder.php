<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Area::insert([
            [
                'name' => 'Matale',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kandy',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dabulla',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jaffna',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kurunegala',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
