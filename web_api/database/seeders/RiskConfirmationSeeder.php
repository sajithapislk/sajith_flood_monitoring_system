<?php

namespace Database\Seeders;

use App\Models\RiskConfirmation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiskConfirmationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RiskConfirmation::insert([
            [
                'safety_place_id' => 1,
                'risk_user_id' => 1,
                'created_at'=>now(),
                'updated_at' =>now()
            ],
            [
                'safety_place_id' => 1,
                'risk_user_id' => 1,
                'created_at'=>now(),
                'updated_at' =>now()
            ]
        ]);
    }
}
