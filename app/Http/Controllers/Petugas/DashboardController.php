<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kunjungan;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        // Statistik Utama
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::count();

        // Buku yang sedang dipinjam (status masih Dipinjam)
        $bukuDipinjam = PeminjamanDetail::where('status', 'Dipinjam')->count();

        // Total denda aktif (belum lunas)
         $totalDendaAktif = DB::table('peminjaman_detail as pd')
                ->join('peminjaman as p', 'pd.id_peminjaman', '=', 'p.id')
                ->where('pd.status', 'Dipinjam')
                ->whereNull('pd.tanggal_kembali')
                ->whereDate('p.tanggal_harus_kembali', '<', now())
                ->selectRaw('SUM(DATEDIFF(CURDATE(), p.tanggal_harus_kembali) * 1000) as total')
                ->value('total') ?? 0;

        // Buku akan jatuh tempo (2 hari lagi dari hari ini)
        $bukuAkanJatuhTempo = PeminjamanDetail::where('status', 'Dipinjam')
            ->whereHas('peminjaman', function ($query) {
                $query->whereDate('tanggal_harus_kembali', Carbon::now()->addDays(2));
            })
            ->count();

        // Buku yang terlambat dikembalikan
        $bukuTerlambat = PeminjamanDetail::where('status', 'Dipinjam')
            ->whereHas('peminjaman', function ($query) {
                $query->whereDate('tanggal_harus_kembali', '<', Carbon::now());
            })
            ->count();

        // Buku dengan stok sedikit (misalnya stok < 3)
        $stokMenupis = Buku::where('stok', '<', 3)->count();

        // Trend anggota bulan ini vs bulan lalu
        $anggotaBulanIni = Anggota::whereMonth('created_at', Carbon::now()->month)->count();
        $anggotaBulanLalu = Anggota::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $trendAnggota = $anggotaBulanLalu > 0
            ? number_format((($anggotaBulanIni - $anggotaBulanLalu) / $anggotaBulanLalu) * 100, 0)
            : 0;

        // Penambahan buku bulan lalu
        $bukuBulanLalu = Buku::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();

        // Aktivitas Terbaru (Contoh dummy)
        $aktivitasTerbaru = [
            [
                'title' => 'Pengembalian Buku',
                'description' => 'Anggota mengembalikan 2 buku',
                'formatted_time' => now()->subMinutes(20)->diffForHumans(),
                'icon' => 'fas fa-undo',
                'avatar_class' => 'success',
            ],
            [
                'title' => 'Peminjaman Baru',
                'description' => 'Anggota meminjam 3 buku',
                'formatted_time' => now()->subHours(2)->diffForHumans(),
                'icon' => 'fas fa-book',
                'avatar_class' => 'primary',
            ],
        ];

        // Data untuk grafik peminjaman dan kunjungan 7 hari terakhir
        $labels = [];
        $peminjamanChart = [];
        $kunjunganChart = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::now()->subDays($i)->translatedFormat('D');

            $peminjamanChart[] = Peminjaman::whereDate('created_at', $tanggal)->count();
            $kunjunganChart[] = Kunjungan::whereDate('created_at', $tanggal)->count();
        }

        $chartData = [
            'labels' => $labels,
            'peminjaman' => $peminjamanChart,
            'kunjungan' => $kunjunganChart,
        ];

        return view('petugas.dashboard', compact(
            'totalAnggota',
            'totalBuku',
            'bukuDipinjam',
            'totalDendaAktif',
            'bukuAkanJatuhTempo',
            'bukuTerlambat',
            'stokMenupis',
            'trendAnggota',
            'bukuBulanLalu',
            'chartData',
            'aktivitasTerbaru'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
