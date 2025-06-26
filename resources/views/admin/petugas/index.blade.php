@extends('layouts.admin')

@section('title', 'Daftar Petugas')

@section('content')
<div class="container mt-4" id="mainContent">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Petugas</h3>
        <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Petugas
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped table-hover">
            <thead style="background-color: #2563eb; color: white;">
                <tr class="text-center">
                    <th class="align-middle" style="width: 50px;">No</th>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle">Username</th>
                    <th class="align-middle" style="width: 100px;">Status</th>
                    <th class="align-middle" style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $item)
                    <tr>
                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle"><strong>{{ $item->nama_petugas }}</strong></td>
                        <td class="align-middle text-muted text-center">{{ $item->user->username ?? '-' }}</td>
                        <td class="text-center align-middle">
                            <span class="badge bg-{{ strtolower($item->status) === 'aktif' ? 'success' : 'secondary' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.petugas.show', $item->id) }}" class="btn btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.petugas.edit', $item->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger delete-btn"
                                        onclick="confirmDelete('{{ $item->nama_petugas }}', '{{ route('admin.petugas.destroy', $item->id) }}')"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <p class="mb-0">Belum ada petugas yang terdaftar</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Form hapus -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

</div>

<!-- Konfirmasi Hapus -->
<script>
    function confirmDelete(nama, url) {
        if (confirm(`Yakin ingin menghapus petugas "${nama}"?\nTindakan ini tidak dapat dibatalkan.`)) {
            const form = document.getElementById('deleteForm');
            form.action = url;
            form.submit();
        }
    }
</script>

<style>
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .btn-group-sm > .btn {
        padding: 0.3rem 0.6rem;
        font-size: 0.85rem;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .alert {
        border-radius: 8px;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .badge {
        font-size: 0.75rem;
    }
</style>
@endsection
