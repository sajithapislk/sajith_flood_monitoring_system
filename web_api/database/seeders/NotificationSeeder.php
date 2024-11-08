<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::insert([
            [
                'user_id' => 1,
                'message' => "Flood Alert At Matale",
                'created_at'=>now(),
                'updated_at' =>now()
            ],
            [
                'user_id' => 1,
                'message' => "Flood Alert At Matale",
                'created_at'=>now(),
                'updated_at' =>now()
            ]
        ]);
    }
}
