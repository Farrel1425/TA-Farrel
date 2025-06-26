@extends('layouts.petugas')

@section('title', 'Detail Denda')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-exclamation-triangle me-2 text-warning"></i>
                        Detail Denda
                    </h2>
                    <p class="text-muted mb-0">Informasi lengkap denda peminjaman buku</p>
                </div>
                <a href="{{ route('petugas.denda.index') }}" class="btn btn-secondary">
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

    <div class="row">
        <!-- Informasi Denda -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Denda
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">ID Denda:</label>
                        <p class="form-control-plaintext">
                            <span class="badge bg-info text-dark">#{{ $denda->id }}</span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Nama Anggota:</label>
                        <p class="form-control-plaintext">
                            <i class="fas fa-user me-1 text-primary"></i>
                            {{ $denda->peminjaman->anggota->nama_anggota }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Tanggal Pinjam:</label>
                        <p class="form-control-plaintext">
                            <i class="fas fa-calendar-alt me-1 text-primary"></i>
                            {{ \Carbon\Carbon::parse($denda->peminjaman->tanggal_pinjam)->format('d M Y') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Status Denda:</label>
                        <p class="form-control-plaintext">
                            @if($denda->status_denda == 'Lunas')
                                <span class="badge bg-success fs-6">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ $denda->status_denda }}
                                </span>
                            @elseif($denda->status_denda == 'Belum Lunas')
                                <span class="badge bg-danger fs-6">
                                    <i class="fas fa-times-circle me-1"></i>
                                    {{ $denda->status_denda }}
                                </span>
                            @else
                                <span class="badge bg-warning text-dark fs-6">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $denda->status_denda }}
                                </span>
                            @endif
                        </p>
                    </div>

                    <!-- Total Denda dengan Highlight -->
                    <div class="border-top pt-3">
                        <div class="text-center">
                            <h6 class="text-muted mb-1">Total Denda</h6>
                            <h3 class="text-danger mb-0">
                                <i class="fas fa-money-bill-wave me-1"></i>
                                Rp {{ number_format($denda->jumlah, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rincian Buku -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>
                        Rincian Buku yang Dipinjam
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="35%">Judul Buku</th>
                                    <th scope="col" width="15%">Status</th>
                                    <th scope="col" width="20%">Tgl Kembali</th>
                                    <th scope="col" width="25%">Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($denda->peminjaman->details as $index => $detail)
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
                                        @if($detail->denda > 0)
                                            <span class="badge bg-danger fs-6">
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
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Tidak ada detail buku</h5>
                                        <p class="text-muted">Belum ada buku yang tercatat dalam transaksi ini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Aksi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2 flex-wrap">
                        @if($denda->status_denda != 'Lunas')
                            <form action="{{ route('petugas.denda.lunasi', $denda->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg"
                                        onclick="return confirm('Apakah Anda yakin ingin menandai denda ini sebagai lunas?')">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Tandai Lunas
                                </button>
                            </form>
                        @else
                            <button class="btn btn-success btn-lg" disabled>
                                <i class="fas fa-check-double me-1"></i>
                                Sudah Lunas
                            </button>
                        @endif

                        <a href="{{ route('petugas.denda.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-list me-1"></i>
                            Lihat Semua Denda
                        </a>

                        <!-- Tombol Print -->
                        <button onclick="window.print()" class="btn btn-info btn-lg">
                            <i class="fas fa-print me-1"></i>
                            Cetak Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Statistics -->
    @php
        $totalBuku = $denda->peminjaman->details->count();
        $bukuDenda = $denda->peminjaman->details->where('denda', '>', 0)->count();
        $bukuKembali = $denda->peminjaman->details->where('status', 'Dikembalikan')->count();
        $avgDenda = $bukuDenda > 0 ? $denda->peminjaman->details->avg('denda') : 0;
    @endphp

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistik Denda
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
                                <h4 class="text-danger mb-1">{{ $bukuDenda }}</h4>
                                <small class="text-muted">Buku Berdenda</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border-end">
                                <h4 class="text-success mb-1">{{ $bukuKembali }}</h4>
                                <small class="text-muted">Sudah Dikembalikan</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-warning mb-1">Rp {{ number_format($avgDenda, 0, ',', '.') }}</h4>
                            <small class="text-muted">Rata-rata Denda</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media print {
        .btn, .card-header, .border-end {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }

    .badge.fs-6 {
        font-size: 0.875rem !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Konfirmasi sebelum melunasi
    document.addEventListener('DOMContentLoaded', function() {
        const lunasForm = document.querySelector('form[action*="lunasi"]');
        if (lunasForm) {
            lunasForm.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menandai denda ini sebagai lunas? Tindakan ini tidak dapat dibatalkan.')) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
@endpush

@endsection
