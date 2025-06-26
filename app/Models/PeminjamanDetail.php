<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeminjamanDetail extends Model
{
    protected $table = 'peminjaman_detail'; // <- pakai plural jika sesuai migrasi
    protected $guarded = ['id'];
    protected $casts = [
        'tanggal_kembali' => 'datetime',
    ];


    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function petugas_pengembalian()
    {
        return $this->belongsTo(\App\Models\Petugas::class, 'id_petugas_pengembalian');
    }


    public function getDendaAttribute()
    {
        $tanggalHarusKembali = $this->peminjaman->tanggal_harus_kembali;
        $tanggalKembali = $this->tanggal_kembali ?? Carbon::today();

        if (!$tanggalHarusKembali || $tanggalKembali->lessThanOrEqualTo($tanggalHarusKembali)) {
            return 0;
        }

        // TUKAR urutan: sekarang tanggal kembali lebih besar
        $hariTerlambat = $tanggalHarusKembali->diffInDays($tanggalKembali);

        return $hariTerlambat * 1000; // tarif per hari
    }

}

