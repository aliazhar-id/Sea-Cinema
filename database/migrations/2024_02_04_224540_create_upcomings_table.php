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
        Schema::create('upcomings', function (Blueprint $table) {
            $table->string('id_movie')->primary();
            $table->string('poster_path');
            $table->string('trailer_id')->nullable();
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->text('overview')->nullable();
            $table->float('rating')->nullable();
            $table->float('score')->nullable();
            $table->date('release_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upcomings');
    }
};
