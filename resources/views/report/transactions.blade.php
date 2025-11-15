@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-receipt-cutoff me-2"></i>Laporan Transaksi</h1>
            <p>Monitoring dan analisis transaksi pembayaran</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('report.transactions.pdf', request()->query()) }}" class="btn btn-danger">
                <i class="bi bi-file-pdf me-2"></i>Export PDF
            </a>
            <a href="{{ route('report.transactions.excel', request()->query()) }}" class="btn btn-success">
                <i class="bi bi-file-excel me-2"></i>Export Excel
            </a>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="data-card mb-4">
    <h4><i class="bi bi-funnel"></i> Filter Data</h4>
    <form action="{{ route('report.transactions') }}" method="GET">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="payment_method" class="form-select">
                    <option value="">Semua Metode</option>
                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="transfer" {{ request('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="qris" {{ request('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
                </select>
            </div>
        </div>
        <div class="mt-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search me-2"></i>Filter
            </button>
            <a href="{{ route('report.transactions') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-clockwise me-2"></i>Reset
            </a>
        </div>
    </form>
</div>

<!-- Summary Statistics -->
<div class="stat-card-grid">
    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $summary['total_count'] }}</h3>
                <p>Total Transaksi</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-receipt"></i>
            </div>
        </div>
    </div>

    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ number_format($summary['total_amount'], 0, ',', '.') }}</h3>
                <p>Total Pendapatan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $summary['pending_count'] }}</h3>
                <p>Pending</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $summary['confirmed_count'] }}</h3>
                <p>Confirmed</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-check-circle"></i>
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
                    <p class="mb-1" style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem;">Cash</p>
                    <h4 class="mb-0" style="color: #22c55e;">Rp {{ number_format($summary['cash_amount'], 0, ',', '.') }}</h4>
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
                    <p class="mb-1" style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem;">Transfer</p>
                    <h4 class="mb-0" style="color: #60a5fa;">Rp {{ number_format($summary['transfer_amount'], 0, ',', '.') }}</h4>
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
                    <p class="mb-1" style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem;">QRIS</p>
                    <h4 class="mb-0" style="color: #c084fc;">Rp {{ number_format($summary['qris_amount'], 0, ',', '.') }}</h4>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(168, 85, 247, 0.2); display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-qr-code" style="font-size: 1.5rem; color: #c084fc;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="data-card">
    <h4><i class="bi bi-table"></i> Data Transaksi</h4>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Dikonfirmasi Oleh</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td><span class="badge badge-success">#TRX-{{ $transaction->id }}</span></td>
                    <td>
                        <a href="{{ route('transaction.show', $transaction->id) }}" 
                           style="color: #22c55e; text-decoration: none;">
                            #ORD-{{ $transaction->order_id }}
                        </a>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(34, 197, 94, 0.2); display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                <i class="bi bi-person" style="color: #22c55e;"></i>
                            </div>
                            <span>{{ $transaction->order->customer->name ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td>
                        <strong style="color: #22c55e;">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</strong>
                    </td>
                    <td>
                        @if($transaction->payment_method == 'cash')
                            <span class="badge badge-success">
                                <i class="bi bi-cash"></i> Cash
                            </span>
                        @elseif($transaction->payment_method == 'transfer')
                            <span class="badge badge-processing">
                                <i class="bi bi-bank"></i> Transfer
                            </span>
                        @else
                            <span class="badge" style="background-color: rgba(168, 85, 247, 0.2); color: #c084fc; border: 1px solid rgba(168, 85, 247, 0.3);">
                                <i class="bi bi-qr-code"></i> QRIS
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($transaction->status == 'pending')
                            <span class="badge badge-warning">
                                <i class="bi bi-hourglass-split"></i> Pending
                            </span>
                        @elseif($transaction->status == 'confirmed')
                            <span class="badge badge-success">
                                <i class="bi bi-check-circle"></i> Confirmed
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="bi bi-x-circle"></i> Rejected
                            </span>
                        @endif
                    </td>
                    <td>
                        <small style="color: rgba(255, 255, 255, 0.7);">
                            {{ $transaction->created_at->format('d M Y, H:i') }}
                        </small>
                    </td>
                    <td>
                        @if($transaction->confirmed_by)
                            <small style="color: rgba(255, 255, 255, 0.7);">
                                {{ $transaction->confirmedBy->name }}
                            </small>
                        @else
                            <span style="color: rgba(255, 255, 255, 0.4);">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 3rem; color: rgba(255, 255, 255, 0.5);">
                        <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p class="mb-0">Tidak ada data transaksi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($transactions->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div style="color: rgba(255, 255, 255, 0.7);">
            Menampilkan {{ $transactions->firstItem() }} - {{ $transactions->lastItem() }} dari {{ $transactions->total() }} transaksi
        </div>
        <div>
            {{ $transactions->links() }}
        </div>
    </div>
    @endif
</div>

<style>
    /* Additional specific styles for transactions page */
    .table {
        margin-bottom: 0;
        background: transparent;
    }

    .table thead th {
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
        white-space: nowrap;
        background: rgba(34, 197, 94, 0.15) !important;
        border-color: rgba(34, 197, 94, 0.2);
    }

    .table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border-color: rgba(34, 197, 94, 0.1);
        background: transparent;
    }

    .table tbody tr {
        background: rgba(10, 31, 10, 0.3);
    }

    .table tbody tr:nth-child(even) {
        background: rgba(34, 197, 94, 0.05);
    }

    .table tbody tr:hover {
        background: rgba(34, 197, 94, 0.15) !important;
    }

    .table-responsive {
        border-radius: 0.5rem;
        overflow-x: auto;
    }

    /* Custom scrollbar for table */
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-header .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }

        .table {
            font-size: 0.875rem;
        }

        .stat-card-info h3 {
            font-size: 1.75rem;
        }
    }
</style>
@endsection