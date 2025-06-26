<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'username' => 'admin1',
            'password' => Hash::make('123123'), // ganti password jika perlu
            'level_user' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ========== PETUGAS ==========
        $petugasUserId = DB::table('users')->insertGetId([
            'username' => 'Farrel',
            'password' => Hash::make('123123'), // password default
            'level_user' => 'petugas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('petugas')->insert([
            'id_user' => $petugasUserId,
            'nama_petugas' => 'Made Farrel Sind Cahyadi',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Petugas Nomor 1',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ========== ANGGOTA ==========
        $anggotaUserId = DB::table('users')->insertGetId([
            'username' => '220030060',
            'password' => Hash::make('123123'), // password default
            'level_user' => 'anggota',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('anggota')->insert([
            'id_user' => $anggotaUserId,
            'nis' => '220030060',
            'nama_anggota' => 'Putu Putra Wibawa',
            'no_hp' => '089876543210',
            'alamat' => 'Jl. Anggota Nomor 1',
            'jenis_kelamin' => 'Laki-laki',
            'status_anggota' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
