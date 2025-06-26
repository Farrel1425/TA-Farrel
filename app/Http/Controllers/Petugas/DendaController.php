<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DendaController extends Controller
{
   public function index()
    {
        $denda = Denda::with('peminjaman.anggota')
            ->where('status_denda', 'Belum Lunas')
            ->latest()
            ->get();
        return view('petugas.denda.index', compact('denda'));
    }

    public function show($id)
    {
        $denda = Denda::with('peminjaman.details.buku', 'peminjaman.anggota', 'peminjaman.petugas')->findOrFail($id);
        return view('petugas.denda.show', compact('denda'));
    }

    public function lunasi($id)
    {
        $denda = Denda::findOrFail($id);
        $denda->update([
            'status_denda' => 'Lunas',
            'tanggal_pembayaran' => Carbon::now(),
        ]);

        return back()->with('success', 'Status denda berhasil diubah menjadi Lunas.');
    }

    // public function exportPdf($id)
    // {
    //     $denda = Denda::with('peminjaman.details.buku', 'peminjaman.anggota', 'peminjaman.petugas')->findOrFail($id);
    //     $pdf = Pdf::loadView('petugas.denda.export', compact('denda'));

    //     return $pdf->download('denda-' . $denda->id . '.pdf');
    // }
}
