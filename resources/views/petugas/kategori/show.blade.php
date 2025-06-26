@extends('layouts.petugas')

@section('title', 'Detail Kategori Buku')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-bookmark me-2"></i>
                        Detail Kategori Buku
                    </h2>
                    <p class="text-muted mb-0">Informasi lengkap tentang kategori buku</p>
                </div>
                <a href="{{ route('petugas.kategori.index') }}" class="btn btn-secondary">
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

    <!-- Informasi Kategori -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Nama Kategori:</label>
                                <p class="form-control-plaintext fs-5 fw-bold text-primary">
                                    <i class="fas fa-tag me-2"></i>
                                    {{ $kategori->nama_kategori }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Jumlah Buku:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-books me-1 text-success"></i>
                                    <span class="badge bg-success fs-6">{{ number_format($kategori->jumlah_buku, 0, ',', '.') }} Buku</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Tanggal Dibuat:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-plus me-1 text-info"></i>
                                    {{ $kategori->created_at->format('d M Y') }}
                                    <br><small class="text-muted">{{ $kategori->created_at->format('H:i') }} WIB</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Terakhir Diperbarui:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-edit me-1 text-warning"></i>
                                    {{ $kategori->updated_at->format('d M Y') }}
                                    <br><small class="text-muted">{{ $kategori->updated_at->format('H:i') }} WIB</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Deskripsi:</label>
                                <div class="border rounded p-3 bg-light">
                                    @if($kategori->deskripsi)
                                        <p class="mb-0">
                                            <i class="fas fa-align-left me-2 text-secondary"></i>
                                            {{ $kategori->deskripsi }}
                                        </p>
                                    @else
                                        <p class="mb-0 text-muted fst-italic">
                                            <i class="fas fa-minus me-2"></i>
                                            Tidak ada deskripsi
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Kategori -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistik Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-primary mb-1" id="book-counter">{{ $kategori->jumlah_buku }}</h3>
                                <small class="text-muted">Total Buku dalam Kategori</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-success mb-1">
                                    <i class="fas fa-calendar-check"></i>
                                </h3>
                                <small class="text-muted">Kategori Aktif</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-info mb-1">
                                {{ \Carbon\Carbon::parse($kategori->created_at)->diffInDays(now()) }}
                            </h3>
                            <small class="text-muted">Hari sejak dibuat</small>
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
                        <a href="{{ route('petugas.kategori.edit', $kategori->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>
                            Edit Kategori
                        </a>

                        @if($kategori->jumlah_buku > 0)
                            <a href="{{ route('petugas.buku.index', ['kategori' => $kategori->id]) }}" class="btn btn-success">
                                <i class="fas fa-book-open me-1"></i>
                                Lihat Semua Buku ({{ $kategori->jumlah_buku }})
                            </a>
                        @else
                            <button class="btn btn-outline-secondary" disabled>
                                <i class="fas fa-book-open me-1"></i>
                                Belum Ada Buku
                            </button>
                        @endif

                        <a href="{{ route('petugas.kategori.index') }}" class="btn btn-outline-dark">
                            <i class="fas fa-list me-1"></i>
                            Daftar Kategori
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

    // Counter animation for book count
    document.addEventListener('DOMContentLoaded', function() {
        const counter = document.getElementById('book-counter');
        const targetNumber = parseInt(counter.textContent);
        let currentNumber = 0;
        const increment = Math.ceil(targetNumber / 30);

        if (targetNumber > 0) {
            counter.textContent = '0';
            const timer = setInterval(() => {
                currentNumber += increment;
                if (currentNumber >= targetNumber) {
                    currentNumber = targetNumber;
                    clearInterval(timer);
                }
                counter.textContent = currentNumber.toLocaleString('id-ID');
            }, 50);
        }
    });
</script>
@endpush

@endsection
