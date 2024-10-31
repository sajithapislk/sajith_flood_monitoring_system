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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guardian_name');
            $table->unsignedBigInteger('area_id');
            $table->string('email')->unique();
            $table->string('tp')->unique();
            $table->string('guardian_tp')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('tp_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->boolean('risk_alert')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
