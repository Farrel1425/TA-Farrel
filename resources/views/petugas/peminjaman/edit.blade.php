@extends('layouts.petugas')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="container mt-4">
    <h3>Edit Data Peminjaman</h3>

    <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('petugas.peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_anggota" class="form-label">Anggota</label>
            <select name="id_anggota" id="id_anggota" class="form-select" required>
                @foreach($anggotas as $anggota)
                    <option value="{{ $anggota->id }}" {{ $peminjaman->id_anggota == $anggota->id ? 'selected' : '' }}>
                        {{ $anggota->nama }} ({{ $anggota->nis }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Buku - Select2 Multiple --}}
        <div class="mb-3">
            <label for="id_buku" class="form-label">Pilih Buku (boleh lebih dari satu)</label>
            <select name="id_buku[]" id="id_buku" class="form-select" multiple="multiple" required>
                @foreach ($peminjaman->details as $detail)
                    <option value="{{ $detail->buku->id }}" selected>{{ $detail->buku->judul }}</option>
                @endforeach
            </select>

            @error('id_buku')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_harus_kembali" class="form-label">Tanggal Harus Kembali</label>
            <input type="date" name="tanggal_harus_kembali" class="form-control" value="{{ $peminjaman->tanggal_harus_kembali->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#id_buku').select2({
                placeholder: 'Cari dan pilih buku...',
                ajax: {
                    url: '{{ route('api.buku.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(item => ({
                                id: item.id,
                                text: item.judul
                            }))
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endpush
