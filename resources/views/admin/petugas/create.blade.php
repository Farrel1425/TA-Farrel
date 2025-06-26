@extends('layouts.admin')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Petugas Baru</h2>

    <form action="{{ route('admin.petugas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nama_petugas" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="nama_petugas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
