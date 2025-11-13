@extends('layouts.app')

@section('title', 'Laporan & Statistik')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-header">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="icon-wrapper me-3">
                                    <i class="bi bi-bar-chart-line-fill"></i>
                                </div>
                                <div>
                                    <h2 class="mb-0 text-white fw-bold">Laporan & Statistik</h2>
                                    <p class="text-white-50 mb-0 small">Dashboard laporan dan analisis bisnis laundry</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="badge bg-white text-dark px-4 py-2 shadow-sm">
                                <i class="bi bi-calendar-check me-2"></i>
                                {{ now()->format('d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Orders -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm stat-card stat-card-blue h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-blue">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <span class="badge bg-blue-light text-blue">Semua Waktu</span>
                    </div>
                    <p class="text-muted mb-1 small fw-medium">Total Orders</p>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($stats['total_orders']) }}</h2>
                    <div class="stat-trend mt-2">
                        <i class="bi bi-arrow-up-right text-success me-1"></i>
                        <small class="text-success fw-medium">Terus meningkat</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transactions -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm stat-card stat-card-cyan h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-cyan">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <span class="badge bg-cyan-light text-cyan">Semua Waktu</span>
                    </div>
                    <p class="text-muted mb-1 small fw-medium">Total Transaksi</p>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($stats['total_transactions']) }}</h2>
                    <div class="stat-trend mt-2">
                        <i class="bi bi-graph-up text-cyan me-1"></i>
                        <small class="text-cyan fw-medium">Aktif bertransaksi</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm stat-card stat-card-green h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-green">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <span class="badge bg-green-light text-green">Confirmed</span>
                    </div>
                    <p class="text-muted mb-1 small fw-medium">Total Pendapatan</p>
                    <h2 class="mb-0 fw-bold text-dark" style="font-size: 1.5rem;">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h2>
                    <div class="stat-trend mt-2">
                        <i class="bi bi-graph-up-arrow text-success me-1"></i>
                        <small class="text-success fw-medium">Revenue terkonfirmasi</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm stat-card stat-card-purple h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-purple">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <span class="badge bg-purple-light text-purple">Completed</span>
                    </div>
                    <p class="text-muted mb-1 small fw-medium">Order Selesai</p>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($stats['completed_orders']) }}</h2>
                    <div class="stat-trend mt-2">
                        <i class="bi bi-check-circle-fill text-purple me-1"></i>
                        <small class="text-purple fw-medium">Sukses diselesaikan</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm stat-card stat-card-orange h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-orange">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <span class="badge bg-orange-light text-orange">Menunggu</span>
                    </div>
                    <p class="text-muted mb-1 small fw-medium">Pembayaran Pending</p>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($stats['pending_payments']) }}</h2>
                    <div class="stat-trend mt-2">
                        <i class="bi bi-hourglass-split text-warning me-1"></i>
                        <small class="text-warning fw-medium">Perlu tindak lanjut</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Menu -->
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="fw-bold mb-0">
                <i class="bi bi-file-text text-primary me-2"></i>
                Menu Laporan
            </h4>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <!-- Laporan Transaksi -->
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm report-card h-100">
                <div class="card-body p-4">
                    <div class="report-icon-wrapper bg-blue-gradient mb-3">
                        <i class="bi bi-credit-card-2-front"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-2">Laporan Transaksi</h5>
                    <p class="card-text text-muted small mb-4">
                        Detail transaksi pembayaran, filter berdasarkan tanggal, status, dan metode pembayaran
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('report.transactions') }}" class="btn btn-primary btn-sm flex-grow-1">
                            <i class="bi bi-eye me-1"></i> Lihat
                        </a>
                        <a href="{{ route('report.transactions.pdf') }}" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-file-pdf"></i>
                        </a>
                        <a href="{{ route('report.transactions.excel') }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-file-excel"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Orders -->
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm report-card h-100">
                <div class="card-body p-4">
                    <div class="report-icon-wrapper bg-cyan-gradient mb-3">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-2">Laporan Orders</h5>
                    <p class="card-text text-muted small mb-4">
                        Detail semua order laundry, status pengerjaan, dan informasi pelanggan
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('report.orders') }}" class="btn btn-info btn-sm flex-grow-1">
                            <i class="bi bi-eye me-1"></i> Lihat
                        </a>
                        <a href="{{ route('report.orders.pdf') }}" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-file-pdf"></i>
                        </a>
                        <a href="{{ route('report.orders.excel') }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-file-excel"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Pendapatan -->
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm report-card h-100">
                <div class="card-body p-4">
                    <div class="report-icon-wrapper bg-green-gradient mb-3">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-2">Laporan Pendapatan</h5>
                    <p class="card-text text-muted small mb-4">
                        Analisis pendapatan harian, breakdown per metode pembayaran dan periode
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('report.revenue') }}" class="btn btn-success btn-sm flex-grow-1">
                            <i class="bi bi-eye me-1"></i> Lihat
                        </a>
                        <a href="{{ route('report.revenue.pdf') }}" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-file-pdf"></i>
                        </a>
                        <a href="{{ route('report.revenue.excel') }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-file-excel"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Pelanggan -->
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm report-card h-100">
                <div class="card-body p-4">
                    <div class="report-icon-wrapper bg-orange-gradient mb-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-2">Laporan Pelanggan</h5>
                    <p class="card-text text-muted small mb-4">
                        Data pelanggan, total order dan total spending per pelanggan
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('report.customers') }}" class="btn btn-warning btn-sm flex-grow-1">
                            <i class="bi bi-eye me-1"></i> Lihat
                        </a>
                        <a href="{{ route('report.customers.excel') }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-file-excel"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Layanan -->
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm report-card h-100">
                <div class="card-body p-4">
                    <div class="report-icon-wrapper bg-purple-gradient mb-3">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-2">Laporan Layanan</h5>
                    <p class="card-text text-muted small mb-4">
                        Layanan terpopuler berdasarkan quantity dan revenue yang dihasilkan
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('report.services') }}" class="btn btn-purple btn-sm flex-grow-1">
                            <i class="bi bi-eye me-1"></i> Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm quick-actions-card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="bi bi-lightning-charge-fill text-warning me-2"></i>
                        Quick Actions
                    </h5>
                    <div class="row g-2">
                        <div class="col-lg-auto col-md-6">
                            <a href="{{ route('report.transactions', ['start_date' => now()->startOfMonth()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}" 
                               class="btn btn-outline-primary btn-sm w-100 quick-action-btn">
                                <i class="bi bi-calendar-range me-2"></i> Transaksi Bulan Ini
                            </a>
                        </div>
                        <div class="col-lg-auto col-md-6">
                            <a href="{{ route('report.orders', ['status' => 'completed']) }}" 
                               class="btn btn-outline-success btn-sm w-100 quick-action-btn">
                                <i class="bi bi-check-circle me-2"></i> Order Selesai
                            </a>
                        </div>
                        <div class="col-lg-auto col-md-6">
                            <a href="{{ route('report.transactions', ['status' => 'pending']) }}" 
                               class="btn btn-outline-warning btn-sm w-100 quick-action-btn">
                                <i class="bi bi-hourglass-split me-2"></i> Pembayaran Pending
                            </a>
                        </div>
                        <div class="col-lg-auto col-md-6">
                            <a href="{{ route('report.revenue', ['start_date' => now()->startOfMonth()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}" 
                               class="btn btn-outline-info btn-sm w-100 quick-action-btn">
                                <i class="bi bi-graph-up me-2"></i> Pendapatan Bulan Ini
                            </a>
                        </div>
                        <div class="col-lg-auto col-md-6">
                            <a href="{{ route('report.customers', ['sort_by' => 'total_spent']) }}" 
                               class="btn btn-outline-secondary btn-sm w-100 quick-action-btn">
                                <i class="bi bi-star-fill me-2"></i> Top Customers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Header Gradient */
    .bg-gradient-header {
        background: linear-gradient(135deg, #1a5f3f 0%, #2d8659 100%);
        border-radius: 12px !important;
    }
    
    .icon-wrapper {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    /* Statistics Cards */
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 12px !important;
        overflow: hidden;
        position: relative;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--card-color-1), var(--card-color-2));
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .stat-card-blue {
        --card-color-1: #4285f4;
        --card-color-2: #2196f3;
    }
    
    .stat-card-cyan {
        --card-color-1: #00bcd4;
        --card-color-2: #00acc1;
    }
    
    .stat-card-green {
        --card-color-1: #10b981;
        --card-color-2: #059669;
    }
    
    .stat-card-purple {
        --card-color-1: #8b5cf6;
        --card-color-2: #7c3aed;
    }
    
    .stat-card-orange {
        --card-color-1: #f97316;
        --card-color-2: #ea580c;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
    }
    
    .bg-blue { background: linear-gradient(135deg, #4285f4, #2196f3); }
    .bg-cyan { background: linear-gradient(135deg, #00bcd4, #00acc1); }
    .bg-green { background: linear-gradient(135deg, #10b981, #059669); }
    .bg-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .bg-orange { background: linear-gradient(135deg, #f97316, #ea580c); }
    
    .bg-blue-light { background-color: #e3f2fd; }
    .bg-cyan-light { background-color: #e0f7fa; }
    .bg-green-light { background-color: #d1fae5; }
    .bg-purple-light { background-color: #f3e8ff; }
    .bg-orange-light { background-color: #ffedd5; }
    
    .text-blue { color: #2196f3; }
    .text-cyan { color: #00acc1; }
    .text-green { color: #059669; }
    .text-purple { color: #7c3aed; }
    .text-orange { color: #ea580c; }
    
    .stat-trend {
        padding-top: 8px;
        border-top: 1px solid #f0f0f0;
    }

    /* Report Cards */
    .report-card {
        transition: all 0.3s ease;
        border-radius: 12px !important;
    }
    
    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .report-icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
    }
    
    .bg-blue-gradient { background: linear-gradient(135deg, #4285f4, #2196f3); }
    .bg-cyan-gradient { background: linear-gradient(135deg, #00bcd4, #00acc1); }
    .bg-green-gradient { background: linear-gradient(135deg, #10b981, #059669); }
    .bg-orange-gradient { background: linear-gradient(135deg, #f97316, #ea580c); }
    .bg-purple-gradient { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    
    .btn-purple {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        border: none;
    }
    
    .btn-purple:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    /* Quick Actions */
    .quick-actions-card {
        border-radius: 12px !important;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }
    
    .quick-action-btn {
        font-weight: 500;
        padding: 10px 20px;
        border-width: 2px;
        transition: all 0.3s ease;
    }
    
    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .stat-card h2 {
            font-size: 1.5rem;
        }
        
        .report-icon-wrapper {
            width: 60px;
            height: 60px;
            font-size: 28px;
        }
        
        .icon-wrapper {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }
    }
</style>
@endsection