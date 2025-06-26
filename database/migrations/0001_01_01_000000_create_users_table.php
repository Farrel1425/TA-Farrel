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
            // Default columns Breeze
            $table->id();
            $table->string('password');
            $table->rememberToken();
            $table->enum('level_user', ['admin', 'petugas', 'anggota'])->default('anggota');
            $table->string('username')->unique(); // Opsional jika ingin login dengan username
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
      }
};
