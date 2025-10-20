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
        Schema::create('cash_donations', function (Blueprint $table) {
            $table->id();
            $table->string("donation_tracking_number")->unique();
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("amount");
            $table->date("drop_off_date");
            $table->time("drop_off_time");
            $table->string("drop_off_address");
            $table->string("month");
            $table->string("year");
            $table->string("status")->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_donations');
    }
};
