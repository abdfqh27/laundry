@extends('layouts.app')

@section('title', 'Laporan & Statistik')

@section('content')
<div class="container-fluid py-4">
    <!-- Header with Animation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg header-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper-large me-3">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <div class="icon-pulse"></div>
                                </div>
                                <div>
                                    <h2 class="mb-1 text-white fw-bold display-6">Laporan & Statistik</h2>
                                    <p class="text-white-50 mb-0">Dashboard analisis bisnis laundry real-time</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="date-badge">
                                <i class="bi bi-calendar3 me-2"></i>
                                {{ now()->format('d F Y') }}
                            </div>
                            <div class="status-indicator mt-2">
                                <span class="pulse-dot"></span>
                                <small class="text-white-50">Data terupdate</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards with Hover Effects -->
    <div class="row g-4 mb-4">
        <!-- Total Orders -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-blue">
                <div class="stat-card-inner">
                    <div class="stat-background">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div class="stat-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-modern">
                                <i class="bi bi-receipt-cutoff"></i>
                            </div>
                            <span class="badge-modern badge-blue">All Time</span>
                        </div>
                        <p class="stat-label mb-2">Total Orders</p>
                        <h2 class="stat-value mb-2">{{ number_format($stats['total_orders']) }}</h2>
                        <div class="stat-info">
                            <span class="trend-up">
                                <i class="bi bi-arrow-up-right"></i>
                                Terus meningkat
                            </span>
                        </div>
                    </div>
                    <div class="stat-overlay"></div>
                </div>
            </div>
        </div>

        <!-- Total Transactions -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-cyan">
                <div class="stat-card-inner">
                    <div class="stat-background">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="stat-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-modern">
                                <i class="bi bi-credit-card-2-front"></i>
                            </div>
                            <span class="badge-modern badge-cyan">Active</span>
                        </div>
                        <p class="stat-label mb-2">Total Transaksi</p>
                        <h2 class="stat-value mb-2">{{ number_format($stats['total_transactions']) }}</h2>
                        <div class="stat-info">
                            <span class="trend-up">
                                <i class="bi bi-graph-up"></i>
                                Aktif bertransaksi
                            </span>
                        </div>
                    </div>
                    <div class="stat-overlay"></div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-green">
                <div class="stat-card-inner">
                    <div class="stat-background">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div class="stat-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-modern">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <span class="badge-modern badge-green">Confirmed</span>
                        </div>
                        <p class="stat-label mb-2">Total Pendapatan</p>
                        <h2 class="stat-value mb-2" style="font-size: 1.5rem;">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h2>
                        <div class="stat-info">
                            <span class="trend-up">
                                <i class="bi bi-graph-up-arrow"></i>
                                Revenue terkonfirmasi
                            </span>
                        </div>
                    </div>
                    <div class="stat-overlay"></div>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-purple">
                <div class="stat-card-inner">
                    <div class="stat-background">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-modern">
                                <i class="bi bi-check2-circle"></i>
                            </div>
                            <span class="badge-modern badge-purple">Done</span>
                        </div>
                        <p class="stat-label mb-2">Order Selesai</p>
                        <h2 class="stat-value mb-2">{{ number_format($stats['completed_orders']) }}</h2>
                        <div class="stat-info">
                            <span class="trend-up">
                                <i class="bi bi-check-circle-fill"></i>
                                Sukses diselesaikan
                            </span>
                        </div>
                    </div>
                    <div class="stat-overlay"></div>
                </div>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-orange">
                <div class="stat-card-inner">
                    <div class="stat-background">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="stat-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-modern">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <span class="badge-modern badge-orange">Pending</span>
                        </div>
                        <p class="stat-label mb-2">Pembayaran Pending</p>
                        <h2 class="stat-value mb-2">{{ number_format($stats['pending_payments']) }}</h2>
                        <div class="stat-info">
                            <span class="trend-warning">
                                <i class="bi bi-clock-history"></i>
                                Perlu tindak lanjut
                            </span>
                        </div>
                    </div>
                    <div class="stat-overlay"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Section Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="section-header">
                <div class="section-header-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div>
                    <h4 class="mb-0 text-dark fw-bold">Menu Laporan</h4>
                    <p class="text-muted small mb-0">Akses berbagai laporan bisnis</p>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Report Cards with Modern Design -->
    <div class="row g-4 mb-4">
        <!-- Laporan Transaksi -->
        <div class="col-xl-4 col-md-6">
            <div class="report-card-modern report-blue">
                <div class="report-card-glow"></div>
                <div class="report-card-content">
                    <div class="report-icon-circle">
                        <i class="bi bi-credit-card-2-front"></i>
                    </div>
                    <h5 class="report-title">Laporan Transaksi</h5>
                    <p class="report-description">
                        Detail transaksi pembayaran dengan filter lengkap berdasarkan periode dan status
                    </p>
                    <div class="report-actions">
                        <a href="{{ route('report.transactions') }}" class="btn btn-report btn-primary">
                            <i class="bi bi-eye me-2"></i> Lihat Laporan
                        </a>
                        <div class="btn-group mt-2 w-100">
                            <a href="{{ route('report.transactions.pdf') }}" class="btn btn-export btn-pdf">
                                <i class="bi bi-file-pdf"></i> PDF
                            </a>
                            <a href="{{ route('report.transactions.excel') }}" class="btn btn-export btn-excel">
                                <i class="bi bi-file-excel"></i> Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Orders -->
        <div class="col-xl-4 col-md-6">
            <div class="report-card-modern report-cyan">
                <div class="report-card-glow"></div>
                <div class="report-card-content">
                    <div class="report-icon-circle">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <h5 class="report-title">Laporan Orders</h5>
                    <p class="report-description">
                        Tracking semua order laundry, status real-time, dan detail pelanggan
                    </p>
                    <div class="report-actions">
                        <a href="{{ route('report.orders') }}" class="btn btn-report btn-info">
                            <i class="bi bi-eye me-2"></i> Lihat Laporan
                        </a>
                        <div class="btn-group mt-2 w-100">
                            <a href="{{ route('report.orders.pdf') }}" class="btn btn-export btn-pdf">
                                <i class="bi bi-file-pdf"></i> PDF
                            </a>
                            <a href="{{ route('report.orders.excel') }}" class="btn btn-export btn-excel">
                                <i class="bi bi-file-excel"></i> Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Pendapatan -->
        <div class="col-xl-4 col-md-6">
            <div class="report-card-modern report-green">
                <div class="report-card-glow"></div>
                <div class="report-card-content">
                    <div class="report-icon-circle">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h5 class="report-title">Laporan Pendapatan</h5>
                    <p class="report-description">
                        Analisis pendapatan lengkap dengan breakdown metode pembayaran
                    </p>
                    <div class="report-actions">
                        <a href="{{ route('report.revenue') }}" class="btn btn-report btn-success">
                            <i class="bi bi-eye me-2"></i> Lihat Laporan
                        </a>
                        <div class="btn-group mt-2 w-100">
                            <a href="{{ route('report.revenue.pdf') }}" class="btn btn-export btn-pdf">
                                <i class="bi bi-file-pdf"></i> PDF
                            </a>
                            <a href="{{ route('report.revenue.excel') }}" class="btn btn-export btn-excel">
                                <i class="bi bi-file-excel"></i> Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Pelanggan -->
        <div class="col-xl-4 col-md-6">
            <div class="report-card-modern report-orange">
                <div class="report-card-glow"></div>
                <div class="report-card-content">
                    <div class="report-icon-circle">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="report-title">Laporan Pelanggan</h5>
                    <p class="report-description">
                        Database pelanggan lengkap dengan statistik order dan spending
                    </p>
                    <div class="report-actions">
                        <a href="{{ route('report.customers') }}" class="btn btn-report btn-warning">
                            <i class="bi bi-eye me-2"></i> Lihat Laporan
                        </a>
                        <div class="btn-group mt-2 w-100">
                            <a href="{{ route('report.customers.excel') }}" class="btn btn-export btn-excel w-100">
                                <i class="bi bi-file-excel"></i> Export Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Layanan -->
        <div class="col-xl-4 col-md-6">
            <div class="report-card-modern report-purple">
                <div class="report-card-glow"></div>
                <div class="report-card-content">
                    <div class="report-icon-circle">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <h5 class="report-title">Laporan Layanan</h5>
                    <p class="report-description">
                        Analisis layanan terpopuler dan performa revenue per layanan
                    </p>
                    <div class="report-actions">
                        <a href="{{ route('report.services') }}" class="btn btn-report btn-purple">
                            <i class="bi bi-eye me-2"></i> Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions with Animation -->
    <div class="row">
        <div class="col-12">
            <div class="quick-actions-modern">
                <div class="quick-actions-header">
                    <div class="d-flex align-items-center">
                        <div class="quick-icon">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Quick Actions</h5>
                            <p class="text-muted small mb-0">Akses cepat ke laporan favorit</p>
                        </div>
                    </div>
                </div>
                <div class="quick-actions-body">
                    <div class="row g-3">
                        <div class="col-lg col-md-6">
                            <a href="{{ route('report.transactions', ['start_date' => now()->startOfMonth()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}" 
                               class="quick-btn quick-btn-blue">
                                <i class="bi bi-calendar-range"></i>
                                <span>Transaksi Bulan Ini</span>
                            </a>
                        </div>
                        <div class="col-lg col-md-6">
                            <a href="{{ route('report.orders', ['status' => 'completed']) }}" 
                               class="quick-btn quick-btn-green">
                                <i class="bi bi-check-circle"></i>
                                <span>Order Selesai</span>
                            </a>
                        </div>
                        <div class="col-lg col-md-6">
                            <a href="{{ route('report.transactions', ['status' => 'pending']) }}" 
                               class="quick-btn quick-btn-orange">
                                <i class="bi bi-hourglass-split"></i>
                                <span>Pembayaran Pending</span>
                            </a>
                        </div>
                        <div class="col-lg col-md-6">
                            <a href="{{ route('report.revenue', ['start_date' => now()->startOfMonth()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}" 
                               class="quick-btn quick-btn-cyan">
                                <i class="bi bi-graph-up"></i>
                                <span>Pendapatan Bulan Ini</span>
                            </a>
                        </div>
                        <div class="col-lg col-md-6">
                            <a href="{{ route('report.customers', ['sort_by' => 'total_spent']) }}" 
                               class="quick-btn quick-btn-purple">
                                <i class="bi bi-star-fill"></i>
                                <span>Top Customers</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Header Card */
    .header-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #3b82f6 100%);
        border-radius: 20px !important;
        position: relative;
        overflow: hidden;
    }
    
    .header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .icon-wrapper-large {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        position: relative;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    
    .icon-pulse {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 18px;
        background: rgba(255,255,255,0.3);
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0; }
    }
    
    .date-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 12px 24px;
        border-radius: 50px;
        color: white;
        font-weight: 500;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .status-indicator {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: flex-end;
    }
    
    .pulse-dot {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        animation: pulse-dot 2s infinite;
        box-shadow: 0 0 10px #10b981;
    }
    
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    /* Modern Statistics Cards */
    .stat-card {
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }
    
    .stat-card-inner {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        padding: 24px;
        position: relative;
        height: 100%;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .stat-card-blue .stat-card-inner {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    }
    
    .stat-card-cyan .stat-card-inner {
        background: linear-gradient(135deg, #ecfeff 0%, #cffafe 100%);
    }
    
    .stat-card-green .stat-card-inner {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    }
    
    .stat-card-purple .stat-card-inner {
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    }
    
    .stat-card-orange .stat-card-inner {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15) !important;
    }
    
    .stat-card:hover .stat-overlay {
        opacity: 1;
    }
    
    .stat-background {
        position: absolute;
        top: -20px;
        right: -20px;
        font-size: 120px;
        opacity: 0.05;
        transition: all 0.4s ease;
    }
    
    .stat-card:hover .stat-background {
        transform: rotate(15deg) scale(1.1);
        opacity: 0.08;
    }
    
    .stat-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    
    .stat-card-blue .stat-overlay { background: linear-gradient(90deg, #3b82f6, #2563eb); }
    .stat-card-cyan .stat-overlay { background: linear-gradient(90deg, #06b6d4, #0891b2); }
    .stat-card-green .stat-overlay { background: linear-gradient(90deg, #10b981, #059669); }
    .stat-card-purple .stat-overlay { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
    .stat-card-orange .stat-overlay { background: linear-gradient(90deg, #f97316, #ea580c); }
    
    .stat-content {
        position: relative;
        z-index: 1;
    }
    
    .stat-icon-modern {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: white;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .stat-icon-modern {
        transform: scale(1.05);
    }
    
    .stat-card-blue .stat-icon-modern { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .stat-card-cyan .stat-icon-modern { background: linear-gradient(135deg, #06b6d4, #0891b2); }
    .stat-card-green .stat-icon-modern { background: linear-gradient(135deg, #10b981, #059669); }
    .stat-card-purple .stat-icon-modern { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .stat-card-orange .stat-icon-modern { background: linear-gradient(135deg, #f97316, #ea580c); }
    
    .badge-modern {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-blue { background: rgba(59, 130, 246, 0.15); color: #2563eb; }
    .badge-cyan { background: rgba(6, 182, 212, 0.15); color: #0891b2; }
    .badge-green { background: rgba(16, 185, 129, 0.15); color: #059669; }
    .badge-purple { background: rgba(139, 92, 246, 0.15); color: #7c3aed; }
    .badge-orange { background: rgba(249, 115, 22, 0.15); color: #ea580c; }
    
    .stat-label {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
    }
    
    .stat-info {
        padding-top: 12px;
        border-top: 2px solid #f1f5f9;
        margin-top: 12px;
    }
    
    .trend-up, .trend-warning {
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .trend-up { color: #10b981; }
    .trend-warning { color: #f59e0b; }

    /* Section Header */
    .section-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
    }
    
    .section-header-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    /* Modern Report Cards */
    .report-card-modern {
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }
    
    .report-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
    }
    
    .report-blue::before {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    }
    
    .report-cyan::before {
        background: linear-gradient(135deg, #ecfeff 0%, #cffafe 100%);
    }
    
    .report-green::before {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    }
    
    .report-orange::before {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
    }
    
    .report-purple::before {
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    }
    
    .report-card-modern:hover::before {
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }
    
    .report-card-modern:hover {
        transform: translateY(-8px);
    }
    
    .report-card-glow {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    
    .report-card-modern:hover .report-card-glow {
        opacity: 1;
    }
    
    .report-blue .report-card-glow { background: linear-gradient(90deg, #3b82f6, #2563eb); }
    .report-cyan .report-card-glow { background: linear-gradient(90deg, #06b6d4, #0891b2); }
    .report-green .report-card-glow { background: linear-gradient(90deg, #10b981, #059669); }
    .report-orange .report-card-glow { background: linear-gradient(90deg, #f97316, #ea580c); }
    .report-purple .report-card-glow { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
    
    .report-card-content {
        position: relative;
        padding: 28px;
        z-index: 1;
    }
    
    .report-icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        margin-bottom: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
    
    .report-card-modern:hover .report-icon-circle {
        transform: scale(1.05) rotate(5deg);
    }
    
    .report-blue .report-icon-circle { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .report-cyan .report-icon-circle { background: linear-gradient(135deg, #06b6d4, #0891b2); }
    .report-green .report-icon-circle { background: linear-gradient(135deg, #10b981, #059669); }
    .report-orange .report-icon-circle { background: linear-gradient(135deg, #f97316, #ea580c); }
    .report-purple .report-icon-circle { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    
    .report-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }
    
    .report-description {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 24px;
        min-height: 48px;
    }
    
    .report-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .btn-report {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .btn-report:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    
    .btn-export {
        flex: 1;
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .btn-pdf {
        background: rgba(220, 38, 38, 0.1);
        color: #dc2626;
        border-color: rgba(220, 38, 38, 0.2);
    }
    
    .btn-pdf:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
    
    .btn-excel {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border-color: rgba(16, 185, 129, 0.2);
    }
    
    .btn-excel:hover {
        background: #10b981;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-purple {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        border: none;
    }
    
    .btn-purple:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
    }

    /* Quick Actions Modern */
    .quick-actions-modern {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    
    .quick-actions-header {
        padding: 24px 28px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 2px solid #e2e8f0;
    }
    
    .quick-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        margin-right: 16px;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }
    
    .quick-actions-body {
        padding: 28px;
    }
    
    .quick-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 24px 16px;
        border-radius: 16px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
        border: 2px solid #e2e8f0;
    }
    
    .quick-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .quick-btn:hover::before {
        opacity: 1;
    }
    
    .quick-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        border-color: transparent;
    }
    
    .quick-btn i {
        font-size: 28px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }
    
    .quick-btn span {
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        position: relative;
        z-index: 1;
    }
    
    .quick-btn-blue { border-color: rgba(59, 130, 246, 0.2); }
    .quick-btn-blue::before { background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.1)); }
    .quick-btn-blue i { color: #3b82f6; }
    .quick-btn-blue span { color: #2563eb; }
    .quick-btn-blue:hover { box-shadow: 0 8px 24px rgba(59, 130, 246, 0.2); }
    
    .quick-btn-green { border-color: rgba(16, 185, 129, 0.2); }
    .quick-btn-green::before { background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); }
    .quick-btn-green i { color: #10b981; }
    .quick-btn-green span { color: #059669; }
    .quick-btn-green:hover { box-shadow: 0 8px 24px rgba(16, 185, 129, 0.2); }
    
    .quick-btn-orange { border-color: rgba(249, 115, 22, 0.2); }
    .quick-btn-orange::before { background: linear-gradient(135deg, rgba(249, 115, 22, 0.1), rgba(234, 88, 12, 0.1)); }
    .quick-btn-orange i { color: #f97316; }
    .quick-btn-orange span { color: #ea580c; }
    .quick-btn-orange:hover { box-shadow: 0 8px 24px rgba(249, 115, 22, 0.2); }
    
    .quick-btn-cyan { border-color: rgba(6, 182, 212, 0.2); }
    .quick-btn-cyan::before { background: linear-gradient(135deg, rgba(6, 182, 212, 0.1), rgba(8, 145, 178, 0.1)); }
    .quick-btn-cyan i { color: #06b6d4; }
    .quick-btn-cyan span { color: #0891b2; }
    .quick-btn-cyan:hover { box-shadow: 0 8px 24px rgba(6, 182, 212, 0.2); }
    
    .quick-btn-purple { border-color: rgba(139, 92, 246, 0.2); }
    .quick-btn-purple::before { background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(124, 58, 237, 0.1)); }
    .quick-btn-purple i { color: #8b5cf6; }
    .quick-btn-purple span { color: #7c3aed; }
    .quick-btn-purple:hover { box-shadow: 0 8px 24px rgba(139, 92, 246, 0.2); }
    
    .quick-btn:hover i {
        transform: scale(1.15);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .stat-value {
            font-size: 1.75rem;
        }
        
        .report-icon-circle {
            width: 60px;
            height: 60px;
            font-size: 28px;
        }
    }
    
    @media (max-width: 768px) {
        .icon-wrapper-large {
            width: 60px;
            height: 60px;
            font-size: 28px;
        }
        
        .display-6 {
            font-size: 1.5rem;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
        
        .stat-icon-modern {
            width: 48px;
            height: 48px;
            font-size: 22px;
        }
        
        .report-card-content {
            padding: 20px;
        }
        
        .report-title {
            font-size: 1.1rem;
        }
        
        .report-description {
            font-size: 13px;
            min-height: auto;
        }
        
        .quick-btn {
            padding: 20px 12px;
        }
        
        .quick-btn i {
            font-size: 24px;
        }
        
        .quick-btn span {
            font-size: 12px;
        }
    }
    
    @media (max-width: 576px) {
        .date-badge {
            padding: 10px 16px;
            font-size: 13px;
        }
        
        .section-header {
            padding: 16px;
        }
        
        .section-header-icon {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }
        
        .quick-actions-header,
        .quick-actions-body {
            padding: 20px;
        }
    }
    
    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .stat-card,
    .report-card-modern,
    .quick-actions-modern {
        animation: fadeInUp 0.6s ease-out backwards;
    }
    
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(5) { animation-delay: 0.5s; }
    
    .report-card-modern:nth-child(1) { animation-delay: 0.2s; }
    .report-card-modern:nth-child(2) { animation-delay: 0.3s; }
    .report-card-modern:nth-child(3) { animation-delay: 0.4s; }
    .report-card-modern:nth-child(4) { animation-delay: 0.5s; }
    .report-card-modern:nth-child(5) { animation-delay: 0.6s; }
    
    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 5px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #2563eb, #1e40af);
    }
</style>
@endsection