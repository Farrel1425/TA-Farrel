@extends('layouts.admin')

@section('title', 'Edit Petugas')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Edit Data Petugas</h2>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda:
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        {{-- Kolom Kiri --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nama_petugas" class="form-label">Nama Petugas</label>
                <input type="text" name="nama_petugas" class="form-control"
                       value="{{ old('nama_petugas', $petugas->nama_petugas) }}" required>
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control"
                       value="{{ old('no_hp', $petugas->no_hp) }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $petugas->alamat) }}</textarea>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control"
                       value="{{ old('username', $petugas->user->username) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password Baru <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $petugas->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $petugas->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif" {{ old('status', $petugas->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Cuti" {{ old('status', $petugas->status) == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                    <option value="Resign" {{ old('status', $petugas->status) == 'Resign' ? 'selected' : '' }}>Resign</option>
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
    </div>
</form>
@endsection
