@extends('layouts.petugas')

@section('title', 'Edit Anggota')

@section('content')
<div class="container mt-4">
    <h3>Edit Anggota</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops! Ada kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('petugas.anggota.update', $anggota->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_anggota" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_anggota" id="nama_anggota" class="form-control"
                value="{{ old('nama_anggota', $anggota->nama_anggota) }}" required>
        </div>

        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" name="nis" id="nis" class="form-control"
                value="{{ old('nis', $anggota->nis) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control"
                value="{{ old('no_hp', $anggota->no_hp) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $anggota->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status_anggota" class="form-label">Status Anggota</label>
            <select name="status_anggota" id="status_anggota" class="form-select" required>
                <option value="Aktif" {{ old('status_anggota', $anggota->status_anggota) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Non-Aktif" {{ old('status_anggota', $anggota->status_anggota) == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('petugas.anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
