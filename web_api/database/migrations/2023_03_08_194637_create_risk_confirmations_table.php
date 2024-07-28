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
        Schema::create('risk_confirmations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('safety_place_id');
            $table->unsignedBigInteger('risk_user_id');
            $table->timestamps();
            $table->foreign('safety_place_id')->references('id')->on('safety_places'); 
            $table->foreign('risk_user_id')->references('id')->on('risk_users'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_confirmations');
    }
};
