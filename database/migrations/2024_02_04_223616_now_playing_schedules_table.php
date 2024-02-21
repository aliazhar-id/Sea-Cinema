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
        Schema::create('now_playing_schedules', function (Blueprint $table) {
            $table->id('id_schedule');
            $table->string('id_movie');
            $table->date('date');
            $table->string('start_at');
            $table->json('seats')->default('{"A01":false,"A02":false,"A03":false,"A04":false,"A05":false,"A06":false,"A07":false,"A08":false,"A09":false,"A10":false,"A11":false,"A12":false,"B01":false,"B02":false,"B03":false,"B04":false,"B05":false,"B06":false,"B07":false,"B08":false,"B09":false,"B10":false,"B11":false,"B12":false,"C01":false,"C02":false,"C03":false,"C04":false,"C05":false,"C06":false,"C07":false,"C08":false,"C09":false,"C10":false,"C11":false,"C12":false,"D01":false,"D02":false,"D03":false,"D04":false,"D05":false,"D06":false,"D07":false,"D08":false,"D09":false,"D10":false,"D11":false,"D12":false,"E01":false,"E02":false,"E03":false,"E04":false,"E05":false,"E06":false,"E07":false,"E08":false,"E09":false,"E10":false,"E11":false,"E12":false,"F01":false,"F02":false,"F03":false,"F04":false,"F05":false,"F06":false,"F07":false,"F08":false,"F09":false,"F10":false,"F11":false,"F12":false}');
            $table->string('studio');
            $table->integer('price');
            $table->string('format')->nullable();
            $table->foreign('id_movie')->references('id_movie')->on('now_playings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('now_playing_schedules');
    }
};
