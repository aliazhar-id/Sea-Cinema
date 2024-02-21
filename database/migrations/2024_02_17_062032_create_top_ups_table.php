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
    Schema::create('top_ups', function (Blueprint $table) {
      $table->ulid('id_topup')->primary();;
      $table->foreignId('id_user')->constrained('users', 'id_user');
      $table->integer('amount');
      $table->string('proof_image');
      $table->enum('status', ['pending', 'approved', 'declined']);
      $table->foreignId('id_admin')->constrained('users', 'id_user')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('top_ups');
  }
};
