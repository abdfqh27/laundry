@extends('layouts.app')

@section('title', 'Order Saya')

@section('content')
<div class="page-header">
    <h1>Order Saya</h1>
    <a href="{{ route('customer.orders.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Pesan Laundry
    </a>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    @php
        // Hitung statistik real-time dari data order
        $pendingCount = $orders->where('status', 'pending')->count();
        $processingCount = $orders->where('status', 'processing')->count();
        $completedCount = $orders->where('status', 'completed')->count();
    @endphp

    <!-- Pending Orders -->
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, rgba(251, 191, 36, 0.1) 0%, rgba(251, 191, 36, 0.05) 100%); border-left: 4px solid #fbbf24;">
            <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2); color: #fbbf24;">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value" style="color: #fbbf24;">{{ $pendingCount }}</h3>
                <p class="stat-label">Pending</p>
            </div>
        </div>
    </div>

    <!-- Processing Orders -->
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%); border-left: 4px solid #3b82f6;">
            <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2); color: #3b82f6;">
                <i class="bi bi-gear"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value" style="color: #3b82f6;">{{ $processingCount }}</h3>
                <p class="stat-label">Diproses</p>
            </div>
        </div>
    </div>

    <!-- Completed Orders -->
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%); border-left: 4px solid #22c55e;">
            <div class="stat-icon" style="background: rgba(34, 197, 94, 0.2); color: #22c55e;">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value" style="color: #22c55e;">{{ $completedCount }}</h3>
                <p class="stat-label">Selesai</p>
            </div>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div class="data-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>
            <i class="bi bi-list-ul me-2"></i>Daftar Order
        </h4>
        <div class="d-flex gap-2">
            <!-- Filter Status -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm {{ request('status') == '' ? 'btn-primary' : 'btn-outline-secondary' }}" 
                        onclick="window.location.href='{{ route('customer.orders.index') }}'">
                    Semua
                </button>
                <button type="button" class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-secondary' }}" 
                        onclick="window.location.href='{{ route('customer.orders.index', ['status' => 'pending']) }}'">
                    Pending
                </button>
                <button type="button" class="btn btn-sm {{ request('status') == 'processing' ? 'btn-info' : 'btn-outline-secondary' }}" 
                        onclick="window.location.href='{{ route('customer.orders.index', ['status' => 'processing']) }}'">
                    Diproses
                </button>
                <button type="button" class="btn btn-sm {{ request('status') == 'completed' ? 'btn-success' : 'btn-outline-secondary' }}" 
                        onclick="window.location.href='{{ route('customer.orders.index', ['status' => 'completed']) }}'">
                    Selesai
                </button>
            </div>
        </div>
    </div>

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>NO. ORDER</th>
                        <th>TANGGAL</th>
                        <th>LAYANAN</th>
                        <th class="text-end">TOTAL</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">PEMBAYARAN</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <!-- Order Number -->
                            <td>
                                <strong class="text-primary">#{{ $order->order_number }}</strong>
                            </td>

                            <!-- Date -->
                            <td>
                                {{ $order->created_at->format('d M Y') }}
                                <br>
                                <small class="text-light">{{ $order->created_at->format('H:i') }}</small>
                            </td>

                            <!-- Services -->
                            <td>
                                @php
                                    $itemCount = $order->items->count();
                                    $firstItem = $order->items->first();
                                @endphp
                                @if($firstItem)
                                    <strong>{{ $firstItem->service->name }}</strong>
                                    @if($itemCount > 1)
                                        <br>
                                        <small class="text-light">+{{ $itemCount - 1 }} layanan lainnya</small>
                                    @endif
                                @endif
                            </td>

                            <!-- Total -->
                            <td class="text-end">
                                <strong style="color: #6366f1;">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </strong>
                            </td>

                            <!-- Status Order -->
                            <td class="text-center">
                                @php
                                    $statusConfig = [
                                        'pending' => [
                                            'color' => '#fbbf24',
                                            'bg' => 'rgba(251, 191, 36, 0.15)',
                                            'border' => 'rgba(251, 191, 36, 0.3)',
                                            'icon' => 'clock-history',
                                            'label' => 'Pending'
                                        ],
                                        'processing' => [
                                            'color' => '#3b82f6',
                                            'bg' => 'rgba(59, 130, 246, 0.15)',
                                            'border' => 'rgba(59, 130, 246, 0.3)',
                                            'icon' => 'gear',
                                            'label' => 'Diproses'
                                        ],
                                        'completed' => [
                                            'color' => '#22c55e',
                                            'bg' => 'rgba(34, 197, 94, 0.15)',
                                            'border' => 'rgba(34, 197, 94, 0.3)',
                                            'icon' => 'check-circle',
                                            'label' => 'Selesai'
                                        ],
                                        'cancelled' => [
                                            'color' => '#ef4444',
                                            'bg' => 'rgba(239, 68, 68, 0.15)',
                                            'border' => 'rgba(239, 68, 68, 0.3)',
                                            'icon' => 'x-circle',
                                            'label' => 'Dibatalkan'
                                        ]
                                    ];

                                    $config = $statusConfig[$order->status] ?? $statusConfig['pending'];
                                @endphp

                                <span class="status-badge" style="
                                    background: {{ $config['bg'] }};
                                    color: {{ $config['color'] }};
                                    border: 1px solid {{ $config['border'] }};
                                    padding: 0.4rem 0.8rem;
                                    border-radius: 0.5rem;
                                    font-size: 0.85rem;
                                    font-weight: 600;
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 0.4rem;
                                ">
                                    <i class="bi bi-{{ $config['icon'] }}"></i>
                                    {{ $config['label'] }}
                                </span>
                            </td>

                            <!-- Payment Status -->
                            <td class="text-center">
                                @php
                                    $paymentConfig = [
                                        'unpaid' => [
                                            'color' => '#ef4444',
                                            'bg' => 'rgba(239, 68, 68, 0.15)',
                                            'border' => 'rgba(239, 68, 68, 0.3)',
                                            'icon' => 'x-circle',
                                            'label' => 'Belum Bayar'
                                        ],
                                        'paid' => [
                                            'color' => '#22c55e',
                                            'bg' => 'rgba(34, 197, 94, 0.15)',
                                            'border' => 'rgba(34, 197, 94, 0.3)',
                                            'icon' => 'check-circle',
                                            'label' => 'Terbayar'
                                        ],
                                        'partial' => [
                                            'color' => '#f59e0b',
                                            'bg' => 'rgba(245, 158, 11, 0.15)',
                                            'border' => 'rgba(245, 158, 11, 0.3)',
                                            'icon' => 'exclamation-circle',
                                            'label' => 'Sebagian'
                                        ]
                                    ];

                                    $paymentConf = $paymentConfig[$order->payment_status] ?? $paymentConfig['unpaid'];
                                @endphp

                                <span class="payment-badge" style="
                                    background: {{ $paymentConf['bg'] }};
                                    color: {{ $paymentConf['color'] }};
                                    border: 1px solid {{ $paymentConf['border'] }};
                                    padding: 0.4rem 0.8rem;
                                    border-radius: 0.5rem;
                                    font-size: 0.85rem;
                                    font-weight: 600;
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 0.4rem;
                                ">
                                    <i class="bi bi-{{ $paymentConf['icon'] }}"></i>
                                    {{ $paymentConf['label'] }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <a href="{{ route('customer.orders.show', $order->id) }}" 
                                   class="btn btn-sm btn-outline-primary"
                                   title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 4rem; color: rgba(255,255,255,0.2);"></i>
            <h4 class="mt-3 text-light">Belum Ada Order</h4>
            <p class="text-muted mb-4">Anda belum memiliki order {{ request('status') ? 'dengan status ' . request('status') : '' }}</p>
            <a href="{{ route('customer.orders.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Buat Order Pertama
            </a>
        </div>
    @endif
</div>

<style>
    /* Stat Cards */
    .stat-card {
        padding: 1.5rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        line-height: 1;
    }

    .stat-label {
        margin: 0.5rem 0 0 0;
        font-size: 1rem;
        color: rgba(255,255,255,0.7);
        font-weight: 500;
    }

    /* Table Styling */
    .table-dark {
        --bs-table-bg: rgba(99,102,241,0.02);
        --bs-table-hover-bg: rgba(99,102,241,0.05);
    }

    .table-dark thead {
        background-color: rgba(99,102,241,0.1);
        border-bottom: 2px solid rgba(99,102,241,0.2);
    }

    .table-dark thead th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem;
        color: rgba(255,255,255,0.9);
    }

    .table-dark tbody td {
        padding: 1rem;
        vertical-align: middle;
    }

    .table-dark tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .table-dark tbody tr:hover {
        background-color: rgba(99,102,241,0.08) !important;
    }

    /* Badge Animations */
    .status-badge, .payment-badge {
        transition: all 0.2s ease;
    }

    .status-badge:hover, .payment-badge:hover {
        transform: scale(1.05);
    }

    /* Filter Buttons */
    .btn-group .btn {
        transition: all 0.2s ease;
    }

    .btn-group .btn:hover {
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-card {
            flex-direction: column;
            text-align: center;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .table-responsive {
            font-size: 0.85rem;
        }

        .status-badge, .payment-badge {
            font-size: 0.75rem;
            padding: 0.3rem 0.6rem;
        }

        .btn-group {
            flex-wrap: wrap;
        }
    }
</style>
@endsection