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
         Schema::table('peminjaman_detail', function (Blueprint $table) {
            // Hapus foreign key lama dulu
            $table->dropForeign(['id_petugas_pengembalian']);

            // Tambahkan foreign key baru ke tabel users
            $table->foreign('id_petugas_pengembalian')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('peminjaman_detail', function (Blueprint $table) {
            // Kembalikan ke FK ke tabel petugas (jika rollback)
            $table->dropForeign(['id_petugas_pengembalian']);

            $table->foreign('id_petugas_pengembalian')
                  ->references('id')
                  ->on('petugas')
                  ->onDelete('set null');
        });
    }
};
