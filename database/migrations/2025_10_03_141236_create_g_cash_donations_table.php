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
        Schema::create('g_cash_donations', function (Blueprint $table) {
            $table->id();
            $table->string("donation_tracking_number")->unique();
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("amount");
            $table->string("paymongo_id");
            $table->string("status")->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_cash_donations');
    }
};
