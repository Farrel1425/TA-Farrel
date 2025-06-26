@extends('layouts.petugas')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-clipboard-list me-2"></i>
                        Detail Peminjaman
                    </h2>
                    <p class="text-muted mb-0">Informasi lengkap tentang data peminjaman buku perpustakaan</p>
                </div>
                <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary">
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

    <!-- Informasi Peminjaman -->
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
                    <!-- Nama Anggota Prominent -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="text-center p-3 bg-light rounded">
                                <label class="form-label fw-bold text-dark">Nama Anggota:</label>
                                <h3 class="fw-bold text-primary mb-0">
                                    <i class="fas fa-user-graduate me-2"></i>
                                    {{ $peminjaman->anggota->nama_anggota }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Petugas:</label>
                                <p class="form-control-plaintext fs-5 fw-bold text-success">
                                    <i class="fas fa-user-tie me-2"></i>
                                    {{ $peminjaman->petugas->nama_petugas }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Total Buku:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-books me-1 text-info"></i>
                                    <span class="badge bg-info fs-6">{{ $peminjaman->details->count() }} Buku</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Tanggal Pinjam:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-check me-1 text-success"></i>
                                    {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                                    <br><small class="text-muted">{{ $peminjaman->tanggal_pinjam->format('H:i') }} WIB</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Tanggal Harus Kembali:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-times me-1 text-danger"></i>
                                    {{ $peminjaman->tanggal_harus_kembali->format('d M Y') }}
                                    @php
                                        $isOverdue = \Carbon\Carbon::now()->gt($peminjaman->tanggal_harus_kembali);
                                        $daysDiff = \Carbon\Carbon::now()->diffInDays($peminjaman->tanggal_harus_kembali, false);
                                    @endphp
                                    @if($isOverdue)
                                        <br><small class="text-danger fw-bold">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            Terlambat {{ abs($daysDiff) }} hari
                                        </small>
                                    @else
                                        <br><small class="text-success">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $daysDiff }} hari lagi
                                        </small>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Status Peminjaman:</label>
                                <p class="form-control-plaintext">
                                    @php
                                        $allReturned = $peminjaman->details->every(function($detail) {
                                            return $detail->status === 'Dikembalikan';
                                        });
                                        $hasOverdue = $peminjaman->details->contains(function($detail) {
                                            return $detail->status === 'Terlambat';
                                        });
                                    @endphp
                                    @if($allReturned)
                                        <i class="fas fa-check-circle me-1 text-success"></i>
                                        <span class="badge bg-success fs-6">Selesai</span>
                                    @elseif($hasOverdue)
                                        <i class="fas fa-exclamation-triangle me-1 text-danger"></i>
                                        <span class="badge bg-danger fs-6">Terlambat</span>
                                    @else
                                        <i class="fas fa-clock me-1 text-warning"></i>
                                        <span class="badge bg-warning fs-6">Aktif</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Total Denda:</label>
                                <p class="form-control-plaintext">
                                    @if($peminjaman->total_denda > 0)
                                        <i class="fas fa-money-bill-wave me-1 text-danger"></i>
                                        <span class="badge bg-danger fs-6">Rp {{ number_format($peminjaman->total_denda, 0, ',', '.') }}</span>
                                    @else
                                        <i class="fas fa-check-circle me-1 text-success"></i>
                                        <span class="badge bg-success fs-6">Tidak ada denda</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Peminjaman -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistik Peminjaman
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-primary mb-1">{{ $peminjaman->details->count() }}</h3>
                                <small class="text-muted">Total Buku</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-success mb-1">{{ $peminjaman->details->where('status', 'Dikembalikan')->count() }}</h3>
                                <small class="text-muted">Dikembalikan</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-danger mb-1">{{ $peminjaman->details->where('status', '!=', 'Dikembalikan')->count() }}</h3>
                            <small class="text-muted">Belum Kembali</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Buku -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-books me-2"></i>
                        Daftar Buku yang Dipinjam
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th><i class="fas fa-book me-2"></i>Judul Buku</th>
                                    <th><i class="fas fa-calendar-alt me-2"></i>Tanggal Kembali</th>
                                    <th><i class="fas fa-flag me-2"></i>Status</th>
                                    <th><i class="fas fa-money-bill-wave me-2"></i>Denda</th>
                                    <th><i class="fas fa-user-check me-2"></i>Petugas Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman->details as $detail)
                                <tr>
                                    <td class="fw-bold text-primary">
                                        <i class="fas fa-book me-2" style="color: #11998e;"></i>
                                        {{ $detail->buku->judul }}
                                    </td>
                                    <td>
                                        @if($detail->tanggal_kembali)
                                            <i class="fas fa-calendar-check me-1 text-success"></i>
                                            {{ \Carbon\Carbon::parse($detail->tanggal_kembali)->format('d M Y') }}
                                            <br><small class="text-muted">{{ \Carbon\Carbon::parse($detail->tanggal_kembali)->format('H:i') }} WIB</small>
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-minus me-1"></i>
                                                Belum dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($detail->status == 'Dipinjam')
                                            <span class="badge bg-warning fs-6">
                                                <i class="fas fa-clock me-1"></i>
                                                {{ $detail->status }}
                                            </span>
                                        @elseif($detail->status == 'Dikembalikan')
                                            <span class="badge bg-success fs-6">
                                                <i class="fas fa-check-circle me-1"></i>
                                                {{ $detail->status }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger fs-6">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                {{ $detail->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($detail->denda > 0)
                                            <span class="badge bg-danger fs-6">
                                                <i class="fas fa-money-bill-wave me-1"></i>
                                                Rp {{ number_format($detail->denda, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-success">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Tidak ada
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($detail->petugas_pengembalian)
                                            <span class="fw-bold text-success">
                                                <i class="fas fa-user-check me-1"></i>
                                                {{ $detail->petugas_pengembalian->nama_petugas }}
                                            </span>
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-minus me-1"></i>
                                                -
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
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
                        Aksi Tersedia
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        @php
                            $hasUnreturned = $peminjaman->details->contains(function($detail) {
                                return $detail->status !== 'Dikembalikan';
                            });
                        @endphp

                       @if($hasUnreturned)
                            <a href="{{ route('petugas.pengembalian.index', $peminjaman->id) }}" class="btn btn-success">
                                <i class="fas fa-undo me-1"></i>
                                Kembalikan Buku
                            </a>
                        @endif

                        <a href="#" class="btn btn-info">
                            <i class="fas fa-print me-1"></i>
                            Cetak Bukti
                        </a>

                        <a href="{{ route('petugas.peminjaman.edit', $peminjaman->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>
                            Edit Peminjaman
                        </a>


                        <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-outline-dark">
                            <i class="fas fa-list me-1"></i>
                            Daftar Peminjaman
                        </a>
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

    // Animation effects
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects to cards
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'transform 0.3s ease';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add click animation to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple-effect');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Table row hover effects
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(0, 123, 255, 0.1)';
                this.style.transform = 'scale(1.01)';
                this.style.transition = 'all 0.2s ease';
            });

            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
                this.style.transform = 'scale(1)';
            });
        });
    });
</script>

<style>
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .badge {
        font-size: 0.9rem !important;
    }

    .form-control-plaintext {
        padding-left: 0;
        padding-right: 0;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .border-end {
        border-right: 1px solid #dee2e6 !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.1) !important;
    }

    @media (max-width: 768px) {
        .border-end {
            border-right: none !important;
            border-bottom: 1px solid #dee2e6 !important;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
        }

        .col-md-4:last-child .border-end {
            border-bottom: none !important;
        }

        .table-responsive {
            font-size: 0.85rem;
        }
    }
</style>
@endpush

@endsection
