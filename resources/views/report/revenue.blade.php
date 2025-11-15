@extends('layouts.app')

@section('title', 'Laporan Pendapatan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-graph-up-arrow me-2"></i>Laporan Pendapatan</h1>
            <p>Analisis pendapatan dan performa keuangan laundry</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('report.revenue.pdf', request()->query()) }}" class="btn btn-danger">
                <i class="bi bi-file-pdf me-2"></i>Export PDF
            </a>
            <a href="{{ route('report.revenue.excel', request()->query()) }}" class="btn btn-success">
                <i class="bi bi-file-excel me-2"></i>Export Excel
            </a>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="data-card mb-4">
    <h4><i class="bi bi-funnel"></i> Filter Periode</h4>
    <form action="{{ route('report.revenue') }}" method="GET">
        <div class="row g-3">
            <div class="col-md-5">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" 
                       value="{{ $startDate->format('Y-m-d') }}" max="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-5">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="end_date" class="form-control" 
                       value="{{ $endDate->format('Y-m-d') }}" max="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-2"></i>Filter
                </button>
            </div>
        </div>
        <div class="mt-3">
            <small class="text-muted">
                <i class="bi bi-info-circle"></i> 
                Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
            </small>
        </div>
    </form>
</div>

<!-- Summary Statistics -->
<div class="stat-card-grid">
    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</h3>
                <p>Total Pendapatan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>

    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ number_format($summary['total_transactions']) }}</h3>
                <p>Total Transaksi</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-receipt"></i>
            </div>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ number_format($summary['average_transaction'], 0, ',', '.') }}</h3>
                <p>Rata-rata per Transaksi</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-calculator"></i>
            </div>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $dailyRevenue->count() }}</h3>
                <p>Hari Operasional</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
        </div>
    </div>
</div>

<!-- Payment Method Breakdown -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="data-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem;">💵 Cash</p>
                    <h4 class="mb-0" style="color: #22c55e;">Rp {{ number_format($summary['by_payment_method']['cash'], 0, ',', '.') }}</h4>
                    <small style="color: rgba(255, 255, 255, 0.6);">
                        {{ $summary['total_revenue'] > 0 ? number_format(($summary['by_payment_method']['cash'] / $summary['total_revenue']) * 100, 1) : 0 }}% dari total
                    </small>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(34, 197, 94, 0.2); display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-cash" style="font-size: 1.5rem; color: #22c55e;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="data-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem;">🏦 Transfer</p>
                    <h4 class="mb-0" style="color: #60a5fa;">Rp {{ number_format($summary['by_payment_method']['transfer'], 0, ',', '.') }}</h4>
                    <small style="color: rgba(255, 255, 255, 0.6);">
                        {{ $summary['total_revenue'] > 0 ? number_format(($summary['by_payment_method']['transfer'] / $summary['total_revenue']) * 100, 1) : 0 }}% dari total
                    </small>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-bank" style="font-size: 1.5rem; color: #60a5fa;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="data-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem;">📱 QRIS</p>
                    <h4 class="mb-0" style="color: #c084fc;">Rp {{ number_format($summary['by_payment_method']['qris'], 0, ',', '.') }}</h4>
                    <small style="color: rgba(255, 255, 255, 0.6);">
                        {{ $summary['total_revenue'] > 0 ? number_format(($summary['by_payment_method']['qris'] / $summary['total_revenue']) * 100, 1) : 0 }}% dari total
                    </small>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(168, 85, 247, 0.2); display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-qr-code" style="font-size: 1.5rem; color: #c084fc;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Daily Revenue Table -->
<div class="data-card">
    <h4><i class="bi bi-calendar3"></i> Pendapatan Harian</h4>
    
    @if($dailyRevenue->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover revenue-table">
            <thead>
                <tr>
                    <th width="15%">Tanggal</th>
                    <th width="10%" class="text-center">Jumlah Transaksi</th>
                    <th width="15%" class="text-end">Total Pendapatan</th>
                    <th width="12%" class="text-end">Cash</th>
                    <th width="12%" class="text-end">Transfer</th>
                    <th width="12%" class="text-end">QRIS</th>
                    <th width="12%" class="text-end">Rata-rata</th>
                    <th width="12%" class="text-center">Performa</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $maxRevenue = $dailyRevenue->max('total');
                @endphp
                @foreach($dailyRevenue as $date => $revenue)
                <tr>
                    <td>
                        <strong style="color: #22c55e;">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</strong>
                        <div style="font-size: 0.8rem; color: rgba(255, 255, 255, 0.6);">
                            {{ \Carbon\Carbon::parse($date)->isoFormat('dddd') }}
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-processing">
                            <i class="bi bi-receipt"></i> {{ number_format($revenue['count']) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <strong style="color: #4ade80; font-size: 1.05rem;">
                            Rp {{ number_format($revenue['total'], 0, ',', '.') }}
                        </strong>
                    </td>
                    <td class="text-end">
                        <span style="color: #22c55e;">
                            Rp {{ number_format($revenue['cash'], 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="text-end">
                        <span style="color: #60a5fa;">
                            Rp {{ number_format($revenue['transfer'], 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="text-end">
                        <span style="color: #c084fc;">
                            Rp {{ number_format($revenue['qris'], 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="text-end">
                        <span style="color: rgba(255, 255, 255, 0.8);">
                            Rp {{ number_format($revenue['count'] > 0 ? $revenue['total'] / $revenue['count'] : 0, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="text-center">
                        @php
                            $percentage = $maxRevenue > 0 ? ($revenue['total'] / $maxRevenue) * 100 : 0;
                        @endphp
                        <div style="position: relative; width: 100%; height: 8px; background: rgba(34, 197, 94, 0.2); border-radius: 4px; overflow: hidden; border: 1px solid rgba(34, 197, 94, 0.3);">
                            <div style="position: absolute; left: 0; top: 0; height: 100%; background: linear-gradient(90deg, #22c55e 0%, #4ade80 100%); width: {{ $percentage }}%; border-radius: 4px; transition: width 0.3s ease;"></div>
                        </div>
                        <small style="color: #4ade80; font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                            {{ number_format($percentage, 0) }}%
                        </small>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot style="border-top: 2px solid rgba(34, 197, 94, 0.4); background: rgba(34, 197, 94, 0.15);">
                <tr>
                    <td><strong style="color: #4ade80;">TOTAL</strong></td>
                    <td class="text-center">
                        <strong style="color: #93c5fd;">{{ number_format($summary['total_transactions']) }}</strong>
                    </td>
                    <td class="text-end">
                        <strong style="color: #4ade80; font-size: 1.1rem;">
                            Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}
                        </strong>
                    </td>
                    <td class="text-end">
                        <strong style="color: #22c55e;">
                            Rp {{ number_format($summary['by_payment_method']['cash'], 0, ',', '.') }}
                        </strong>
                    </td>
                    <td class="text-end">
                        <strong style="color: #60a5fa;">
                            Rp {{ number_format($summary['by_payment_method']['transfer'], 0, ',', '.') }}
                        </strong>
                    </td>
                    <td class="text-end">
                        <strong style="color: #c084fc;">
                            Rp {{ number_format($summary['by_payment_method']['qris'], 0, ',', '.') }}
                        </strong>
                    </td>
                    <td class="text-end">
                        <strong style="color: rgba(255, 255, 255, 0.8);">
                            Rp {{ number_format($summary['average_transaction'], 0, ',', '.') }}
                        </strong>
                    </td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <div class="text-center py-5">
        <div style="font-size: 4rem; color: rgba(34, 197, 94, 0.3); margin-bottom: 1rem;">
            <i class="bi bi-inbox"></i>
        </div>
        <h5 style="color: rgba(255, 255, 255, 0.7);">Tidak Ada Data Pendapatan</h5>
        <p style="color: rgba(255, 255, 255, 0.5);">Belum ada transaksi confirmed untuk periode yang dipilih.</p>
    </div>
    @endif
</div>

<!-- Revenue Chart Visualization -->
@if($dailyRevenue->count() > 0)
<div class="row mt-4">
    <div class="col-md-6">
        <div class="data-card">
            <h4><i class="bi bi-bar-chart-line"></i> Tren Pendapatan</h4>
            <div class="mt-3">
                @php
                    $maxDaily = $dailyRevenue->max('total');
                @endphp
                @foreach($dailyRevenue->take(10) as $date => $revenue)
                @php
                    $percentage = $maxDaily > 0 ? ($revenue['total'] / $maxDaily) * 100 : 0;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="color: #ffffff; font-size: 0.9rem;">
                            <strong>{{ \Carbon\Carbon::parse($date)->format('d M') }}</strong>
                        </span>
                        <span style="color: #4ade80; font-weight: 600; font-size: 0.9rem;">
                            Rp {{ number_format($revenue['total'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div style="position: relative; width: 100%; height: 12px; background: rgba(34, 197, 94, 0.2); border-radius: 6px; overflow: hidden; border: 1px solid rgba(34, 197, 94, 0.3);">
                        <div style="position: absolute; left: 0; top: 0; height: 100%; background: linear-gradient(90deg, #22c55e 0%, #4ade80 100%); width: {{ $percentage }}%; border-radius: 6px; transition: width 0.5s ease; box-shadow: 0 2px 8px rgba(34, 197, 94, 0.4);"></div>
                    </div>
                    <small style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-top: 0.2rem; display: block;">
                        {{ $revenue['count'] }} transaksi
                    </small>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="data-card">
            <h4><i class="bi bi-pie-chart"></i> Metode Pembayaran</h4>
            <div class="mt-3">
                @php
                    $paymentMethods = [
                        ['name' => 'Cash', 'amount' => $summary['by_payment_method']['cash'], 'color' => '#22c55e', 'icon' => 'cash'],
                        ['name' => 'Transfer', 'amount' => $summary['by_payment_method']['transfer'], 'color' => '#60a5fa', 'icon' => 'bank'],
                        ['name' => 'QRIS', 'amount' => $summary['by_payment_method']['qris'], 'color' => '#c084fc', 'icon' => 'qr-code']
                    ];
                @endphp
                @foreach($paymentMethods as $method)
                @php
                    $percentage = $summary['total_revenue'] > 0 ? ($method['amount'] / $summary['total_revenue']) * 100 : 0;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="color: #ffffff; font-size: 0.9rem;">
                            <i class="bi bi-{{ $method['icon'] }}"></i> <strong>{{ $method['name'] }}</strong>
                        </span>
                        <span style="color: {{ $method['color'] }}; font-weight: 600; font-size: 0.9rem;">
                            {{ number_format($percentage, 1) }}%
                        </span>
                    </div>
                    <div style="position: relative; width: 100%; height: 12px; background: rgba(255, 255, 255, 0.1); border-radius: 6px; overflow: hidden; border: 1px solid {{ $method['color'] }}33;">
                        <div style="position: absolute; left: 0; top: 0; height: 100%; background: {{ $method['color'] }}; width: {{ $percentage }}%; border-radius: 6px; transition: width 0.5s ease; box-shadow: 0 2px 8px {{ $method['color'] }}66;"></div>
                    </div>
                    <small style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-top: 0.2rem; display: block;">
                        Rp {{ number_format($method['amount'], 0, ',', '.') }}
                    </small>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<style>
    /* Revenue table styling */
    .revenue-table {
        background: transparent !important;
        font-size: 0.95rem;
    }

    .revenue-table thead th {
        background: rgba(34, 197, 94, 0.15) !important;
        border-color: rgba(34, 197, 94, 0.2);
        color: #16a34a;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
        font-weight: 600;
    }

    .revenue-table tbody tr {
        background: rgba(10, 31, 10, 0.3) !important;
        transition: all 0.3s ease;
        border-color: rgba(34, 197, 94, 0.1);
    }

    .revenue-table tbody tr:nth-child(even) {
        background: rgba(34, 197, 94, 0.05) !important;
    }

    .revenue-table tbody tr:hover {
        background: rgba(34, 197, 94, 0.15) !important;
        transform: translateX(3px);
    }

    .revenue-table tbody td {
        background: transparent !important;
        border-color: rgba(34, 197, 94, 0.1);
        color: rgba(255, 255, 255, 0.9);
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    .revenue-table tfoot tr {
        background: rgba(34, 197, 94, 0.15) !important;
    }

    .revenue-table tfoot td {
        background: transparent !important;
        border-color: rgba(34, 197, 94, 0.2);
        padding: 0.9rem 0.75rem;
        font-size: 0.95rem;
    }

    /* Table responsive scrollbar */
    .table-responsive {
        border-radius: 0.5rem;
        overflow-x: auto;
    }

    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: rgba(34, 197, 94, 0.05);
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: rgba(34, 197, 94, 0.3);
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: rgba(34, 197, 94, 0.5);
    }

    /* Export buttons */
    .btn-danger {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        border: none;
        color: white;
        padding: 0.625rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .btn-success {
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        border: none;
        color: white;
        padding: 0.625rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(22, 163, 74, 0.4);
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    }

    /* Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card, .data-card {
        animation: slideIn 0.5s ease-out;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }

        .revenue-table {
            font-size: 0.875rem;
        }

        .stat-card-info h3 {
            font-size: 1.75rem;
        }
    }
</style>
@endsection