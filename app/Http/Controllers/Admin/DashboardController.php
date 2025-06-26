<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kunjungan;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Petugas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function index()
        {
            $totalBuku = Buku::where('stok', '>', 0)
                        ->where('status_buku', 'Tersedia')
                        ->count();

            $totalAnggota = Anggota::count();
            $totalPetugas = Petugas::count();

            $totalPeminjaman = Peminjaman::count();

            $totalSedangDipinjam = PeminjamanDetail::where('status', 'Dipinjam')->count();

            $kunjunganHariIni = Kunjungan::whereDate('waktu_kunjungan', today())->count();

            $kunjunganMingguIni = Kunjungan::whereBetween('waktu_kunjungan', [now()->subDays(6), now()])
                ->count();

            $totalDendaAktif = DB::table('peminjaman_detail as pd')
                ->join('peminjaman as p', 'pd.id_peminjaman', '=', 'p.id')
                ->where('pd.status', 'Dipinjam')
                ->whereNull('pd.tanggal_kembali')
                ->whereDate('p.tanggal_harus_kembali', '<', now())
                ->selectRaw('SUM(DATEDIFF(CURDATE(), p.tanggal_harus_kembali) * 1000) as total')
                ->value('total') ?? 0;

            // 🔥 Pola Aktivitas Mingguan (heatmap)
            $weeklyActivity = DB::table('kunjungan')
                ->selectRaw('DAYOFWEEK(waktu_kunjungan) as day, COUNT(*) as total')
                ->whereBetween('waktu_kunjungan', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ])
                ->groupBy('day')
                ->pluck('total', 'day')
                ->toArray();

            // 🔁 Ubah ke format Senin–Minggu (Sen=1, Min=7)
            $activityMap = [];
            for ($i = 2; $i <= 8; $i++) {
                $dayIndex = $i > 7 ? 1 : $i;
                $activityMap[] = $weeklyActivity[$dayIndex] ?? 0;
            }

            // Ambil data peminjaman per bulan (12 bulan terakhir)
            $peminjamanBulanan = DB::table('peminjaman')
                ->selectRaw('DATE_FORMAT(tanggal_pinjam, "%Y-%m") as bulan, COUNT(*) as total')
                ->where('tanggal_pinjam', '>=', now()->subMonths(11)->startOfMonth())
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->pluck('total', 'bulan');

            // Persiapkan label dan data agar semua 12 bulan selalu tampil
            $labels = [];
            $data = [];
            for ($i = 11; $i >= 0; $i--) {
                $bulan = now()->subMonths($i)->format('Y-m');
                $labels[] = \Carbon\Carbon::parse($bulan)->translatedFormat('F Y');
                $data[] = $peminjamanBulanan[$bulan] ?? 0;
            }

            // Ambil 5 kategori buku paling populer berdasarkan jumlah peminjaman
            $kategoriPopuler = DB::table('kategori as k')
                ->select('k.nama_kategori', DB::raw('COUNT(pd.id) as total'))
                ->leftJoin('buku as b', 'k.id', '=', 'b.id_kategori')
                ->leftJoin('peminjaman_detail as pd', 'b.id', '=', 'pd.id_buku')
                ->groupBy('k.nama_kategori')
                ->orderByDesc('total')
                ->limit(5)
                ->get();

            // Hitung total semua untuk persentase
            $totalPeminjaman = $kategoriPopuler->sum('total');

            return view('admin.dashboard', compact(
                'totalBuku',
                'totalAnggota',
                'totalPetugas',
                'totalPeminjaman',
                'totalSedangDipinjam',
                'totalDendaAktif',
                'kunjunganHariIni',
                'kunjunganMingguIni',
                'activityMap',
                'labels',
                'data',
                'kategoriPopuler',
                'totalPeminjaman',
            ));
        }

}
