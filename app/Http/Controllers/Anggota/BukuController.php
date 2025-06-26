<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
     public function index(Request $request)
    {
        // Ambil keyword dari form pencarian
        $keyword = $request->input('search');

        // Query buku berdasarkan judul atau penulis
        $bukuQuery = Buku::query();

        if ($keyword) {
            $bukuQuery->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('penulis', 'like', "%{$keyword}%");
            });
        }

        // Ambil 8 buku per halaman
        $buku = $bukuQuery->paginate(8);

        return view('anggota.buku.index', compact('buku', 'keyword'));
    }
}
