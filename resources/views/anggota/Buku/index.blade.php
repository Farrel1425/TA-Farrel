@extends('layouts.anggota')

@section('title', 'Daftar Buku')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Buku</h1>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('anggota.buku.index') }}" class="mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis..."
            class="border rounded px-4 py-2 w-full md:w-1/3">
    </form>

    {{-- Daftar Buku --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($buku as $item)
            <div class="bg-white shadow rounded p-4">
                <h2 class="font-semibold text-lg">{{ $item->judul }}</h2>
                <p class="text-sm text-gray-600">Penulis: {{ $item->penulis }}</p>
                <p class="mt-2">
                    Status:
                    @if ($item->stok > 0)
                        <span class="text-green-600 font-semibold">Tersedia</span>
                    @else
                        <span class="text-red-600 font-semibold">Tidak Tersedia</span>
                    @endif
                </p>
            </div>
        @empty
            <p class="col-span-full text-gray-500">Buku tidak ditemukan.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $buku->withQueryString()->links() }}
    </div>
</div>
@endsection
