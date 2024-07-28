<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flood_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monitor_place_id');
            $table->integer('water_level');
            $table->timestamps();
            $table->foreign('monitor_place_id')->references('id')->on('monitor_places');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flood_statuses');
    }
};
