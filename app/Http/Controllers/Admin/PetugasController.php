<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{

    public function index()
    {
        $petugas = Petugas::with('user')->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'       => 'required|string|max:100|unique:users',
            'password'       => 'required|string|min:6',
            'nama_petugas'   => 'required|string|max:100',
            'no_hp'          => 'nullable|string|max:20',
            'alamat'         => 'nullable|string',
            'jenis_kelamin'  => 'nullable|in:Laki-laki,Perempuan',
        ]);

        // Simpan ke tabel users
        $user = User::create([
            'username'    => $validated['username'],
            'password'    => Hash::make($validated['password']),
            'level_user'  => 'petugas', // otomatis
        ]);

        // Simpan ke tabel petugas
        Petugas::create([
            'id_user'       => $user->id,
            'nama_petugas'  => $validated['nama_petugas'],
            'no_hp'         => $validated['no_hp'] ?? '-',
            'alamat'        => $validated['alamat'] ?? '-',
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? 'Laki-laki',
            'status'        => 'Aktif', // otomatis
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }


    public function show($id)
    {
        $petugas = Petugas::with('user')->findOrFail($id);
        return view('admin.petugas.show', compact('petugas'));
    }

    public function edit($id)
    {
        $petugas = Petugas::with('user')->findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);
        $user = $petugas->user;

        $validated = $request->validate([
            // User
            'username'       => 'required|string|max:100|unique:users,username,' . $user->id,
            'password'       => 'nullable|string|min:6',

            // Petugas
            'nama_petugas'   => 'required|string|max:100',
            'no_hp'          => 'required|string|max:15',
            'alamat'         => 'required|string',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'status'         => 'required|in:Aktif,Cuti,Resign',
        ]);

        $user->update([
            'username' => $validated['username'],
            'password' => $request->filled('password')
                            ? Hash::make($validated['password'])
                            : $user->password,
        ]);

        $petugas->update([
            'nama_petugas'  => $validated['nama_petugas'],
            'no_hp'         => $validated['no_hp'],
            'alamat'        => $validated['alamat'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'status'        => $validated['status'],
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);

        if ($petugas->user) {
            $petugas->user->delete(); // otomatis hapus petugas karena FK cascade
        } else {
            $petugas->delete();
        }

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }

}
