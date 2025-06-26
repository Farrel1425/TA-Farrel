<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    // Menampilkan daftar transaksi peminjaman yang masih memiliki buku yang belum dikembalikan
    public function index()
    {
        $peminjamanAktif = Peminjaman::whereHas('details', function ($query) {
            $query->where('status', 'Dipinjam');
        })->with(['anggota'])->get();

        return view('petugas.pengembalian.index', compact('peminjamanAktif'));
    }

    // Menampilkan detail buku-buku yang dipinjam dalam 1 transaksi
    public function show($id)
    {
        $peminjaman = Peminjaman::with([
            'anggota',
            'petugas',
            'details.buku',
            'details.petugas_pengembalian'
        ])->findOrFail($id);


        return view('petugas.pengembalian.show', compact('peminjaman'));
    }

    // Proses tombol "Kembalikan" untuk satu buku
     public function kembalikan($id)
    {
        $detail = PeminjamanDetail::with('peminjaman')->findOrFail($id);



        if (strtolower($detail->status) !== 'dipinjam') {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        DB::beginTransaction();

        try {
            $today = Carbon::now();
            $tanggalHarusKembali = Carbon::parse($detail->peminjaman->tanggal_harus_kembali);
            $selisihHari = $today->diffInDays($tanggalHarusKembali, false);
            $jumlahDenda = $today->greaterThan($tanggalHarusKembali) ? $selisihHari * 1000 : 0;

             // ✅ Kembalikan stok buku
            $detail->buku->increment('stok');

            // ✅ Update status buku menjadi "Tersedia" jika stok > 0
            if ($detail->buku->stok > 0 && $detail->buku->status_buku !== 'Tersedia') {
                $detail->buku->update(['status_buku' => 'Tersedia']);
            }

            $detail->update([
                'tanggal_kembali' => $today,
                'status' => 'Dikembalikan',
                'denda' => abs($jumlahDenda),
                'id_petugas_pengembalian' => Auth::user()->petugas->id ?? null,
            ]);

         // Cek apakah semua buku sudah dikembalikan
        $peminjaman = Peminjaman::with('details')->find($detail->id_peminjaman);

        $semuaSudahKembali = $peminjaman->details->every(function ($d) {
            return in_array($d->status, ['Dikembalikan', 'Terlambat']);
        });

        if ($semuaSudahKembali) {
            // Cek apakah denda sudah pernah disimpan sebelumnya
            $sudahAdaDenda = $peminjaman->denda()->exists();

            if (!$sudahAdaDenda) {
                $totalDenda = $peminjaman->details->sum('denda');

                \App\Models\Denda::create([
                    'id_peminjaman' => $peminjaman->id,
                    'jumlah' => $totalDenda,
                    'status_denda' => $totalDenda > 0 ? 'Belum Lunas' : 'Lunas',
                    'tanggal_pembayaran' => null,
                    'id_petugas' => Auth::user()->petugas->id ?? null,
                ]);
            }
        }

            DB::commit();
            return back()->with('success', 'Buku berhasil dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengembalikan buku: ' . $e->getMessage());
        }
    }


}
