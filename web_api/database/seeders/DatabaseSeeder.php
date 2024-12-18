<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RiskConfirmation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AreaSeeder::class,
            UserSeeder::class,
            AdminSeeder::class,
            DMSeeder::class,
            MonitorPlaceSeeder::class,
            SafetyPlaceSeeder::class,
            FloodStatusSeeder::class,
            RiskUserSeeder::class,
            NotificationSeeder::class,
            RiskConfirmationSeeder::class,

        ]);
    }
}
