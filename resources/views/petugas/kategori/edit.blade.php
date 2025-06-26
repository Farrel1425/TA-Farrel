@extends('layouts.petugas')

@section('title', 'Edit Kategori')

@section('content')
<div class="container mt-4">
    <h3>Edit Kategori</h3>

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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('petugas.kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text"
                           name="nama_kategori"
                           class="form-control"
                           id="nama_kategori"
                           value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              id="deskripsi"
                              rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('petugas.kategori.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
