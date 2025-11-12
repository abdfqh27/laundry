@extends('layouts.app')

@section('title', 'Detail Order #' . $order->order_number)

@section('content')
<div class="page-header">
    <a href="{{ route('customer.orders.index') }}" class="text-decoration-none text-light">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Order
    </a>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <h1>Detail Order</h1>
        @if($order->status === 'pending')
            <form action="{{ route('customer.orders.destroy', $order->id) }}" method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan order ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-x-circle me-2"></i>Batalkan Order
                </button>
            </form>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4">
    <!-- LEFT COLUMN - ORDER INFO -->
    <div class="col-lg-8">
        <!-- Order Status Card -->
        <div class="data-card mb-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="mb-2">
                        <i class="bi bi-receipt me-2"></i>{{ $order->order_number }}
                    </h4>
                    <p class="text-light mb-0">
                        <i class="bi bi-calendar me-2"></i>
                        Dibuat: {{ $order->created_at->format('d M Y, H:i') }}
                    </p>
                </div>
                <div class="text-end">
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'processing' => 'info',
                            'completed' => 'success',
                            'cancelled' => 'danger',
                            'ready' => 'primary'
                        ];
                        $statusLabels = [
                            'pending' => 'Menunggu Konfirmasi',
                            'processing' => 'Sedang Diproses',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                            'ready' => 'Siap Diambil'
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }} fs-6 mb-2">
                        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                    </span>
                    <br>
                    @php
                        $paymentColors = [
                            'unpaid' => 'danger',
                            'paid' => 'success',
                            'partial' => 'warning'
                        ];
                        $paymentLabels = [
                            'unpaid' => 'Belum Dibayar',
                            'paid' => 'Lunas',
                            'partial' => 'Dibayar Sebagian'
                        ];
                    @endphp
                    <span class="badge bg-{{ $paymentColors[$order->payment_status] ?? 'secondary' }} fs-6">
                        {{ $paymentLabels[$order->payment_status] ?? ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

            <!-- Progress Timeline -->
            <div class="order-timeline">
                <div class="timeline-item {{ in_array($order->status, ['pending', 'processing', 'ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h6>Order Dibuat</h6>
                        <small class="text-light">{{ $order->created_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>
                <div class="timeline-item {{ in_array($order->status, ['processing', 'ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h6>Sedang Diproses</h6>
                        <small class="text-light">{{ $order->status === 'processing' ? 'Saat ini' : '-' }}</small>
                    </div>
                </div>
                <div class="timeline-item {{ in_array($order->status, ['ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h6>Siap Diambil</h6>
                        <small class="text-light">{{ $order->status === 'ready' ? 'Saat ini' : '-' }}</small>
                    </div>
                </div>
                <div class="timeline-item {{ $order->status === 'completed' ? 'active' : '' }}">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h6>Selesai</h6>
                        <small class="text-light">{{ $order->status === 'completed' && $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d M Y, H:i') : '-' }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Card -->
        <div class="data-card mb-4">
            <h4 class="mb-4">
                <i class="bi bi-bag-check me-2"></i>Detail Layanan
            </h4>

            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Harga/Unit</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->service->name }}</strong>
                                    @if($item->service->description)
                                        <br><small class="text-light">{{ $item->service->description }}</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->quantity }} {{ $item->service->unit }}</td>
                                <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-end"><strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                            <td class="text-end"><strong>Rp {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end">Biaya Admin:</td>
                            <td class="text-end">Rp {{ number_format(5000, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="table-primary">
                            <td colspan="3" class="text-end"><strong style="font-size: 1.1rem;">TOTAL:</strong></td>
                            <td class="text-end"><strong style="font-size: 1.2rem; color: #6366f1;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Notes Card -->
        @if($order->notes)
            <div class="data-card">
                <h4 class="mb-3">
                    <i class="bi bi-sticky me-2"></i>Catatan
                </h4>
                <div class="p-3" style="background-color: rgba(99,102,241,0.05); border-radius: 0.5rem; border: 1px solid rgba(99,102,241,0.2);">
                    <p class="mb-0 text-light">{{ $order->notes }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- RIGHT COLUMN - SUMMARY -->
    <div class="col-lg-4">
        <!-- Customer Info -->
        <div class="data-card mb-4">
            <h4 class="mb-4">
                <i class="bi bi-person me-2"></i>Informasi Customer
            </h4>
            <div class="mb-3">
                <small class="text-light d-block">Nama</small>
                <strong>{{ $order->customer->name }}</strong>
            </div>
            <div class="mb-3">
                <small class="text-light d-block">Email</small>
                <strong>{{ $order->customer->email }}</strong>
            </div>
            @if($order->customer->phone)
                <div class="mb-3">
                    <small class="text-light d-block">Telepon</small>
                    <strong>{{ $order->customer->phone }}</strong>
                </div>
            @endif
            @if($order->customer->address)
                <div>
                    <small class="text-light d-block">Alamat</small>
                    <strong>{{ $order->customer->address }}</strong>
                </div>
            @endif
        </div>

        <!-- Pickup Info -->
        <div class="data-card mb-4">
            <h4 class="mb-4">
                <i class="bi bi-calendar-event me-2"></i>Jadwal
            </h4>
            <div class="mb-3">
                <small class="text-light d-block">Tanggal Pengambilan</small>
                <strong>{{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y, H:i') }}</strong>
            </div>
            @if($order->delivery_date)
                <div>
                    <small class="text-light d-block">Tanggal Selesai</small>
                    <strong>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y, H:i') }}</strong>
                </div>
            @endif
        </div>

        <!-- Payment Info -->
        <div class="data-card">
            <h4 class="mb-4">
                <i class="bi bi-credit-card me-2"></i>Pembayaran
            </h4>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-light">Total Berat:</span>
                <strong>{{ $order->items->sum('quantity') }} kg</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-light">Subtotal:</span>
                <strong>Rp {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-light">Biaya Admin:</span>
                <strong>Rp 5.000</strong>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1);">
            <div class="d-flex justify-content-between mb-3">
                <span style="font-size: 1.1rem;"><strong>Total:</strong></span>
                <span style="font-size: 1.3rem; font-weight: 700; color: #6366f1;">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </span>
            </div>

            @if($order->payment_status === 'unpaid')
                <a href="{{ route('customer.orders.payment', $order->id) }}" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-credit-card me-2"></i>Bayar Sekarang
                </a>
            @endif

            <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<style>
    .order-timeline {
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 2rem 0;
        margin-top: 2rem;
    }

    .order-timeline::before {
        content: '';
        position: absolute;
        top: 2.5rem;
        left: 0;
        right: 0;
        height: 2px;
        background: rgba(99,102,241,0.2);
        z-index: 0;
    }

    .timeline-item {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .timeline-dot {
        width: 16px;
        height: 16px;
        background: rgba(99,102,241,0.2);
        border: 3px solid #1a1f3a;
        border-radius: 50%;
        margin: 0 auto 1rem;
        transition: all 0.3s ease;
    }

    .timeline-item.active .timeline-dot {
        background: #6366f1;
        box-shadow: 0 0 0 4px rgba(99,102,241,0.2);
        width: 20px;
        height: 20px;
    }

    .timeline-item.active h6 {
        color: #6366f1;
        font-weight: 700;
    }

    .timeline-content h6 {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        color: #e0e7ff;
    }

    .timeline-content small {
        font-size: 0.75rem;
    }

    .table-dark {
        --bs-table-bg: rgba(99,102,241,0.02);
        --bs-table-hover-bg: rgba(99,102,241,0.05);
    }

    .table-dark thead {
        background-color: rgba(99,102,241,0.1);
    }

    .table-dark tfoot {
        border-top: 2px solid rgba(99,102,241,0.3);
    }

    @media (max-width: 768px) {
        .order-timeline {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-timeline::before {
            width: 2px;
            height: 100%;
            left: 8px;
            top: 0;
        }

        .timeline-item {
            padding-left: 3rem;
            text-align: left;
            margin-bottom: 2rem;
        }

        .timeline-dot {
            position: absolute;
            left: 0;
            margin: 0;
        }
    }
</style>
@endsection