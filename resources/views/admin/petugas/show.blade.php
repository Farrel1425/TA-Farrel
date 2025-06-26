@extends('layouts.admin')

@section('title', 'Detail Petugas')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-user-shield me-2"></i>
                        Detail Petugas
                    </h2>
                    <p class="text-muted mb-0">Informasi lengkap tentang petugas perpustakaan</p>
                </div>
                <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Alert -->
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

    <!-- Informasi Petugas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Petugas
                    </h5>
                </div>
                <div class="card-body">

                    <!-- Nama Petugas Prominent -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="text-center p-3 bg-light rounded">
                                <label class="form-label fw-bold text-dark">Nama Petugas:</label>
                                <h3 class="fw-bold text-primary mb-0">
                                    <i class="fas fa-user me-2"></i>
                                    {{ $petugas->nama_petugas }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-dark">Username:</label>
                            <p class="form-control-plaintext">
                                <i class="fas fa-user-circle me-1 text-secondary"></i>
                                {{ $petugas->user->username ?? '-' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-dark">No. HP:</label>
                            <p class="form-control-plaintext">
                                <i class="fas fa-phone me-1 text-info"></i>
                                {{ $petugas->no_hp }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-dark">Jenis Kelamin:</label>
                            <p class="form-control-plaintext">
                                <i class="fas fa-{{ $petugas->jenis_kelamin === 'Laki-laki' ? 'mars' : 'venus' }} me-1 text-{{ $petugas->jenis_kelamin === 'Laki-laki' ? 'primary' : 'danger' }}"></i>
                                <span class="badge bg-{{ $petugas->jenis_kelamin === 'Laki-laki' ? 'primary' : 'danger' }} fs-6">{{ $petugas->jenis_kelamin }}</span>
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-dark">Status:</label>
                            <p class="form-control-plaintext">
                                <i class="fas fa-{{ $petugas->status === 'Aktif' ? 'check-circle' : ($petugas->status === 'Cuti' ? 'pause-circle' : 'times-circle') }} me-1 text-{{ $petugas->status === 'Aktif' ? 'success' : ($petugas->status === 'Cuti' ? 'warning' : 'secondary') }}"></i>
                                <span class="badge bg-{{ $petugas->status === 'Aktif' ? 'success' : ($petugas->status === 'Cuti' ? 'warning' : 'secondary') }} fs-6">{{ $petugas->status }}</span>
                            </p>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold text-dark">Alamat:</label>
                            <div class="border rounded p-3 bg-light">
                                <p class="mb-0">
                                    <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                                    {{ $petugas->alamat }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Aksi Tersedia
                    </h5>
                </div>
                <div class="card-body text-center d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('admin.petugas.edit', $petugas->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit Petugas
                    </a>
                    <a href="{{ route('admin.petugas.index') }}" class="btn btn-outline-dark">
                        <i class="fas fa-users me-1"></i> Daftar Petugas
                    </a>
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

<style>
    .badge {
        font-size: 0.9rem !important;
    }

    .form-control-plaintext {
        padding-left: 0;
        padding-right: 0;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush

@endsection
