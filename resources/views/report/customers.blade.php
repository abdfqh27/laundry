@extends('layouts.app')

@section('title', 'Laporan Pelanggan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-people-fill me-2"></i>Laporan Pelanggan</h1>
            <p>Data statistik dan riwayat transaksi pelanggan</p>
        </div>
        <div>
            <a href="{{ route('report.customers.excel', request()->query()) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel me-2"></i>Export Excel
            </a>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="data-card mb-4">
    <h4><i class="bi bi-funnel-fill me-2"></i>Filter Laporan</h4>
    <form method="GET" action="{{ route('report.customers') }}">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" 
                       value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="end_date" class="form-control" 
                       value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Urutkan Berdasarkan</label>
                <select name="sort_by" class="form-select">
                    <option value="total_spent" {{ request('sort_by') == 'total_spent' ? 'selected' : '' }}>
                        Total Pengeluaran
                    </option>
                    <option value="total_orders" {{ request('sort_by') == 'total_orders' ? 'selected' : '' }}>
                        Total Pesanan
                    </option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-2"></i>Terapkan Filter
                </button>
                <a href="{{ route('report.customers') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Summary Statistics -->
<div class="stat-card-grid">
    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $customers->total() }}</h3>
                <p>Total Pelanggan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
    </div>

    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ number_format($customers->sum('total_spent'), 0, ',', '.') }}</h3>
                <p>Total Pendapatan dari Pelanggan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $customers->sum('orders_count') }}</h3>
                <p>Total Pesanan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-bag-check-fill"></i>
            </div>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ $customers->count() > 0 ? number_format($customers->sum('total_spent') / $customers->count(), 0, ',', '.') : 0 }}</h3>
                <p>Rata-rata per Pelanggan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
        </div>
    </div>
</div>

<!-- Customer Table -->
<div class="data-card">
    <h4><i class="bi bi-table me-2"></i>Daftar Pelanggan</h4>
    
    @if($customers->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle custom-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 25%;">Nama Pelanggan</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">No. Telepon</th>
                        <th style="width: 12%; text-align: center;">Total Pesanan</th>
                        <th style="width: 18%; text-align: right;">Total Pengeluaran</th>
                        <th style="width: 5%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $index => $customer)
                        <tr>
                            <td>{{ $customers->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="customer-avatar me-2">
                                        <i class="bi bi-person-circle" style="font-size: 2rem; color: #22c55e;"></i>
                                    </div>
                                    <div>
                                        <strong style="color: #fff;">{{ $customer->name }}</strong>
                                        @if($customer->total_spent > 1000000)
                                            <span class="badge badge-success ms-2">
                                                <i class="bi bi-star-fill"></i> VIP
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="color: rgba(255, 255, 255, 0.8);">
                                <i class="bi bi-envelope me-1" style="color: #60a5fa;"></i>
                                {{ $customer->email }}
                            </td>
                            <td style="color: rgba(255, 255, 255, 0.8);">
                                <i class="bi bi-telephone me-1" style="color: #c084fc;"></i>
                                {{ $customer->phone ?? '-' }}
                            </td>
                            <td style="text-align: center;">
                                <span class="badge badge-processing" style="font-size: 0.9rem;">
                                    <i class="bi bi-bag-fill"></i>
                                    {{ $customer->orders_count }} pesanan
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <strong style="color: #22c55e; font-size: 1.05rem;">
                                    Rp {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}
                                </strong>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('customer.orders.index') }}?customer_id={{ $customer->id }}" 
                                   class="btn btn-sm btn-primary" 
                                   style="padding: 0.4rem 0.8rem;"
                                   title="Lihat Pesanan">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="border-top: 2px solid rgba(34, 197, 94, 0.3); background: rgba(34, 197, 94, 0.05);">
                        <td colspan="4" style="text-align: right; padding: 1rem;">
                            <strong style="color: #fff; font-size: 1.1rem;">TOTAL:</strong>
                        </td>
                        <td style="text-align: center;">
                            <strong style="color: #60a5fa; font-size: 1.05rem;">
                                {{ $customers->sum('orders_count') }} pesanan
                            </strong>
                        </td>
                        <td style="text-align: right;">
                            <strong style="color: #22c55e; font-size: 1.15rem;">
                                Rp {{ number_format($customers->sum('total_spent'), 0, ',', '.') }}
                            </strong>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    @else
        <div class="alert alert-danger">
            <i class="bi bi-info-circle-fill"></i>
            <span>Tidak ada data pelanggan untuk periode yang dipilih.</span>
        </div>
    @endif
</div>

<!-- Top Customers Section -->
@if($customers->count() > 0)
<div class="data-card mt-4">
    <h4><i class="bi bi-trophy-fill me-2" style="color: #fbbf24;"></i>Top 5 Pelanggan Terbaik</h4>
    <div class="row g-3">
        @foreach($customers->take(5) as $index => $topCustomer)
            <div class="col-md-6">
                <div class="top-customer-card" style="
                    background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(22, 163, 74, 0.05) 100%);
                    border: 1px solid rgba(34, 197, 94, 0.3);
                    border-radius: 0.75rem;
                    padding: 1.25rem;
                    transition: all 0.3s ease;
                ">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="rank-badge me-3" style="
                                width: 50px;
                                height: 50px;
                                border-radius: 50%;
                                background: {{ $index == 0 ? 'linear-gradient(135deg, #fbbf24, #f59e0b)' : ($index == 1 ? 'linear-gradient(135deg, #94a3b8, #64748b)' : ($index == 2 ? 'linear-gradient(135deg, #fb923c, #f97316)' : 'linear-gradient(135deg, #22c55e, #16a34a)')) }};
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 1.5rem;
                                font-weight: 700;
                                color: white;
                                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
                            ">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h5 style="margin: 0; color: #fff; font-size: 1.1rem;">
                                    {{ $topCustomer->name }}
                                </h5>
                                <p style="margin: 0; color: rgba(255, 255, 255, 0.6); font-size: 0.85rem;">
                                    {{ $topCustomer->email }}
                                </p>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div style="color: #22c55e; font-size: 1.2rem; font-weight: 700;">
                                Rp {{ number_format($topCustomer->total_spent ?? 0, 0, ',', '.') }}
                            </div>
                            <div style="color: rgba(255, 255, 255, 0.6); font-size: 0.85rem;">
                                {{ $topCustomer->orders_count }} pesanan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

<style>
    /* Custom Table Styling - NO WHITE BACKGROUND */
    .custom-table {
        background: transparent !important;
    }
    
    .custom-table thead {
        background: rgba(22, 163, 74, 0.2) !important;
    }
    
    .custom-table thead th {
        background: transparent !important;
        border-color: rgba(34, 197, 94, 0.3) !important;
    }
    
    .custom-table tbody {
        background: transparent !important;
    }
    
    .custom-table tbody tr {
        background: rgba(10, 31, 10, 0.4) !important;
        transition: all 0.2s ease;
        border-color: rgba(34, 197, 94, 0.15) !important;
    }

    .custom-table tbody tr:hover {
        background: rgba(34, 197, 94, 0.15) !important;
        transform: scale(1.01);
    }
    
    .custom-table tbody td {
        background: transparent !important;
        border-color: rgba(34, 197, 94, 0.15) !important;
    }
    
    .custom-table tfoot {
        background: rgba(34, 197, 94, 0.1) !important;
    }
    
    .custom-table tfoot tr {
        background: rgba(34, 197, 94, 0.1) !important;
        border-color: rgba(34, 197, 94, 0.3) !important;
    }
    
    .custom-table tfoot td {
        background: transparent !important;
    }

    .top-customer-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.2);
        border-color: rgba(34, 197, 94, 0.5);
    }

    .customer-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Custom Scrollbar untuk Table */
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

    /* Pagination Styling */
    .pagination {
        margin: 0;
    }

    .page-item .page-link {
        background: rgba(10, 31, 10, 0.5);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #16a34a;
        margin: 0 2px;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .page-item .page-link:hover {
        background: rgba(34, 197, 94, 0.2);
        border-color: #16a34a;
        color: #22c55e;
        transform: translateY(-2px);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        border-color: #16a34a;
        color: white;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .page-item.disabled .page-link {
        background: rgba(10, 31, 10, 0.3);
        border-color: rgba(34, 197, 94, 0.1);
        color: rgba(255, 255, 255, 0.3);
    }



    /* Button Small */
    .btn-sm {
        transition: all 0.3s ease;
    }

    .btn-sm:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
    }
</style>
@endsection