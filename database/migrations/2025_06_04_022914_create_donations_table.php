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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('reference')->nullable();
            $table->string('proof')->nullable(); // image path
            $table->string('year')->nullable(); // for cash donations
            $table->string('month')->nullable(); // for cash donations
            $table->string('address')->nullable(); // for cash donations
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
