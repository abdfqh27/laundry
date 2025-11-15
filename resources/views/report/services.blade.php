@extends('layouts.app')

@section('title', 'Laporan Layanan Terpopuler')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-stars me-2"></i>Laporan Layanan Terpopuler</h1>
            <p>Analisis performa dan popularitas layanan laundry</p>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="data-card mb-4">
    <h4><i class="bi bi-funnel"></i> Filter Laporan</h4>
    
    <form method="GET" action="{{ route('report.services') }}" class="row g-3">
        <div class="col-md-5">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" 
                   value="{{ request('start_date') }}" max="{{ date('Y-m-d') }}">
        </div>

        <div class="col-md-5">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date" name="end_date" class="form-control" 
                   value="{{ request('end_date') }}" max="{{ date('Y-m-d') }}">
        </div>

        <div class="col-md-2 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search"></i> Filter
            </button>
        </div>

        @if(request()->hasAny(['start_date', 'end_date']))
        <div class="col-12">
            <a href="{{ route('report.services') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-x-circle"></i> Reset Filter
            </a>
        </div>
        @endif
    </form>
</div>

<!-- Summary Statistics -->
@if($services->count() > 0)
<div class="stat-card-grid">
    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ number_format($services->count()) }}</h3>
                <p>Total Layanan Aktif</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-list-check"></i>
            </div>
        </div>
    </div>

    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ number_format($services->sum('order_count')) }}</h3>
                <p>Total Pesanan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-cart-check"></i>
            </div>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ number_format($services->sum('total_quantity')) }}</h3>
                <p>Total Quantity</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-box-seam"></i>
            </div>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ number_format($services->sum('total_revenue'), 0, ',', '.') }}</h3>
                <p>Total Pendapatan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Top Services -->
@if($services->count() > 0)
<div class="data-card">
    <div class="mb-3">
        <h4><i class="bi bi-trophy"></i> Ranking Layanan</h4>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle services-table">
            <thead>
                <tr>
                    <th width="8%" class="text-center">Rank</th>
                    <th width="35%">Layanan</th>
                    <th width="12%" class="text-center">Total Order</th>
                    <th width="12%" class="text-center">Total Quantity</th>
                    <th width="15%" class="text-end">Pendapatan</th>
                    <th width="10%" class="text-center">Avg/Order</th>
                    <th width="8%" class="text-center">Popularitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $index => $item)
                <tr>
                    <td class="text-center">
                        @if($index < 3)
                            <div class="position-relative d-inline-block">
                                @if($index == 0)
                                    <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); color: #fff; font-size: 0.95rem; padding: 0.4rem 0.7rem;">
                                        <i class="bi bi-trophy-fill"></i> #1
                                    </span>
                                @elseif($index == 1)
                                    <span class="badge" style="background: linear-gradient(135deg, #C0C0C0 0%, #A8A8A8 100%); color: #fff; font-size: 0.9rem; padding: 0.38rem 0.65rem;">
                                        <i class="bi bi-trophy-fill"></i> #2
                                    </span>
                                @else
                                    <span class="badge" style="background: linear-gradient(135deg, #CD7F32 0%, #B8731D 100%); color: #fff; font-size: 0.85rem; padding: 0.35rem 0.6rem;">
                                        <i class="bi bi-trophy-fill"></i> #3
                                    </span>
                                @endif
                            </div>
                        @else
                            <span class="badge" style="background: rgba(34, 197, 94, 0.15); color: rgba(255,255,255,0.7); font-size: 0.85rem; padding: 0.35rem 0.6rem;">
                                #{{ $index + 1 }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="service-icon me-3" style="width: 40px; height: 40px; border-radius: 8px; background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(22, 163, 74, 0.1) 100%); display: flex; align-items: center; justify-content: center; border: 2px solid rgba(34, 197, 94, 0.3);">
                                <i class="bi bi-droplet-half" style="font-size: 1.2rem; color: #16a34a;"></i>
                            </div>
                            <div>
                                <strong style="color: #22c55e; font-size: 0.95rem;">{{ $item->service->name ?? 'N/A' }}</strong>
                                @if($item->service)
                                <div style="font-size: 0.8rem; color: #4ade80; margin-top: 0.1rem;">
                                    <i class="bi bi-tag"></i> Rp {{ number_format($item->service->price, 0, ',', '.') }} / {{ $item->service->unit }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div style="background: rgba(59, 130, 246, 0.2); border: 1px solid rgba(59, 130, 246, 0.4); border-radius: 6px; padding: 0.4rem 0.6rem; display: inline-block;">
                            <strong style="color: #93c5fd; font-size: 1rem;">{{ number_format($item->order_count) }}</strong>
                            <div style="font-size: 0.7rem; color: rgba(147, 197, 253, 0.8); margin-top: 0.05rem;">orders</div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div style="background: rgba(168, 85, 247, 0.2); border: 1px solid rgba(168, 85, 247, 0.4); border-radius: 6px; padding: 0.4rem 0.6rem; display: inline-block;">
                            <strong style="color: #d8b4fe; font-size: 1rem;">{{ number_format($item->total_quantity) }}</strong>
                            <div style="font-size: 0.7rem; color: rgba(216, 180, 254, 0.8); margin-top: 0.05rem;">items</div>
                        </div>
                    </td>
                    <td class="text-end">
                        <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); border-radius: 6px; padding: 0.5rem 0.7rem; display: inline-block;">
                            <strong style="color: #4ade80; font-size: 1.05rem;">
                                Rp {{ number_format($item->total_revenue, 0, ',', '.') }}
                            </strong>
                        </div>
                    </td>
                    <td class="text-center">
                        <span style="color: #4ade80; font-size: 0.9rem; font-weight: 500;">
                            Rp {{ number_format($item->total_revenue / $item->order_count, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="text-center">
                        @php
                            $maxRevenue = $services->max('total_revenue');
                            $percentage = $maxRevenue > 0 ? ($item->total_revenue / $maxRevenue) * 100 : 0;
                        @endphp
                        <div style="position: relative; width: 100%; height: 8px; background: rgba(34, 197, 94, 0.2); border-radius: 4px; overflow: hidden; border: 1px solid rgba(34, 197, 94, 0.3);">
                            <div style="position: absolute; left: 0; top: 0; height: 100%; background: linear-gradient(90deg, #22c55e 0%, #4ade80 100%); width: {{ $percentage }}%; border-radius: 4px; transition: width 0.3s ease; box-shadow: 0 0 8px rgba(34, 197, 94, 0.4);"></div>
                        </div>
                        <small style="color: #4ade80; font-size: 0.75rem; margin-top: 0.25rem; display: block; font-weight: 600;">
                            {{ number_format($percentage, 1) }}%
                        </small>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot style="border-top: 2px solid rgba(34, 197, 94, 0.4); background: rgba(34, 197, 94, 0.15);">
                <tr>
                    <td colspan="2" class="text-end" style="font-weight: 600; color: #4ade80; padding: 0.9rem 0.75rem; font-size: 0.95rem;">
                        <i class="bi bi-calculator"></i> TOTAL KESELURUHAN:
                    </td>
                    <td class="text-center" style="font-weight: 700; color: #93c5fd; padding: 0.9rem 0.75rem; font-size: 0.95rem;">
                        {{ number_format($services->sum('order_count')) }}
                    </td>
                    <td class="text-center" style="font-weight: 700; color: #d8b4fe; padding: 0.9rem 0.75rem; font-size: 0.95rem;">
                        {{ number_format($services->sum('total_quantity')) }}
                    </td>
                    <td class="text-end" style="font-weight: 700; color: #4ade80; font-size: 1.1rem; padding: 0.9rem 0.75rem;">
                        Rp {{ number_format($services->sum('total_revenue'), 0, ',', '.') }}
                    </td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Revenue Distribution Chart -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="data-card">
            <h4><i class="bi bi-pie-chart"></i> Distribusi Pendapatan</h4>
            <div class="mt-3">
                @foreach($services->take(5) as $index => $item)
                @php
                    $totalRevenue = $services->sum('total_revenue');
                    $percentage = $totalRevenue > 0 ? ($item->total_revenue / $totalRevenue) * 100 : 0;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="color: #ffffff; font-size: 0.95rem; font-weight: 500;">
                            <strong>{{ $item->service->name ?? 'N/A' }}</strong>
                        </span>
                        <span style="color: #4ade80; font-weight: 700; font-size: 0.95rem;">
                            {{ number_format($percentage, 1) }}%
                        </span>
                    </div>
                    <div style="position: relative; width: 100%; height: 14px; background: rgba(34, 197, 94, 0.2); border-radius: 7px; overflow: hidden; border: 1px solid rgba(34, 197, 94, 0.3);">
                        <div style="position: absolute; left: 0; top: 0; height: 100%; background: linear-gradient(90deg, #22c55e 0%, #4ade80 100%); width: {{ $percentage }}%; border-radius: 7px; transition: width 0.5s ease; box-shadow: 0 2px 8px rgba(34, 197, 94, 0.4);"></div>
                    </div>
                    <small style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-top: 0.3rem; display: block;">
                        Rp {{ number_format($item->total_revenue, 0, ',', '.') }}
                    </small>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="data-card">
            <h4><i class="bi bi-bar-chart"></i> Performa Order</h4>
            <div class="mt-3">
                @foreach($services->take(5) as $index => $item)
                @php
                    $maxOrders = $services->max('order_count');
                    $percentage = $maxOrders > 0 ? ($item->order_count / $maxOrders) * 100 : 0;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="color: #ffffff; font-size: 0.95rem; font-weight: 500;">
                            <strong>{{ $item->service->name ?? 'N/A' }}</strong>
                        </span>
                        <span style="color: #93c5fd; font-weight: 700; font-size: 0.95rem;">
                            {{ number_format($item->order_count) }} orders
                        </span>
                    </div>
                    <div style="position: relative; width: 100%; height: 14px; background: rgba(59, 130, 246, 0.2); border-radius: 7px; overflow: hidden; border: 1px solid rgba(59, 130, 246, 0.3);">
                        <div style="position: absolute; left: 0; top: 0; height: 100%; background: linear-gradient(90deg, #3b82f6 0%, #60a5fa 100%); width: {{ $percentage }}%; border-radius: 7px; transition: width 0.5s ease; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4);"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@else
<div class="data-card text-center py-5">
    <div style="font-size: 4rem; color: rgba(34, 197, 94, 0.3); margin-bottom: 1rem;">
        <i class="bi bi-inbox"></i>
    </div>
    <h4 style="color: rgba(255,255,255,0.7); margin-bottom: 0.5rem;">Tidak Ada Data Layanan</h4>
    <p style="color: rgba(255,255,255,0.5); margin-bottom: 1.5rem;">
        Belum ada data layanan yang tersedia untuk periode yang dipilih.
    </p>
    @if(request()->hasAny(['start_date', 'end_date']))
    <a href="{{ route('report.services') }}" class="btn btn-primary">
        <i class="bi bi-arrow-clockwise"></i> Reset Filter
    </a>
    @endif
</div>
@endif

<style>
    /* Additional animations */
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

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    /* Services table styling - FIXED NO WHITE BACKGROUND */
    .services-table {
        background: transparent !important;
        font-size: 0.95rem;
    }

    .services-table thead th {
        background: rgba(34, 197, 94, 0.15) !important;
        border-color: rgba(34, 197, 94, 0.2);
        color: #16a34a;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
        font-weight: 600;
    }

    .services-table tbody tr {
        background: rgba(10, 31, 10, 0.3) !important;
        transition: all 0.3s ease;
        border-color: rgba(34, 197, 94, 0.1);
    }

    .services-table tbody tr:nth-child(even) {
        background: rgba(34, 197, 94, 0.05) !important;
    }

    .services-table tbody tr:hover {
        background: rgba(34, 197, 94, 0.15) !important;
        transform: translateX(5px);
    }

    .services-table tbody td {
        background: transparent !important;
        border-color: rgba(34, 197, 94, 0.1);
        color: rgba(255, 255, 255, 0.9);
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    .services-table tfoot tr {
        background: rgba(34, 197, 94, 0.15) !important;
        border-top: 2px solid rgba(34, 197, 94, 0.4);
    }

    .services-table tfoot td {
        background: transparent !important;
        border-color: rgba(34, 197, 94, 0.2);
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

    /* Trophy animation */
    @keyframes trophy-shine {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .bi-trophy-fill {
        animation: trophy-shine 2s ease-in-out infinite;
    }

    /* Service icon hover */
    .service-icon {
        transition: all 0.3s ease;
    }

    tr:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4);
    }

    /* Progress bar animation */
    @keyframes progress-load {
        from { width: 0%; }
    }

    [style*="width:"] {
        animation: progress-load 1s ease-out;
    }

    /* Button hover effects */
    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-danger {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        border: none;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    .btn-danger:hover {
        box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4);
    }

    .btn-success {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border: none;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }

    .btn-success:hover {
        box-shadow: 0 6px 16px rgba(5, 150, 105, 0.4);
    }
</style>
@endsection