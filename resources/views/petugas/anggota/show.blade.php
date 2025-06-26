@extends('layouts.petugas')

@section('title', 'Detail Anggota')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-user me-2"></i>
                        Detail Anggota
                    </h2>
                    <p class="text-muted mb-0">Informasi lengkap tentang anggota perpustakaan</p>
                </div>
                <a href="{{ route('petugas.anggota.index') }}" class="btn btn-secondary">
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

    <!-- Informasi Anggota -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Anggota
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
                                    {{ $anggota->nama_anggota }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">NIS:</label>
                                <p class="form-control-plaintext fs-5 fw-bold text-success">
                                    <i class="fas fa-id-card me-2"></i>
                                    {{ $anggota->nis }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Nomor HP:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-phone me-1 text-info"></i>
                                    {{ $anggota->no_hp }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Jenis Kelamin:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-{{ $anggota->jenis_kelamin === 'Laki-laki' ? 'mars' : 'venus' }} me-1 text-{{ $anggota->jenis_kelamin === 'Laki-laki' ? 'primary' : 'danger' }}"></i>
                                    <span class="badge bg-{{ $anggota->jenis_kelamin === 'Laki-laki' ? 'primary' : 'danger' }} fs-6">{{ $anggota->jenis_kelamin }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Status Anggota:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-{{ $anggota->status_anggota === 'Aktif' ? 'check-circle' : 'times-circle' }} me-1 text-{{ $anggota->status_anggota === 'Aktif' ? 'success' : 'secondary' }}"></i>
                                    <span class="badge bg-{{ $anggota->status_anggota === 'Aktif' ? 'success' : 'secondary' }} fs-6">{{ $anggota->status_anggota }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Tanggal Bergabung:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-plus me-1 text-info"></i>
                                    {{ $anggota->created_at->format('d M Y') }}
                                    <br><small class="text-muted">{{ $anggota->created_at->format('H:i') }} WIB</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Terakhir Diperbarui:</label>
                                <p class="form-control-plaintext">
                                    <i class="fas fa-calendar-edit me-1 text-warning"></i>
                                    {{ $anggota->updated_at->format('d M Y') }}
                                    <br><small class="text-muted">{{ $anggota->updated_at->format('H:i') }} WIB</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Alamat:</label>
                                <div class="border rounded p-3 bg-light">
                                    <p class="mb-0">
                                        <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                                        {{ $anggota->alamat }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Anggota -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistik Anggota
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-primary mb-1" id="member-id-display">{{ $anggota->nis }}</h3>
                                <small class="text-muted">NIS Anggota</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-{{ $anggota->status_anggota === 'Aktif' ? 'success' : 'secondary' }} mb-1">
                                    <i class="fas fa-{{ $anggota->status_anggota === 'Aktif' ? 'check-circle' : 'times-circle' }}"></i>
                                </h3>
                                <small class="text-muted">Status {{ $anggota->status_anggota }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-info mb-1">
                                {{ round(\Carbon\Carbon::parse($anggota->created_at)->diffInDays(now()) / 30) }}
                            </h3>
                            <small class="text-muted">Bulan sejak bergabung</small>

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
                        <a href="{{ route('petugas.anggota.edit', $anggota->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>
                            Edit Anggota
                        </a>

                        @if($anggota->status_anggota === 'Aktif')
                            <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-success">
                                <i class="fas fa-history me-1"></i>
                                Riwayat Peminjaman
                            </a>
                            <a href="{{ route('petugas.peminjaman.create', ['anggota' => $anggota->id]) }}" class="btn btn-info">
                                <i class="fas fa-book me-1"></i>
                                Pinjam Buku Baru
                            </a>
                        @else
                            <button class="btn btn-outline-secondary" disabled>
                                <i class="fas fa-user-slash me-1"></i>
                                Anggota Tidak Aktif
                            </button>
                        @endif

                        <a href="{{ route('petugas.anggota.index') }}" class="btn btn-outline-dark">
                            <i class="fas fa-users me-1"></i>
                            Daftar Anggota
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

    // Animation for member ID display
    document.addEventListener('DOMContentLoaded', function() {
        const memberIdDisplay = document.getElementById('member-id-display');
        const targetId = memberIdDisplay.textContent;

        // Add a subtle animation effect
        memberIdDisplay.style.opacity = '0';
        memberIdDisplay.style.transform = 'translateY(20px)';

        setTimeout(() => {
            memberIdDisplay.style.transition = 'all 0.5s ease-out';
            memberIdDisplay.style.opacity = '1';
            memberIdDisplay.style.transform = 'translateY(0)';
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
