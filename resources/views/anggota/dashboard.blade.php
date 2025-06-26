@extends('layouts.anggota')

@section('title', 'Dashboard Anggota')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Dashboard Anggota</h1>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-700">Buku Dipinjam</h2>
            <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalDipinjam }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-700">Denda Belum Lunas</h2>
            <p class="text-3xl font-bold text-red-600 mt-2">Rp {{ number_format($totalDendaBelumLunas, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-700">Kunjungan Minggu Ini</h2>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ array_sum($chartData['kunjungan']) }}</p>
        </div>
    </div>
    
    {{-- Riwayat Peminjaman --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Riwayat Peminjaman Terakhir</h2>
        @if ($riwayatPeminjaman->count())
            <ul class="space-y-4">
                @foreach ($riwayatPeminjaman as $peminjaman)
                    <li class="border-b pb-2">
                        <p class="text-gray-800 font-semibold">Tanggal: {{ $peminjaman->created_at->translatedFormat('d F Y') }}</p>
                        <ul class="list-disc list-inside text-gray-600">
                            @foreach ($peminjaman->details as $detail)
                                <li>{{ $detail->buku->judul ?? '-' }} (Status: {{ $detail->status }})</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Belum ada riwayat peminjaman.</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
