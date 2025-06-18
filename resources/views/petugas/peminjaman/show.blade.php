@extends('layouts.petugas')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="container mt-4">
    <h3>Detail Peminjaman</h3>
    <hr>

    <p><strong>Nama Anggota:</strong> {{ $peminjaman->anggota->nama_anggota }}</p>
    <p><strong>Petugas:</strong> {{ $peminjaman->petugas->nama_petugas }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam->format('d M Y') }}</p>
    <p><strong>Tanggal Harus Kembali:</strong> {{ $peminjaman->tanggal_harus_kembali->format('d M Y') }}</p>

    <h5 class="mt-4">Daftar Buku yang Dipinjam</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman->details as $detail)
                <tr>
                    <td>{{ $detail->buku->judul }}</td>
                    <td>{{ $detail->tanggal_kembali ? \Carbon\Carbon::parse($detail->tanggal_kembali)->format('d M Y') : '-' }}</td>
                    <td>{{ $detail->status }}</td>
                    <td>
                        @if($detail->denda > 0)
                            Rp {{ number_format($detail->denda, 0, ',', '.') }}
                        @else
                            Tidak ada
                        @endif
                    </td>
                </tr>

{{-- <pre>{{ dd($peminjaman->details->pluck('denda')) }}</pre> --}}

            @endforeach
        </tbody>
    </table>
     <hr>
                <h5>Total Denda: Rp {{ number_format($peminjaman->total_denda, 0, ',', '.') }}</h5>

    <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
