<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
  {
    Schema::create('schedules', function (Blueprint $table) {
      $table->id();
      $table->string('id_schedule');
      $table->foreignId('movie_id')->constrained();
      $table->string('id_movie');
      $table->integer('price')->nullable();
      $table->date('date');
      $table->string('startat');
      $table->json('seats');
      $table->string('studio');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('schedules');
  }
};
