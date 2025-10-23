@extends('layouts.app')

@section('title', 'Order Saya')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order Saya</h1>
        <a href="{{ route('customer.orders.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i>Pesan Laundry
        </a>
    </div>
</div>

@if($orders->count() > 0)
    <div class="stat-card-grid mb-4">
        <div class="stat-card blue">
            <div class="stat-card-content">
                <div class="stat-card-info">
                    <h3>{{ $orders->where('status', 'pending')->count() }}</h3>
                    <p>Pending</p>
                </div>
                <div class="stat-card-icon">
                    <i class="bi bi-clock"></i>
                </div>
            </div>
        </div>
        <div class="stat-card orange">
            <div class="stat-card-content">
                <div class="stat-card-info">
                    <h3>{{ $orders->where('status', 'diproses')->count() }}</h3>
                    <p>Diproses</p>
                </div>
                <div class="stat-card-icon">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
        </div>
        <div class="stat-card green">
            <div class="stat-card-content">
                <div class="stat-card-info">
                    <h3>{{ $orders->where('status', 'selesai')->count() }}</h3>
                    <p>Selesai</p>
                </div>
                <div class="stat-card-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="data-card">
    <h4 class="mb-4">
        <i class="bi bi-list-ul me-2"></i>Daftar Order
    </h4>

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead class="table-dark">
                    <tr>
                        <th style="border-top-left-radius: 0.5rem;">No. Order</th>
                        <th>Tanggal</th>
                        <th>Layanan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th style="border-top-right-radius: 0.5rem;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="align-middle" style="border-color: rgba(255,255,255,0.1);">
                        <td>
                            <span class="fw-bold text-info">#{{ $order->order_number }}</span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <small class="text-muted">
                                {{ $order->items->count() }} layanan
                            </small>
                        </td>
                        <td>
                            <span class="fw-bold text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            @if($order->status === 'pending')
                                <span class="badge badge-warning">
                                    <i class="bi bi-clock-fill me-1"></i>Pending
                                </span>
                            @elseif($order->status === 'diproses')
                                <span class="badge badge-processing">
                                    <i class="bi bi-arrow-repeat me-1"></i>Diproses
                                </span>
                            @elseif($order->status === 'selesai')
                                <span class="badge badge-success">
                                    <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                </span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td>
                            @if($order->payment_status === 'unpaid')
                                <span class="badge badge-danger">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>Belum Bayar
                                </span>
                            @elseif($order->payment_status === 'pending')
                                <span class="badge badge-warning">
                                    <i class="bi bi-hourglass-split me-1"></i>Pending
                                </span>
                            @else
                                <span class="badge badge-success">
                                    <i class="bi bi-check-circle-fill me-1"></i>Terbayar
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('customer.orders.show', $order->id) }}" 
                               class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 2rem; color: #6366f1; opacity: 0.5;"></i>
                            <p class="text-muted mt-3 mb-0">Tidak ada order</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 3rem; color: #6366f1; opacity: 0.3;"></i>
            <p class="text-muted mt-4 mb-0">Belum ada order. Mulai pesan laundry sekarang!</p>
            <a href="{{ route('customer.orders.create') }}" class="btn btn-primary mt-4">
                <i class="bi bi-plus-circle me-2"></i>Buat Order Baru
            </a>
        </div>
    @endif
</div>

<style>
    .table {
        background-color: transparent;
        color: #fff;
    }

    .table thead {
        background-color: rgba(99, 102, 241, 0.1) !important;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 2px solid rgba(99, 102, 241, 0.2);
    }

    .table thead th {
        border: none;
        color: #a0aec0;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .table tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.08) !important;
        border-color: rgba(99, 102, 241, 0.2);
    }

    .btn-outline-info {
        color: #60a5fa;
        border-color: rgba(96, 165, 250, 0.3);
    }

    .btn-outline-info:hover {
        background-color: rgba(59, 130, 246, 0.2);
        border-color: #60a5fa;
        color: #93c5fd;
    }

    .btn-primary {
        background-color: #6366f1;
        border-color: #6366f1;
    }

    .btn-primary:hover {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }

    .pagination {
        gap: 0.5rem;
    }

    .page-link {
        background-color: rgba(99, 102, 241, 0.1);
        border-color: rgba(99, 102, 241, 0.2);
        color: #6366f1;
    }

    .page-link:hover {
        background-color: rgba(99, 102, 241, 0.2);
        border-color: #6366f1;
        color: #818cf8;
    }

    .page-link.active {
        background-color: #6366f1;
        border-color: #6366f1;
    }
</style>
@endsection