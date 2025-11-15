@extends('layouts.app')

@section('title', 'Dashboard Laporan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-graph-up-arrow me-2"></i>Dashboard Laporan & Analitik</h1>
            <p>Ringkasan lengkap statistik dan laporan bisnis Hejo Laundry</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-outline-light" onclick="location.reload()">
                <i class="bi bi-arrow-clockwise me-1"></i> Refresh
            </button>
        </div>
    </div>
</div>

<!-- Main Statistics Cards -->
<div class="stat-card-grid">
    <div class="stat-card green" data-aos="fade-up" data-aos-delay="0">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ number_format($stats['total_orders']) }}</h3>
                <p>Total Orders</p>
                <small class="stat-trend">
                    <i class="bi bi-arrow-up-short"></i> 
                    <span style="color: #22c55e;">+12.5%</span> dari bulan lalu
                </small>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-cart-check-fill"></i>
            </div>
        </div>
    </div>

    <div class="stat-card blue" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ number_format($stats['total_transactions']) }}</h3>
                <p>Total Transaksi</p>
                <small class="stat-trend">
                    <i class="bi bi-arrow-up-short"></i> 
                    <span style="color: #60a5fa;">+8.3%</span> dari bulan lalu
                </small>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-receipt"></i>
            </div>
        </div>
    </div>

    <div class="stat-card purple" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ number_format((float)$stats['total_revenue'], 0, ',', '.') }}</h3>
                <p>Total Pendapatan</p>
                <small class="stat-trend">
                    <i class="bi bi-arrow-up-short"></i> 
                    <span style="color: #c084fc;">+15.7%</span> dari bulan lalu
                </small>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>

    <div class="stat-card orange" data-aos="fade-up" data-aos-delay="300">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ number_format($stats['pending_payments']) }}</h3>
                <p>Pembayaran Pending</p>
                <small class="stat-trend">
                    <i class="bi bi-clock-history"></i> 
                    <span style="color: #fb923c;">Butuh perhatian</span>
                </small>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
        </div>
    </div>
</div>

<!-- Advanced Analytics Row -->
<div class="row g-4 mb-4">
    <!-- Order Status Breakdown -->
    <div class="col-lg-6">
        <div class="data-card" data-aos="fade-right">
            <div class="card-header-custom">
                <h4><i class="bi bi-pie-chart-fill"></i> Status Pesanan</h4>
                <span class="badge badge-success">Real-time</span>
            </div>
            <div class="chart-container">
                <canvas id="orderStatusChart"></canvas>
            </div>
            <div class="mt-4">
                <div class="status-grid">
                    <div class="status-item">
                        <div class="status-indicator" style="background: #22c55e;"></div>
                        <div>
                            <strong style="color: #22c55e;">{{ $stats['completed_orders'] }}</strong>
                            <small style="color: rgba(255,255,255,0.6); display: block;">Selesai</small>
                        </div>
                        <small style="color: rgba(255,255,255,0.5);">
                            {{ $stats['total_orders'] > 0 ? round(($stats['completed_orders'] / $stats['total_orders']) * 100, 1) : 0 }}%
                        </small>
                    </div>
                    <div class="status-item">
                        <div class="status-indicator" style="background: #fb923c;"></div>
                        <div>
                            <strong style="color: #fb923c;">{{ $stats['pending_payments'] }}</strong>
                            <small style="color: rgba(255,255,255,0.6); display: block;">Pending</small>
                        </div>
                        <small style="color: rgba(255,255,255,0.5);">
                            {{ $stats['total_orders'] > 0 ? round(($stats['pending_payments'] / $stats['total_orders']) * 100, 1) : 0 }}%
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Trend -->
    <div class="col-lg-6">
        <div class="data-card" data-aos="fade-left">
            <div class="card-header-custom">
                <h4><i class="bi bi-graph-up"></i> Tren Pendapatan 7 Hari</h4>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-light active">7 Hari</button>
                    <button class="btn btn-outline-light">30 Hari</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="revenueTrendChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Activity Dashboard -->
<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="data-card activity-card" data-aos="zoom-in" data-aos-delay="0">
            <div class="activity-icon" style="background: rgba(34, 197, 94, 0.2);">
                <i class="bi bi-cart-plus" style="color: #22c55e;"></i>
            </div>
            <h3 class="activity-value">-</h3>
            <p class="activity-label">Order Baru Hari Ini</p>
            <div class="activity-footer">
                <i class="bi bi-calendar-check"></i>
                <span>Update: {{ now()->format('H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="data-card activity-card" data-aos="zoom-in" data-aos-delay="100">
            <div class="activity-icon" style="background: rgba(59, 130, 246, 0.2);">
                <i class="bi bi-credit-card" style="color: #60a5fa;"></i>
            </div>
            <h3 class="activity-value">-</h3>
            <p class="activity-label">Transaksi Hari Ini</p>
            <div class="activity-footer">
                <i class="bi bi-clock"></i>
                <span>Update: {{ now()->format('H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="data-card activity-card" data-aos="zoom-in" data-aos-delay="200">
            <div class="activity-icon" style="background: rgba(168, 85, 247, 0.2);">
                <i class="bi bi-cash" style="color: #c084fc;"></i>
            </div>
            <h3 class="activity-value">Rp -</h3>
            <p class="activity-label">Pendapatan Hari Ini</p>
            <div class="activity-footer">
                <i class="bi bi-arrow-up-circle"></i>
                <span>Update: {{ now()->format('H:i') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Report Navigation Grid -->
<div class="data-card" data-aos="fade-up">
    <div class="card-header-custom">
        <h4><i class="bi bi-folder-fill"></i> Akses Cepat Laporan</h4>
        <small style="color: rgba(255,255,255,0.6);">Klik untuk melihat detail laporan</small>
    </div>
    <div class="row g-4 mt-2">
        <!-- Transaksi -->
        <div class="col-md-6 col-lg-4">
            <div class="report-nav-card" onclick="window.location.href='{{ route('report.transactions') }}'">
                <div class="report-nav-header">
                    <div class="report-nav-icon" style="background: rgba(34, 197, 94, 0.2);">
                        <i class="bi bi-receipt-cutoff" style="color: #22c55e;"></i>
                    </div>
                    <i class="bi bi-arrow-right-circle report-nav-arrow"></i>
                </div>
                <div class="report-nav-content">
                    <h5>Laporan Transaksi</h5>
                    <p>Detail pembayaran dan konfirmasi transaksi pelanggan</p>
                    <div class="report-stats">
                        <span><i class="bi bi-check-circle"></i> {{ $stats['total_transactions'] }} transaksi</span>
                    </div>
                    <div class="export-buttons mt-3" onclick="event.stopPropagation();">
                        <a href="{{ route('report.transactions.pdf') }}" class="export-btn export-btn-pdf">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            <span>PDF</span>
                        </a>
                        <a href="{{ route('report.transactions.excel') }}" class="export-btn export-btn-excel">
                            <i class="bi bi-file-earmark-excel-fill"></i>
                            <span>Excel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-md-6 col-lg-4">
            <div class="report-nav-card" onclick="window.location.href='{{ route('report.orders') }}'">
                <div class="report-nav-header">
                    <div class="report-nav-icon" style="background: rgba(59, 130, 246, 0.2);">
                        <i class="bi bi-cart-check" style="color: #60a5fa;"></i>
                    </div>
                    <i class="bi bi-arrow-right-circle report-nav-arrow"></i>
                </div>
                <div class="report-nav-content">
                    <h5>Laporan Pesanan</h5>
                    <p>Monitoring status dan detail semua pesanan laundry</p>
                    <div class="report-stats">
                        <span><i class="bi bi-cart"></i> {{ $stats['total_orders'] }} pesanan</span>
                    </div>
                    <div class="export-buttons mt-3" onclick="event.stopPropagation();">
                        <a href="{{ route('report.orders.pdf') }}" class="export-btn export-btn-pdf">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            <span>PDF</span>
                        </a>
                        <a href="{{ route('report.orders.excel') }}" class="export-btn export-btn-excel">
                            <i class="bi bi-file-earmark-excel-fill"></i>
                            <span>Excel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-md-6 col-lg-4">
            <div class="report-nav-card" onclick="window.location.href='{{ route('report.revenue') }}'">
                <div class="report-nav-header">
                    <div class="report-nav-icon" style="background: rgba(168, 85, 247, 0.2);">
                        <i class="bi bi-graph-up-arrow" style="color: #c084fc;"></i>
                    </div>
                    <i class="bi bi-arrow-right-circle report-nav-arrow"></i>
                </div>
                <div class="report-nav-content">
                    <h5>Laporan Pendapatan</h5>
                    <p>Analisis revenue harian, mingguan, dan bulanan</p>
                    <div class="report-stats">
                        <span><i class="bi bi-cash-stack"></i> Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
                    </div>
                    <div class="export-buttons mt-3" onclick="event.stopPropagation();">
                        <a href="{{ route('report.revenue.pdf') }}" class="export-btn export-btn-pdf">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            <span>PDF</span>
                        </a>
                        <a href="{{ route('report.revenue.excel') }}" class="export-btn export-btn-excel">
                            <i class="bi bi-file-earmark-excel-fill"></i>
                            <span>Excel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customers -->
        <div class="col-md-6 col-lg-4">
            <div class="report-nav-card" onclick="window.location.href='{{ route('report.customers') }}'">
                <div class="report-nav-header">
                    <div class="report-nav-icon" style="background: rgba(249, 115, 22, 0.2);">
                        <i class="bi bi-people-fill" style="color: #fb923c;"></i>
                    </div>
                    <i class="bi bi-arrow-right-circle report-nav-arrow"></i>
                </div>
                <div class="report-nav-content">
                    <h5>Laporan Pelanggan</h5>
                    <p>Data pelanggan setia dan histori pembelian lengkap</p>
                    <div class="report-stats">
                        <span><i class="bi bi-person-check"></i> Database lengkap</span>
                    </div>
                    <div class="export-buttons mt-3" onclick="event.stopPropagation();">
                        <a href="{{ route('report.customers.excel') }}" class="export-btn export-btn-excel">
                            <i class="bi bi-file-earmark-excel-fill"></i>
                            <span>Excel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services -->
        <div class="col-md-6 col-lg-4">
            <div class="report-nav-card" onclick="window.location.href='{{ route('report.services') }}'">
                <div class="report-nav-header">
                    <div class="report-nav-icon" style="background: rgba(236, 72, 153, 0.2);">
                        <i class="bi bi-star-fill" style="color: #f472b6;"></i>
                    </div>
                    <i class="bi bi-arrow-right-circle report-nav-arrow"></i>
                </div>
                <div class="report-nav-content">
                    <h5>Layanan Populer</h5>
                    <p>Analisis layanan terlaris dan favorit pelanggan</p>
                    <div class="report-stats">
                        <span><i class="bi bi-trophy"></i> Top services</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mt-2">
    <div class="col-lg-12">
        <div class="data-card">
            <div class="card-header-custom">
                <h4><i class="bi bi-lightning-charge-fill"></i> Aksi Cepat</h4>
            </div>
            <div class="quick-actions-grid">
                <button class="quick-action-btn" onclick="window.location.href='{{ route('report.transactions') }}'">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Lihat Transaksi</span>
                </button>
                <button class="quick-action-btn" onclick="window.location.href='{{ route('report.orders') }}'">
                    <i class="bi bi-list-check"></i>
                    <span>Lihat Pesanan</span>
                </button>
                <button class="quick-action-btn" onclick="window.location.href='{{ route('report.revenue') }}'">
                    <i class="bi bi-graph-up"></i>
                    <span>Analisis Revenue</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-download me-2"></i>Export Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="color: rgba(255,255,255,0.7);">Pilih jenis laporan yang ingin di-export:</p>
                <div class="export-options">
                    <a href="{{ route('report.transactions.pdf') }}" class="export-option">
                        <i class="bi bi-file-earmark-pdf"></i>
                        <div>
                            <strong>Transaksi (PDF)</strong>
                            <small>Laporan transaksi lengkap</small>
                        </div>
                    </a>
                    <a href="{{ route('report.transactions.excel') }}" class="export-option">
                        <i class="bi bi-file-earmark-excel"></i>
                        <div>
                            <strong>Transaksi (Excel)</strong>
                            <small>Data transaksi dalam spreadsheet</small>
                        </div>
                    </a>
                    <a href="{{ route('report.orders.pdf') }}" class="export-option">
                        <i class="bi bi-file-earmark-pdf"></i>
                        <div>
                            <strong>Pesanan (PDF)</strong>
                            <small>Laporan pesanan lengkap</small>
                        </div>
                    </a>
                    <a href="{{ route('report.orders.excel') }}" class="export-option">
                        <i class="bi bi-file-earmark-excel"></i>
                        <div>
                            <strong>Pesanan (Excel)</strong>
                            <small>Data pesanan dalam spreadsheet</small>
                        </div>
                    </a>
                    <a href="{{ route('report.revenue.pdf') }}" class="export-option">
                        <i class="bi bi-file-earmark-pdf"></i>
                        <div>
                            <strong>Pendapatan (PDF)</strong>
                            <small>Laporan revenue lengkap</small>
                        </div>
                    </a>
                    <a href="{{ route('report.revenue.excel') }}" class="export-option">
                        <i class="bi bi-file-earmark-excel"></i>
                        <div>
                            <strong>Pendapatan (Excel)</strong>
                            <small>Data revenue dalam spreadsheet</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .header-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-outline-light {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
    }

    .btn-outline-light:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        color: #fff;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 0.5rem;
    }

    .stat-trend i {
        font-size: 1.25rem;
    }

    .card-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .card-header-custom h4 {
        margin: 0;
    }

    .chart-container {
        position: relative;
        height: 250px;
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .status-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: rgba(34, 197, 94, 0.05);
        border: 1px solid rgba(34, 197, 94, 0.1);
        border-radius: 0.75rem;
    }

    .status-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        box-shadow: 0 0 10px currentColor;
    }

    .activity-card {
        text-align: center;
        padding: 2rem 1.5rem !important;
    }

    .activity-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1.5rem;
    }

    .activity-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.5rem;
    }

    .activity-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .activity-footer {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(34, 197, 94, 0.1);
    }

    .report-nav-card {
        background: linear-gradient(135deg, rgba(26, 58, 26, 0.5) 0%, rgba(22, 50, 30, 0.5) 100%);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 1rem;
        padding: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .report-nav-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.05) 0%, transparent 50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .report-nav-card:hover {
        border-color: rgba(34, 197, 94, 0.5);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
    }

    .report-nav-card:hover::before {
        opacity: 1;
    }

    .report-nav-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .report-nav-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .report-nav-arrow {
        font-size: 1.5rem;
        color: rgba(34, 197, 94, 0.5);
        transition: all 0.3s ease;
    }

    .report-nav-card:hover .report-nav-arrow {
        color: #22c55e;
        transform: translateX(5px);
    }

    .report-nav-content {
        position: relative;
        z-index: 1;
    }

    .report-nav-content h5 {
        font-size: 1.15rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.5rem;
    }

    .report-nav-content p {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .report-stats {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        padding-top: 0.75rem;
        border-top: 1px solid rgba(34, 197, 94, 0.1);
    }

    .report-stats i {
        color: #16a34a;
    }

    .export-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .export-btn {
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #22c55e;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }

    .export-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .export-btn:hover::before {
        left: 100%;
    }

    .export-btn i {
        font-size: 1.1rem;
        transition: transform 0.3s ease;
    }

    .export-btn:hover i {
        transform: scale(1.1);
    }

    /* PDF Button - Red Theme */
    .export-btn-pdf {
        background: rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }

    .export-btn-pdf:hover {
        background: rgba(239, 68, 68, 0.25);
        border-color: #ef4444;
        color: #fca5a5;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    /* Excel Button - Green Theme */
    .export-btn-excel {
        background: rgba(34, 197, 94, 0.15);
        border-color: rgba(34, 197, 94, 0.3);
        color: #22c55e;
    }

    .export-btn-excel:hover {
        background: rgba(34, 197, 94, 0.25);
        border-color: #16a34a;
        color: #4ade80;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    }

    .export-btn span {
        position: relative;
        z-index: 1;
    }

    .special-card {
        background: linear-gradient(135deg, rgba(234, 179, 8, 0.1) 0%, rgba(202, 138, 4, 0.1) 100%);
        border-color: rgba(234, 179, 8, 0.3);
    }

    .special-card:hover {
        border-color: rgba(234, 179, 8, 0.5);
        box-shadow: 0 10px 30px rgba(234, 179, 8, 0.3);
    }

    .special-card .report-nav-arrow {
        color: rgba(234, 179, 8, 0.5);
    }

    .special-card:hover .report-nav-arrow {
        color: #fbbf24;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .quick-action-btn {
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 0.75rem;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        color: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .quick-action-btn i {
        font-size: 2rem;
        color: #16a34a;
    }

    .quick-action-btn:hover {
        background: rgba(34, 197, 94, 0.2);
        border-color: #16a34a;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(34, 197, 94, 0.2);
    }

    @media (max-width: 768px) {
        .header-actions {
            flex-direction: column;
            width: 100%;
        }

        .header-actions button {
            width: 100%;
        }

        .page-header .d-flex {
            flex-direction: column;
            gap: 1rem;
        }

        .status-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions-grid {
            grid-template-columns: 1fr;
        }

        .activity-card {
            padding: 1.5rem 1rem !important;
        }

        .activity-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .activity-value {
            font-size: 2rem;
        }
    }
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });

    // Order Status Chart
    const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    const orderStatusChart = new Chart(orderStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Pending'],
            datasets: [{
                data: [{{ $stats['completed_orders'] }}, {{ $stats['pending_payments'] }}],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(249, 115, 22, 0.8)'
                ],
                borderColor: [
                    'rgba(34, 197, 94, 1)',
                    'rgba(249, 115, 22, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(10, 31, 10, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(34, 197, 94, 0.5)',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.parsed + ' orders';
                            return label;
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Revenue Trend Chart
    const revenueTrendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    
    // Sample data - replace with actual data from backend
    const last7Days = [];
    const revenueData = [];
    for (let i = 6; i >= 0; i--) {
        const date = new Date();
        date.setDate(date.getDate() - i);
        last7Days.push(date.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric' }));
        // Random data for demo - replace with actual data
        revenueData.push(Math.floor(Math.random() * 5000000) + 2000000);
    }

    const revenueTrendChart = new Chart(revenueTrendCtx, {
        type: 'line',
        data: {
            labels: last7Days,
            datasets: [{
                label: 'Pendapatan',
                data: revenueData,
                borderColor: 'rgba(168, 85, 247, 1)',
                backgroundColor: 'rgba(168, 85, 247, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(168, 85, 247, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(10, 31, 10, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(168, 85, 247, 0.5)',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(34, 197, 94, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.6)',
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.6)'
                    }
                }
            }
        }
    });

    // Auto refresh every 5 minutes
    setInterval(function() {
        // Show notification
        const notification = document.createElement('div');
        notification.className = 'alert alert-success position-fixed';
        notification.style.cssText = 'top: 100px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Data diperbarui';
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }, 300000); // 5 minutes

    // Print functionality
    function printReport(type) {
        window.print();
    }

    // Period selector for revenue chart
    document.querySelectorAll('.btn-group button').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.btn-group button').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Update chart based on selection
            // This would fetch new data from server in production
            const period = this.textContent.trim();
            console.log('Selected period:', period);
        });
    });

    // Animate numbers on load
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            
            // Format dengan Rupiah jika element punya class untuk rupiah
            if (element.closest('.stat-card.purple')) {
                element.textContent = 'Rp ' + value.toLocaleString('id-ID');
            } else {
                element.textContent = value.toLocaleString('id-ID');
            }
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Animate stat cards on load
    window.addEventListener('load', function() {
        document.querySelectorAll('.stat-card-info h3').forEach((el, index) => {
            const text = el.textContent.trim();
            const match = text.match(/[\d.,]+/g);
            if (match) {
                // Ambil semua angka dan hapus pemisah
                const numberStr = match.join('').replace(/\./g, '').replace(/,/g, '');
                const number = parseInt(numberStr);
                
                if (!isNaN(number)) {
                    // Simpan prefix (Rp) jika ada
                    const hasRp = text.includes('Rp');
                    el.textContent = hasRp ? 'Rp 0' : '0';
                    
                    setTimeout(() => {
                        animateValue(el, 0, number, 1500);
                    }, index * 100);
                }
            }
        });
    });

    // Add pulse animation to pending badge
    setInterval(() => {
        document.querySelectorAll('.badge-warning').forEach(badge => {
            badge.style.animation = 'pulse 1s ease-in-out';
            setTimeout(() => {
                badge.style.animation = '';
            }, 1000);
        });
    }, 5000);

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Alt + R = Refresh
        if (e.altKey && e.key === 'r') {
            e.preventDefault();
            location.reload();
        }
        // Alt + T = Transactions Report
        if (e.altKey && e.key === 't') {
            e.preventDefault();
            window.location.href = '{{ route("report.transactions") }}';
        }
        // Alt + O = Orders Report
        if (e.altKey && e.key === 'o') {
            e.preventDefault();
            window.location.href = '{{ route("report.orders") }}';
        }
    });
</script>

<style>
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    /* Print styles */
    @media print {
        .header-actions,
        .quick-actions-grid,
        .report-nav-card,
        .modal {
            display: none !important;
        }

        .stat-card,
        .data-card {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        body {
            background: white !important;
            color: black !important;
        }

        .stat-card,
        .data-card {
            border: 1px solid #ddd !important;
            background: white !important;
        }
    }

    /* Smooth hover transitions */
    * {
        transition: all 0.3s ease;
    }

    /* Loading state */
    .loading {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Tooltip styles */
    [data-bs-toggle="tooltip"] {
        cursor: help;
    }

    /* Focus styles for accessibility */
    button:focus,
    a:focus {
        outline: 2px solid rgba(34, 197, 94, 0.5);
        outline-offset: 2px;
    }

    /* Responsive table wrapper */
    .table-responsive {
        border-radius: 0.75rem;
        overflow: hidden;
    }

    /* Custom scrollbar for modal */
    .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: rgba(34, 197, 94, 0.05);
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: rgba(34, 197, 94, 0.3);
        border-radius: 4px;
    }

    /* Shimmer effect for loading */
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }

    .shimmer {
        animation: shimmer 2s infinite linear;
        background: linear-gradient(
            to right,
            rgba(34, 197, 94, 0.05) 0%,
            rgba(34, 197, 94, 0.15) 50%,
            rgba(34, 197, 94, 0.05) 100%
        );
        background-size: 1000px 100%;
    }

    /* Status indicator animations */
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .status-indicator.active {
        animation: blink 2s infinite;
    }

    /* Card entrance animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card,
    .data-card,
    .report-nav-card {
        animation: slideInUp 0.6s ease-out backwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    /* Gradient text animation */
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .page-header h1 {
        background-size: 200% auto;
        animation: gradientShift 3s ease infinite;
    }

    /* Floating animation for icons */
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .stat-card-icon {
        animation: float 3s ease-in-out infinite;
    }

    .stat-card:hover .stat-card-icon {
        animation-play-state: paused;
    }

    /* Success notification animation */
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .alert.position-fixed {
        animation: slideInRight 0.5s ease-out;
    }

    /* Badge pulse animation */
    .badge-success {
        animation: pulse 2s ease-in-out infinite;
    }

    /* Glow effect on hover */
    .report-nav-card:hover {
        box-shadow: 
            0 10px 30px rgba(34, 197, 94, 0.3),
            0 0 20px rgba(34, 197, 94, 0.2) inset;
    }

    .special-card:hover {
        box-shadow: 
            0 10px 30px rgba(234, 179, 8, 0.3),
            0 0 20px rgba(234, 179, 8, 0.2) inset;
    }
</style>
@endsection