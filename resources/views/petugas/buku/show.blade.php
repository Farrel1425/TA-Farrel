@extends('layouts.petugas')

@section('title', 'Detail Buku')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-book me-2"></i>
                        Detail Buku
                    </h2>
                    <p class="text-muted mb-0">Informasi lengkap tentang buku perpustakaan</p>
                </div>
                <a href="{{ route('petugas.buku.index') }}" class="btn btn-secondary">
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

    <!-- Informasi Buku -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-book-open me-2"></i>
                        Informasi Buku
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Judul Buku Prominent -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="text-center p-3 bg-light rounded">
                                <label class="form-label fw-bold text-dark">Judul Buku:</label>
                                <h3 class="fw-bold text-primary mb-0">
                                    <i class="fas fa-book me-2"></i>
                                    {{ $buku->judul }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Kategori:</label>
                                <p class="form-control-plaintext fs-5 fw-bold text-success">
                                    <i class="fas fa-list-alt me-2"></i>
                                    {{ $buku->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Penulis:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-user-edit me-1 text-info"></i>
                                    {{ $buku->penulis }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Penerbit:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-building me-1 text-warning"></i>
                                    {{ $buku->penerbit }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Tahun Terbit:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-alt me-1 text-secondary"></i>
                                    {{ $buku->tahun_terbit }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Stok:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-warehouse me-1 text-primary"></i>
                                    <span class="badge bg-info fs-6">{{ number_format($buku->stok, 0, ',', '.') }} Buku</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Status Buku:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-{{ $buku->status_buku === 'Tersedia' ? 'check-circle' : 'times-circle' }} me-1 text-{{ $buku->status_buku === 'Tersedia' ? 'success' : 'secondary' }}"></i>
                                    <span class="badge bg-{{ $buku->status_buku === 'Tersedia' ? 'success' : 'secondary' }} fs-6">{{ $buku->status_buku }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Tanggal Ditambahkan:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-plus me-1 text-info"></i>
                                    {{ $buku->created_at->format('d M Y') }}
                                    <br><small class="text-muted">{{ $buku->created_at->format('H:i') }} WIB</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Terakhir Diperbarui:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-edit me-1 text-warning"></i>
                                    {{ $buku->updated_at->format('d M Y') }}
                                    <br><small class="text-muted">{{ $buku->updated_at->format('H:i') }} WIB</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Buku -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistik Buku
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-primary mb-1" id="book-stock-display">{{ number_format($buku->stok, 0, ',', '.') }}</h3>
                                <small class="text-muted">Stok Tersedia</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-{{ $buku->status_buku === 'Tersedia' ? 'success' : 'secondary' }} mb-1">
                                    <i class="fas fa-{{ $buku->status_buku === 'Tersedia' ? 'check-circle' : 'times-circle' }}"></i>
                                </h3>
                                <small class="text-muted">Status {{ $buku->status_buku }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-info mb-1">
                                {{ round(\Carbon\Carbon::parse($buku->created_at)->diffInDays(now()) / 30) }}
                            </h3>
                            <small class="text-muted">Bulan sejak ditambahkan</small>
                        </div>
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
                        <a href="{{ route('petugas.buku.edit', $buku->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>
                            Edit Buku
                        </a>

                        @if($buku->kategori)
                            <a href="{{ route('petugas.kategori.show', $buku->kategori->id) }}" class="btn btn-success">
                                <i class="fas fa-list-alt me-1"></i>
                                Lihat Kategori
                            </a>
                        @endif

                        @if($buku->stok > 0 && $buku->status_buku === 'Tersedia')
                            <a href="{{ route('petugas.peminjaman.create', ['buku' => $buku->id]) }}" class="btn btn-info">
                                <i class="fas fa-hand-holding me-1"></i>
                                Pinjam Buku
                            </a>
                            <a href="{{ route('petugas.peminjaman.index', $buku->id) }}" class="btn btn-warning">
                                <i class="fas fa-history me-1"></i>
                                Riwayat Peminjaman
                            </a>
                        @else
                            <button class="btn btn-outline-secondary" disabled>
                                <i class="fas fa-ban me-1"></i>
                                Tidak Tersedia untuk Dipinjam
                            </button>
                        @endif


                        <a href="{{ route('petugas.buku.index') }}" class="btn btn-outline-dark">
                            <i class="fas fa-books me-1"></i>
                            Daftar Buku
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

    // Animation for book stock display
    document.addEventListener('DOMContentLoaded', function() {
        const bookStockDisplay = document.getElementById('book-stock-display');
        const targetStock = {{ $buku->stok }};

        // Add a subtle animation effect
        bookStockDisplay.style.opacity = '0';
        bookStockDisplay.style.transform = 'translateY(20px)';

        setTimeout(() => {
            bookStockDisplay.style.transition = 'all 0.5s ease-out';
            bookStockDisplay.style.opacity = '1';
            bookStockDisplay.style.transform = 'translateY(0)';

            // Counter animation for stock
            let currentStock = 0;
            const increment = Math.ceil(targetStock / 30);
            const timer = setInterval(() => {
                currentStock += increment;
                if (currentStock >= targetStock) {
                    currentStock = targetStock;
                    clearInterval(timer);
                }
                bookStockDisplay.textContent = currentStock.toLocaleString('id-ID');
            }, 50);
        }, 200);

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
    }
</style>
@endpush

@endsection
