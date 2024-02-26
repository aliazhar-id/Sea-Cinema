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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transactions');
            $table->timestamps();
            $table->string('transaction_code')->nullable();
            $table->decimal('total_price', 8, 2);
            $table->string('booked_seats');
            $table->foreignId('id_user')->constrained('users', 'id_user');
            $table->foreignId('id_schedule')->references('id_schedule')->on('now_playing_schedules');
            $table->enum('status', ['success', 'failed', 'pending']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
