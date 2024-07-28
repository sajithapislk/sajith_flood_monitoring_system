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
        Schema::create('risk_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('monitor_place_id');
            $table->string('latitude');
            $table->string('longitude');
            $table->double('distance',10,2);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users'); 
            $table->foreign('monitor_place_id')->references('id')->on('monitor_places'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_users');
    }
};
