@extends('layouts.admin')

@section('title', 'Dashboard Master Admin')

@section('content')
<div class="dashboard-container">
    <!-- Header Dashboard -->
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="dashboard-title">Dashboard Master Admin</h1>
                <p class="dashboard-subtitle">Pantau semua aktivitas perpustakaan secara real-time dan dapatkan insight mendalam tentang performa sistem.</p>
            </div>
            <div class="header-right">
                <div class="date-info">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="current-date"></span>
                </div>
                <div class="time-info">
                    <i class="fas fa-clock"></i>
                    <span id="current-time"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="dashboard-grid">
        <div class="dashboard-card" data-aos="fade-up" data-aos-delay="100">
            <div class="card-icon primary">
                <i class="fas fa-book"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Total Buku</div>
                <div class="card-value">{{ $totalBuku ?? 0 }}</div>
                <div class="card-description">Koleksi lengkap perpustakaan</div>
                <div class="card-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>Koleksi lengkap</span>
                </div>
            </div>
        </div>

        <div class="dashboard-card" data-aos="fade-up" data-aos-delay="200">
            <div class="card-icon success">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Total Anggota</div>
                <div class="card-value">{{ $totalAnggota ?? 0 }}</div>
                <div class="card-description">Anggota terdaftar aktif</div>
                <div class="card-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>Terus bertambah</span>
                </div>
            </div>
        </div>

        <div class="dashboard-card" data-aos="fade-up" data-aos-delay="300">
            <div class="card-icon info">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Total Petugas</div>
                <div class="card-value">{{ $totalPetugas ?? 0 }}</div>
                <div class="card-description">Staff perpustakaan aktif</div>
                <div class="card-trend neutral">
                    <i class="fas fa-minus"></i>
                    <span>Stabil</span>
                </div>
            </div>
        </div>

        <div class="dashboard-card" data-aos="fade-up" data-aos-delay="400">
            <div class="card-icon warning">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Total Peminjaman</div>
                <div class="card-value">{{ $totalPeminjaman ?? 0 }}</div>
                <div class="card-description">Keseluruhan transaksi</div>
                <div class="card-trend positive">
                    <i class="fas fa-chart-line"></i>
                    <span>Aktif</span>
                </div>
            </div>
        </div>

        <div class="dashboard-card" data-aos="fade-up" data-aos-delay="500">
            <div class="card-icon secondary">
                <i class="fas fa-book-reader"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Sedang Dipinjam</div>
                <div class="card-value">{{ $totalSedangDipinjam ?? 0 }}</div>
                <div class="card-description">Buku dalam sirkulasi</div>
                <div class="card-trend neutral">
                    <i class="fas fa-clock"></i>
                    <span>Dalam proses</span>
                </div>
            </div>
        </div>

        <div class="dashboard-card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-icon danger">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Total Denda</div>
                <div class="card-value">Rp {{ number_format($totalDendaAktif ?? 0, 0, ',', '.') }}</div>
                <div class="card-description">Denda belum terbayar</div>
                <div class="card-trend {{ ($totalDendaAktif ?? 0) > 0 ? 'negative' : 'positive' }}">
                    <i class="fas fa-{{ ($totalDendaAktif ?? 0) > 0 ? 'exclamation-triangle' : 'check' }}"></i>
                    <span>{{ ($totalDendaAktif ?? 0) > 0 ? 'Perlu perhatian' : 'Tidak ada denda' }}</span>
                </div>
            </div>
        </div>

        <div class="dashboard-card" data-aos="fade-up" data-aos-delay="700">
            <div class="card-icon dark">
                <i class="fas fa-eye"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Kunjungan Hari Ini</div>
                <div class="card-value">{{ $kunjunganHariIni ?? 0 }}</div>
                <div class="card-description">Pengunjung hari ini</div>
                <div class="card-trend positive">
                    <i class="fas fa-users"></i>
                    <span>Aktif hari ini</span>
                </div>
            </div>
        </div>

        <div class="dashboard-card" data-aos="fade-up" data-aos-delay="800">
            <div class="card-icon purple">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Kunjungan Minggu Ini</div>
                <div class="card-value">{{ $kunjunganMingguIni ?? 0 }}</div>
                <div class="card-description">Total minggu ini</div>
                <div class="card-trend positive">
                    <i class="fas fa-calendar-week"></i>
                    <span>Trending up</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="analytics-section" data-aos="fade-up" data-aos-delay="900">
        <h2 class="section-title">
            <i class="fas fa-chart-line"></i>
            Analisis Sistem Perpustakaan
        </h2>
        <div class="analytics-grid">
            <!-- Performance Metrics -->
            <div class="analytics-card">
                <div class="analytics-header">
                    <h3><i class="fas fa-tachometer-alt"></i> Performa Sistem</h3>
                </div>
                <div class="analytics-body">
                    <div class="metric-item">
                        <span class="metric-label">Tingkat Peminjaman</span>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: {{ ($totalSedangDipinjam / max($totalBuku, 1)) * 100 }}%"></div>
                        </div>
                        <span class="metric-value">{{ number_format(($totalSedangDipinjam / max($totalBuku, 1)) * 100, 1) }}%</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-label">Efisiensi Koleksi</span>
                        <div class="progress-container">
                            <div class="progress-bar success" style="width: {{ ($totalPeminjaman / max($totalBuku, 1) / 10) * 100 }}%"></div>
                        </div>
                        <span class="metric-value">{{ number_format(($totalPeminjaman / max($totalBuku, 1)), 1) }}x</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-label">Rasio Petugas/Anggota</span>
                        <div class="progress-container">
                            <div class="progress-bar warning" style="width: {{ min(($totalPetugas / max($totalAnggota, 1)) * 1000, 100) }}%"></div>
                        </div>
                        <span class="metric-value">1:{{ number_format($totalAnggota / max($totalPetugas, 1), 0) }}</span>
                    </div>
                </div>
            </div>

           <!-- Popular Categories -->
            <div class="analytics-card">
                <div class="analytics-header">
                    <h3><i class="fas fa-star"></i> Kategori Populer</h3>
                </div>
                <div class="analytics-body">
                    <div class="category-list">
                        @forelse ($kategoriPopuler as $kategori)
                            @php
                                $persentase = $totalPeminjaman > 0 ? round(($kategori->total / $totalPeminjaman) * 100) : 0;
                            @endphp
                            <div class="category-item">
                                <span class="category-name">{{ $kategori->nama_kategori }}</span>
                                <div class="category-bar">
                                    <div class="category-fill" style="width: {{ $persentase }}%; background-color: #4caf50;"></div>
                                </div>
                                <span class="category-percent">{{ $persentase }}%</span>
                            </div>
                        @empty
                            <p>Tidak ada data kategori populer.</p>
                        @endforelse
                    </div>
                </div>
            </div>



            <!-- Activity Heatmap -->
            <div class="analytics-card wide">
                <div class="analytics-header">
                    <h3><i class="fas fa-calendar-alt"></i> Pola Aktivitas Mingguan</h3>
                </div>
                <div class="analytics-body">
                    <div class="heatmap-container">
                        <div class="heatmap-days">
                            <div class="day-label">Sen</div>
                            <div class="day-label">Sel</div>
                            <div class="day-label">Rab</div>
                            <div class="day-label">Kam</div>
                            <div class="day-label">Jum</div>
                            <div class="day-label">Sab</div>
                            <div class="day-label">Min</div>
                        </div>
                        <div class="heatmap-grid">
                            @foreach($activityMap as $count)
                                @php
                                    if ($count >= 10) $intensity = 'high';
                                    elseif ($count >= 5) $intensity = 'medium';
                                    elseif ($count > 0) $intensity = 'low';
                                    else $intensity = 'none';
                                @endphp
                                <div class="heatmap-cell" data-intensity="{{ $intensity }}" title="{{ $count }} kunjungan"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Charts and Reports Section -->
    <div class="dashboard-content-grid">
        <!-- Charts Section -->
        <div class="content-card chart-section" data-aos="fade-right" data-aos-delay="1000">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-area"></i>
                    Tren Peminjaman Bulanan
                </h3>
                <div class="chart-controls">
                    <button class="btn-chart active" data-chart="monthly">Bulanan</button>
                    <button class="btn-chart" data-chart="yearly">Tahunan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="content-card system-status" data-aos="fade-left" data-aos-delay="1100">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-server"></i>
                    Status Sistem
                </h3>
            </div>
            <div class="card-body">
                <div class="status-list">
                    <div class="status-item">
                        <div class="status-indicator success"></div>
                        <div class="status-content">
                            <div class="status-title">Database</div>
                            <div class="status-description">Berjalan normal</div>
                        </div>
                        <div class="status-value">99.9%</div>
                    </div>
                    <div class="status-item">
                        <div class="status-indicator success"></div>
                        <div class="status-content">
                            <div class="status-title">Server</div>
                            <div class="status-description">Online</div>
                        </div>
                        <div class="status-value">100%</div>
                    </div>
                    <div class="status-item">
                        <div class="status-indicator warning"></div>
                        <div class="status-content">
                            <div class="status-title">Storage</div>
                            <div class="status-description">75% terpakai</div>
                        </div>
                        <div class="status-value">75%</div>
                    </div>
                    <div class="status-item">
                        <div class="status-indicator success"></div>
                        <div class="status-content">
                            <div class="status-title">Backup</div>
                            <div class="status-description">Terbaru: Hari ini</div>
                        </div>
                        <div class="status-value">✓</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Reports Section -->
    <div class="reports-section" data-aos="fade-up" data-aos-delay="1200">
        <h2 class="section-title">
            <i class="fas fa-file-alt"></i>
            Laporan Cepat
        </h2>
        <div class="reports-grid">
            <div class="report-card">
                <div class="report-icon">
                    <i class="fas fa-download"></i>
                </div>
                <div class="report-content">
                    <h4>Laporan Peminjaman</h4>
                    <p>Data peminjaman bulan ini</p>
                    <button class="btn-download">Download PDF</button>
                </div>
            </div>
            <div class="report-card">
                <div class="report-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="report-content">
                    <h4>Laporan Anggota</h4>
                    <p>Statistik keanggotaan</p>
                    <button class="btn-download">Download Excel</button>
                </div>
            </div>
            <div class="report-card">
                <div class="report-icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="report-content">
                    <h4>Laporan Denda</h4>
                    <p>Rincian denda dan pembayaran</p>
                    <button class="btn-download">Download PDF</button>
                </div>
            </div>
            <div class="report-card">
                <div class="report-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="report-content">
                    <h4>Analisis Lengkap</h4>
                    <p>Dashboard komprehensif</p>
                    <button class="btn-download">Lihat Detail</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Note -->
    <div class="admin-note-section" data-aos="fade-up" data-aos-delay="1300">
        <div class="admin-note-card">
            <div class="note-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="note-content">
                <h4>Catatan Master Admin</h4>
                <p>Sebagai Master Admin, Anda memiliki akses penuh untuk memantau semua aktivitas perpustakaan. Dashboard ini menyediakan insight mendalam tentang performa sistem, tren penggunaan, dan analisis komprehensif untuk mendukung pengambilan keputusan strategis.</p>
                <div class="note-features">
                    <span class="feature-tag">📊 Real-time Analytics</span>
                    <span class="feature-tag">📈 Performance Monitoring</span>
                    <span class="feature-tag">📋 Comprehensive Reports</span>
                    <span class="feature-tag">🔍 Deep Insights</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles from Petugas Dashboard */
.dashboard-container {
    padding: 0;
    max-width: 100%;
}

.dashboard-header {
    background: linear-gradient(135deg, #2563eb 0%, #f9fafb 100%);
    color: white;
    padding: 2rem;
    margin-bottom: 2rem;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.dashboard-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.dashboard-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0.5rem 0 0 0;
}

.header-right {
    display: flex;
    gap: 2rem;
    align-items: center;
    color: #2563eb;
}

.date-info, .time-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
    padding: 0 2rem;
}

.dashboard-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(226, 232, 240, 0.5);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.dashboard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), #a78bfa);
}

.dashboard-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.card-icon {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    flex-shrink: 0;
}

.card-icon.primary { background: linear-gradient(135deg, #2563eb, #3b82f6); color: white; }
.card-icon.success { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.card-icon.warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.card-icon.danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
.card-icon.info { background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; }
.card-icon.secondary { background: linear-gradient(135deg, #6b7280, #4b5563); color: white; }
.card-icon.dark { background: linear-gradient(135deg, #1f2937, #111827); color: white; }
.card-icon.purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }

.card-content {
    flex: 1;
}

.card-title {
    font-size: 1rem;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.card-description {
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 0.75rem;
}

.card-trend {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.85rem;
    font-weight: 500;
}

.card-trend.positive { color: #10b981; }
.card-trend.negative { color: #ef4444; }
.card-trend.neutral { color: #6b7280; }

/* Analytics Section */
.analytics-section {
    padding: 0 2rem;
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.analytics-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.analytics-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.analytics-card.wide {
    grid-column: 1 / -1;
}

.analytics-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
}

.analytics-header h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #0f172a;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.analytics-body {
    padding: 1.5rem;
}

/* Performance Metrics */
.metric-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.metric-label {
    flex: 1;
    font-weight: 500;
    color: #374151;
}

.progress-container {
    flex: 2;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background: #2563eb;
    transition: width 0.3s ease;
    border-radius: 4px;
}

.progress-bar.success { background: #10b981; }
.progress-bar.warning { background: #f59e0b; }

.metric-value {
    font-weight: 600;
    color: #0f172a;
    min-width: 60px;
    text-align: right;
}

/* Category Analytics */
.category-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.category-name {
    flex: 1;
    font-weight: 500;
    color: #374151;
}

.category-bar {
    flex: 2;
    height: 6px;
    background: #e5e7eb;
    border-radius: 3px;
    overflow: hidden;
}

.category-fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transition: width 0.3s ease;
    border-radius: 3px;
}

.category-percent {
    font-weight: 600;
    color: #0f172a;
    min-width: 50px;
    text-align: right;
    font-size: 0.9rem;
}

/* Heatmap */
.heatmap-container {
    display: flex;
    gap: 1rem;
}

.heatmap-days {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.day-label {
    height: 30px;
    display: flex;
    align-items: center;
    font-size: 0.8rem;
    font-weight: 500;
    color: #6b7280;
}

.heatmap-grid {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    flex: 1;
}

.heatmap-cell {
    height: 30px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.heatmap-cell[data-intensity="low"] { background: #dbeafe; }
.heatmap-cell[data-intensity="medium"] { background: #93c5fd; }
.heatmap-cell[data-intensity="high"] { background: #2563eb; }

/* Charts and Reports */
.dashboard-content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    padding: 0 2rem;
    margin-bottom: 2rem;
}

.content-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.card-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header .card-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
    text-transform: none;
    letter-spacing: normal;
}

.chart-controls {
    display: flex;
    gap: 0.5rem;
}

.btn-chart {
    padding: 0.5rem 1rem;
    border: 1px solid #e2e8f0;
    background: white;
    border-radius: 8px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-chart.active,
.btn-chart:hover {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
}

.card-body {
    padding: 1.5rem;
}

.chart-container {
    height: 300px;
    position: relative;
}

/* System Status */
.status-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.status-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 12px;
}

.status-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
}

.status-indicator.success { background: #10b981; }
.status-indicator.warning { background: #f59e0b; }
.status-indicator.danger { background: #ef4444; }

.status-content {
    flex: 1;
}

.status-title {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.25rem;
}

.status-description {
    font-size: 0.85rem;
    color: #6b7280;
}

.status-value {
    font-weight: 700;
    color: #0f172a;
    font-size: 0.9rem;
}

/* Reports Section */
.reports-section {
    padding: 0 2rem;
    margin-bottom: 2rem;
}

.reports-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.report-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(226, 232, 240, 0.5);
}

.report-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.report-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: white;
}

.report-content h4 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.report-content p {
    color: #6b7280;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.btn-download {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

/* Admin Note Section */
.admin-note-section {
    padding: 0 2rem;
    margin-bottom: 2rem;
}

.admin-note-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 20px;
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
}

.note-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.note-content h4 {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.note-content p {
    opacity: 0.9;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.note-features {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.feature-tag {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .dashboard-content-grid {
        grid-template-columns: 1fr;
    }

    .analytics-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .dashboard-title {
        font-size: 2rem;
    }

    .dashboard-subtitle {
        font-size: 1rem;
    }

    .header-content {
        flex-direction: column;
        text-align: center;
    }

    .header-right {
        flex-direction: column;
        gap: 1rem;
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
        padding: 0 1rem;
    }

    .dashboard-card {
        flex-direction: column;
        text-align: center;
    }

    .card-value {
        font-size: 2rem;
    }

    .analytics-section,
    .reports-section,
    .admin-note-section {
        padding: 0 1rem;
    }

    .dashboard-content-grid {
        padding: 0 1rem;
    }

    .admin-note-card {
        flex-direction: column;
        text-align: center;
    }

    .heatmap-container {
        flex-direction: column;
    }

    .heatmap-days {
        flex-direction: row;
        justify-content: space-between;
    }

    .heatmap-grid {
        flex-direction: row;
        height: 30px;
    }

    .heatmap-cell {
        width: 100%;
        height: 30px;
    }
}

@media (max-width: 480px) {
    .dashboard-header {
        padding: 1.5rem 1rem;
    }

    .dashboard-title {
        font-size: 1.8rem;
    }

    .dashboard-card {
        padding: 1.5rem;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        font-size: 1.4rem;
    }

    .reports-grid {
        grid-template-columns: 1fr;
    }
}

/* Dark mode support (optional) */
@media (prefers-color-scheme: dark) {
    .dashboard-card,
    .analytics-card,
    .content-card,
    .report-card {
        background: #1f2937;
        border-color: #374151;
    }

    .card-title,
    .card-value,
    .status-title,
    .metric-value,
    .category-percent {
        color: #f9fafb;
    }

    .card-description,
    .status-description {
        color: #d1d5db;
    }

    .analytics-header {
        background: linear-gradient(135deg, #1f2937, #111827);
    }

    .status-item {
        background: #374151;
    }
}

/* Animation keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.status-indicator.success {
    animation: pulse 2s infinite;
}

/* Print styles */
@media print {
    .dashboard-header {
        background: #667eea !important;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }

    .dashboard-card,
    .analytics-card,
    .content-card {
        box-shadow: none;
        border: 1px solid #e2e8f0;
    }

    .btn-download,
    .btn-chart {
        display: none;
    }
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// ✅ Update tanggal dan waktu secara real-time
function updateDateTime() {
    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);
    document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
}

document.addEventListener('DOMContentLoaded', function () {
    // ✅ Jalankan penanggalan dan waktu real-time
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // ✅ Inisialisasi Chart
    const ctx = document.getElementById('trendChart').getContext('2d');
    const trendChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: {!! json_encode($data) !!},
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            }
        }
    });

    // ✅ Tombol kontrol chart
    const chartButtons = document.querySelectorAll('.btn-chart');
    chartButtons.forEach(button => {
        button.addEventListener('click', function () {
            chartButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const chartType = this.dataset.chart;
            console.log('Chart type selected:', chartType);

            // Jika ingin menambahkan filter tahunan, tambahkan AJAX/fetch di sini
        });
    });

    // ✅ Download tombol simulasi
    const downloadButtons = document.querySelectorAll('.btn-download');
    downloadButtons.forEach(button => {
        button.addEventListener('click', function () {
            const reportType = this.textContent;
            alert(`Mengunduh ${reportType}...`);
            // Tambahkan logika unduh jika diperlukan
        });
    });

    // ✅ Animasi progress bar
    document.querySelectorAll('.progress-bar').forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });

    // ✅ Animasi kategori (jika ada)
    document.querySelectorAll('.category-fill').forEach(fill => {
        const width = fill.style.width;
        fill.style.width = '0%';
        setTimeout(() => {
            fill.style.width = width;
        }, 800);
    });

    // ✅ Hover efek kartu dashboard
    document.querySelectorAll('.dashboard-card, .analytics-card, .report-card').forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transform = 'translateY(-8px)';
        });
        card.addEventListener('mouseleave', function () {
            this.style.transform = 'translateY(0)';
        });
    });

    // ✅ Shortcut keyboard
    document.addEventListener('keydown', function (e) {
        if (e.ctrlKey && e.shiftKey && e.key === 'D') {
            e.preventDefault();
            location.reload();
        }
        if (e.ctrlKey && e.shiftKey && e.key === 'R') {
            e.preventDefault();
            document.querySelector('.reports-section')?.scrollIntoView({ behavior: 'smooth' });
        }
    });

    // ✅ Smooth scroll untuk anchor
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href'))?.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
</script>
@endpush


@endsection
