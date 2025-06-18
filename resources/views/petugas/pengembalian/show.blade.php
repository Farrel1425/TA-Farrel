@extends('layouts.petugas')

@section('title', 'Detail Pengembalian')

@section('content')
<div class="container mt-4">
    <h4>Detail Transaksi Pengembalian</h4>
    <hr>
{{-- @dd($peminjaman) --}}

    <div class="mb-3">
        <strong>Nama Anggota:</strong> {{ $peminjaman->anggota->nama_anggota }} <br>
        <strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }} <br>
        <strong>Petugas Peminjaman:</strong> {{ $peminjaman->petugas->nama_petugas ?? '-' }}
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Judul Buku</th>
                <th>Status</th>
                <th>Tanggal Kembali</th>
                <th>Petugas Pengembalian</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman->details as $detail)
                <tr>
                    <td>{{ $detail->buku->judul }}</td>
                    <td>
                        <span class="badge {{ $detail->status == 'Dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ $detail->status }}
                        </span>
                    </td>
                    <td>
                        {{ $detail->tanggal_kembali ? \Carbon\Carbon::parse($detail->tanggal_kembali)->format('d M Y') : '-' }}
                    </td>
                   <td>
                        {{ $detail->petugas_pengembalian->name ?? '-' }}
                    </td>

                    <td>
                        @if($detail->denda > 0)
                       {{ $detail->denda }}
                            {{-- Rp {{ number_format($detail->denda, 0, ',', '.') }} --}}
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td>
                        @if($detail->status === 'Dipinjam')
                            <form action="{{ route('petugas.pengembalian.kembalikan', $detail->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm btn-success">Kembalikan</button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>Sudah Dikembalikan</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-secondary mt-3">← Kembali ke daftar</a>
</div>
@endsection
