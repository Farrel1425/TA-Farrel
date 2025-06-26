@extends('layouts.petugas')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container mt-4">
    <h3>Tambah Kategori Buku</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops! Ada kesalahan pada input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('petugas.kategori.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text"
                   name="nama_kategori"
                   id="nama_kategori"
                   class="form-control"
                   value="{{ old('nama_kategori') }}"
                   required
                   maxlength="50"
                   placeholder="Contoh: Fiksi, Sejarah, Sains">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi <small class="text-muted">(opsional)</small></label>
            <textarea name="deskripsi"
                      id="deskripsi"
                      class="form-control"
                      rows="3"
                      maxlength="255"
                      placeholder="Deskripsi kategori buku, misalnya buku-buku fiksi modern">{{ old('deskripsi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('petugas.kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
