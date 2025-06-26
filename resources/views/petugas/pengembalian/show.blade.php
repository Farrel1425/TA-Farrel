@extends('layouts.petugas')

@section('title', 'Detail Pengembalian')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-book-open me-2"></i>
                        Detail Transaksi Pengembalian
                    </h2>
                    <p class="text-muted mb-0">Informasi lengkap transaksi peminjaman dan pengembalian buku</p>
                </div>
                <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Info Peminjaman -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Peminjaman
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Nama Anggota:</label>
                                <p class="form-control-plaintext">{{ $peminjaman->anggota->nama_anggota }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Tanggal Pinjam:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-alt me-1 text-primary"></i>
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Petugas Peminjaman:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-user me-1 text-success"></i>
                                    {{ $peminjaman->petugas->nama_petugas ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">ID Transaksi:</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-info text-dark">#{{ $peminjaman->id }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Buku -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>
                        Daftar Buku yang Dipinjam
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="25%">Judul Buku</th>
                                    <th scope="col" width="12%">Status</th>
                                    <th scope="col" width="15%">Tanggal Kembali</th>
                                    <th scope="col" width="18%">Petugas Pengembalian</th>
                                    <th scope="col" width="12%">Denda</th>
                                    <th scope="col" width="13%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman->details as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-book text-primary me-2"></i>
                                            <div>
                                                <strong>{{ $detail->buku->judul }}</strong>
                                                @if($detail->buku->pengarang)
                                                    <br><small class="text-muted">{{ $detail->buku->pengarang }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($detail->status === 'Dipinjam')
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-clock me-1"></i>
                                                {{ $detail->status }}
                                            </span>
                                        @elseif($detail->status === 'Dikembalikan')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>
                                                {{ $detail->status }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">{{ $detail->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($detail->tanggal_kembali)
                                            <i class="fas fa-calendar-check text-success me-1"></i>
                                            {{ \Carbon\Carbon::parse($detail->tanggal_kembali)->format('d M Y') }}
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-minus me-1"></i>
                                                Belum dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($detail->petugas_pengembalian)
                                            <i class="fas fa-user-check text-success me-1"></i>
                                            {{ $detail->petugas_pengembalian->nama_petugas }}
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-minus me-1"></i>
                                                -
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($detail->denda > 0)
                                            <span class="badge bg-danger">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                Rp {{ number_format($detail->denda, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>
                                                Tidak Ada
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($detail->status === 'Dipinjam')
                                            <form action="{{ route('petugas.pengembalian.kembalikan', $detail->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-success"
                                                        onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                                    <i class="fas fa-undo me-1"></i>
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-check-double me-1"></i>
                                                Sudah Dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($peminjaman->details->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada detail buku</h5>
                            <p class="text-muted">Belum ada buku yang tercatat dalam transaksi ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Summary -->
    @php
        $totalBuku = $peminjaman->details->count();
        $bukuKembali = $peminjaman->details->where('status', 'Dikembalikan')->count();
        $bukuBelumKembali = $peminjaman->details->where('status', 'Dipinjam')->count();
        $totalDenda = $peminjaman->details->sum('denda');
    @endphp

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>
                        Ringkasan Transaksi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="border-end">
                                <h4 class="text-primary mb-1">{{ $totalBuku }}</h4>
                                <small class="text-muted">Total Buku</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border-end">
                                <h4 class="text-success mb-1">{{ $bukuKembali }}</h4>
                                <small class="text-muted">Sudah Dikembalikan</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border-end">
                                <h4 class="text-warning mb-1">{{ $bukuBelumKembali }}</h4>
                                <small class="text-muted">Belum Dikembalikan</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-danger mb-1">Rp {{ number_format($totalDenda, 0, ',', '.') }}</h4>
                            <small class="text-muted">Total Denda</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush

@endsection
