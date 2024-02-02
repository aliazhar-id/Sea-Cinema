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
    Schema::create('users', function (Blueprint $table) {
      $table->id('id_user');
      $table->string('name');
      $table->string('username')->unique();
      $table->string('email')->unique();
      $table->date('dob');
      $table->string('password');
      $table->integer('balance')->default(0);
      $table->string('image')->nullable();
      $table->enum('role', ['user', 'admin', 'superadmin']);
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
