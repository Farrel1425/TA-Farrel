<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Denda;
use App\Models\Kunjungan;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
    {
        $userId = Auth::id();
        $anggota = Anggota::where('id_user', $userId)->first();

        if (!$anggota) {
            abort(403, 'Data anggota tidak ditemukan.');
        }

        $idAnggota = $anggota->id;

        // Total buku yang sedang dipinjam (status Dipinjam)
        $totalDipinjam = PeminjamanDetail::whereHas('peminjaman', function ($query) use ($idAnggota) {
            $query->where('id_anggota', $idAnggota);
        })->where('status', 'Dipinjam')->count();

        // Hitung total denda real-time dari peminjaman_detail yang statusnya Dipinjam dan lewat tanggal harus kembali
        $totalDendaBelumLunas = PeminjamanDetail::where('status', 'Dipinjam')
        ->whereHas('peminjaman', function ($query) use ($idAnggota) {
            $query->where('id_anggota', $idAnggota)
                ->where('tanggal_harus_kembali', '<', Carbon::today()); // Sudah jatuh tempo
        })
        ->with('peminjaman') // untuk akses tanggal_harus_kembali
        ->get()
        ->sum(function ($detail) {
            $tanggalHarusKembali = $detail->peminjaman->tanggal_harus_kembali ?? null;

            if ($tanggalHarusKembali && Carbon::parse($tanggalHarusKembali)->lt(Carbon::today())) {
                $hariTerlambat = Carbon::parse($tanggalHarusKembali)->diffInDays(Carbon::today());
                return $hariTerlambat * 1000; // 1000 per hari
            }

            return 0;
        });

        // Riwayat peminjaman terakhir (5 data)
        $riwayatPeminjaman = Peminjaman::with(['details.buku'])
            ->where('id_anggota', $idAnggota)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Statistik kunjungan selama 7 hari terakhir
        $kunjungan = Kunjungan::where('id_anggota', $idAnggota)
            ->whereBetween('waktu_kunjungan', [now()->subDays(6), now()])
            ->selectRaw('DATE(waktu_kunjungan) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Siapkan data untuk chart
        $chartData = [
            'labels' => [],
            'kunjungan' => [],
        ];

        $tanggalList = collect(range(0, 6))->map(fn($i) => now()->subDays(6 - $i)->format('Y-m-d'));

        foreach ($tanggalList as $tanggal) {
            $chartData['labels'][] = \Carbon\Carbon::parse($tanggal)->translatedFormat('D');
            $chartData['kunjungan'][] = $kunjungan->firstWhere('tanggal', $tanggal)->total ?? 0;
        }

        return view('anggota.dashboard', [
            'totalDipinjam' => $totalDipinjam,
            'totalDendaBelumLunas' => $totalDendaBelumLunas,
            'riwayatPeminjaman' => $riwayatPeminjaman,
            'chartData' => $chartData,
        ]);
    }

}
