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
        Schema::create('detail_schedules', function (Blueprint $table) {
            $table->id('id_schedule');
            $table->string('id_movie');
            $table->date('date');
            $table->string('start_at');
            $table->json('seats');
            $table->string('studio');
            $table->integer('price');
            $table->string('format')->nullable();
            $table->foreign('id_movie')->references('id_movie')->on('schedules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_schedules');
    }
};
