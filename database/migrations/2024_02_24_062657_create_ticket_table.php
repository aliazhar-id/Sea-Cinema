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
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->nullable();
            $table->string('ticket_code')->nullable();
            $table->string('seats')->nullable();
            $table->string('studio')->nullable();
            $table->foreignId('id_user')->constrained('users', 'id_user');
            $table->foreignId('id_transaction')->references('id_transactions')->on('transactions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
