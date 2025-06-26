@extends('layouts.petugas')

@section('title', 'Daftar Pengembalian Buku')

@section('content')
<div class="container mt-4">
    <h4>Daftar Transaksi Belum Selesai</h4>
    <p class="text-muted">Berikut daftar transaksi peminjaman yang masih memiliki buku yang belum dikembalikan.</p>
    <hr>

    @if($peminjamanAktif->isEmpty())
        <div class="alert alert-info">Semua buku telah dikembalikan.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead style="background-color: #2563eb; color: white;" class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jumlah Belum Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamanAktif as $index => $peminjaman)
                    @php
                        $belumKembali = $peminjaman->details->where('status', 'Dipinjam')->count();
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peminjaman->anggota->nama_anggota }}</td>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                {{ $belumKembali }} Buku
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('petugas.pengembalian.show', $peminjaman->id) }}" class="btn btn-primary btn-sm">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
