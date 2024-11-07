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
            ['name' => 'Matale'],
            ['name' => 'Kandy'],
            ['name' => 'Dabulla'],
            ['name'=>'Jaffna'],
            ['name'=>'Kurunegala']
        ]);
    }
}
