@extends('layouts.petugas')

@section('title', 'Daftar Denda')

@section('content')
<div class="container mt-4">
    <h4>Daftar Transaksi dengan Denda</h4>
    <p class="text-muted">Berikut daftar transaksi peminjaman yang memiliki denda keterlambatan.</p>
    <hr>

    @if($denda->isEmpty())
        <div class="alert alert-info">Tidak ada transaksi yang memiliki denda.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead style="background-color: #2563eb; color: white;" class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Total Denda</th>
                    <th>Status Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($denda as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->peminjaman->anggota->nama_anggota }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>
                        <span class="badge bg-danger">
                            Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $item->status_denda === 'Lunas' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $item->status_denda }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('petugas.denda.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
