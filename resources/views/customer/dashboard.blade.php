@extends('layouts.app')

@section('title', 'Dashboard Customer')

@section('content')
<div class="page-header">
    <div>
        <h1>👋 Halo, {{ auth()->user()->name }}!</h1>
        <p style="color: #9ca3af; margin-top: 0.5rem;">Selamat datang kembali di Hejo Laundry</p>
    </div>
</div>

<!-- Alert Notifications -->
@if(isset($notifications) && count($notifications) > 0)
<div style="margin-bottom: 2rem; display: flex; flex-direction: column; gap: 1rem;">
    @foreach($notifications as $notif)
        <div style="
            padding: 1rem 1.25rem;
            border-radius: 0.75rem;
            background: {{ $notif['type'] === 'warning' ? 'rgba(251, 191, 36, 0.1)' : ($notif['type'] === 'success' ? 'rgba(34, 197, 94, 0.1)' : 'rgba(59, 130, 246, 0.1)') }};
            border-left: 4px solid {{ $notif['type'] === 'warning' ? '#fbbf24' : ($notif['type'] === 'success' ? '#22c55e' : '#3b82f6') }};
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideInLeft 0.5s ease;
        ">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="bi bi-{{ $notif['icon'] }}" style="
                    font-size: 1.5rem;
                    color: {{ $notif['type'] === 'warning' ? '#fbbf24' : ($notif['type'] === 'success' ? '#22c55e' : '#3b82f6') }};
                "></i>
                <p style="margin: 0; color: #e5e7eb; font-weight: 500;">{{ $notif['message'] }}</p>
            </div>
            <a href="{{ $notif['url'] }}" style="
                padding: 0.5rem 1rem;
                background: {{ $notif['type'] === 'warning' ? 'rgba(251, 191, 36, 0.2)' : ($notif['type'] === 'success' ? 'rgba(34, 197, 94, 0.2)' : 'rgba(59, 130, 246, 0.2)') }};
                color: {{ $notif['type'] === 'warning' ? '#fbbf24' : ($notif['type'] === 'success' ? '#22c55e' : '#3b82f6') }};
                border-radius: 0.5rem;
                text-decoration: none;
                font-size: 0.875rem;
                font-weight: 600;
                white-space: nowrap;
                transition: all 0.3s ease;
            " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                {{ $notif['action'] }} →
            </a>
        </div>
    @endforeach
</div>
@endif

<!-- Main Stats Grid - 4 Columns -->
<div class="stat-card-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 2rem;">
    <!-- Total Orders -->
    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $stats['total_orders'] ?? 0 }}</h3>
                <p>Total Order</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-box-seam"></i>
            </div>
        </div>
        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <small style="color: #9ca3af;">{{ $stats['this_month_orders'] ?? 0 }} order bulan ini</small>
        </div>
    </div>

    <!-- Total Spent -->
    <div class="stat-card purple">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ number_format($stats['total_spent'] ?? 0, 0, ',', '.') }}</h3>
                <p>Total Pengeluaran</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-wallet2"></i>
            </div>
        </div>
        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <small style="color: #9ca3af;">Rp {{ number_format($stats['this_month_spent'] ?? 0, 0, ',', '.') }} bulan ini</small>
        </div>
    </div>

    <!-- Processing Orders -->
    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $stats['processing_orders'] ?? 0 }}</h3>
                <p>Sedang Diproses</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
        </div>
        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <small style="color: #9ca3af;">{{ $stats['pending_orders'] ?? 0 }} menunggu konfirmasi</small>
        </div>
    </div>

    <!-- Ready to Pickup -->
    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $stats['ready_pickup'] ?? 0 }}</h3>
                <p>Siap Diambil</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-check-circle"></i>
            </div>
        </div>
        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <small style="color: #9ca3af;">{{ $stats['completed_orders'] ?? 0 }} order selesai</small>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div style="margin-bottom: 2rem;">
    <h4 style="color: #e5e7eb; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
        <i class="bi bi-lightning-charge-fill" style="color: #fbbf24;"></i>
        Aksi Cepat
    </h4>
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
        @foreach($quickActions ?? [] as $action)
        <a href="{{ $action['url'] }}" style="
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        " onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='rgba(99, 102, 241, 0.5)'; this.style.boxShadow='0 10px 25px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(99, 102, 241, 0.2)'; this.style.boxShadow='none'">
            <div style="
                width: 3rem;
                height: 3rem;
                background: rgba(99, 102, 241, 0.2);
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                <i class="bi bi-{{ $action['icon'] }}" style="font-size: 1.5rem; color: #6366f1;"></i>
            </div>
            <div>
                <h5 style="color: #e5e7eb; margin: 0 0 0.25rem 0; font-size: 1rem;">{{ $action['title'] }}</h5>
                <p style="color: #9ca3af; margin: 0; font-size: 0.875rem;">{{ $action['description'] }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- Main Content Grid -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Left Column -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        
        <!-- Orders Requiring Attention -->
        @if(isset($unpaidOrders) && $unpaidOrders->count() > 0)
        <div class="data-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h4 style="margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="bi bi-exclamation-triangle" style="color: #fbbf24;"></i>
                    Menunggu Pembayaran
                </h4>
                <span style="
                    background: rgba(251, 191, 36, 0.2);
                    color: #fbbf24;
                    padding: 0.25rem 0.75rem;
                    border-radius: 1rem;
                    font-size: 0.875rem;
                    font-weight: 600;
                ">{{ $unpaidOrders->count() }} order</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($unpaidOrders as $order)
                <div style="
                    padding: 1rem;
                    background: rgba(251, 191, 36, 0.05);
                    border: 1px solid rgba(251, 191, 36, 0.2);
                    border-radius: 0.75rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                ">
                    <div>
                        <p style="margin: 0; color: #e5e7eb; font-weight: 600;">{{ $order->order_number }}</p>
                        <p style="margin: 0.25rem 0 0 0; color: #9ca3af; font-size: 0.875rem;">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }} • {{ $order->items->count() }} layanan
                        </p>
                    </div>
                    <a href="{{ route('customer.orders.payment', $order->id) }}" style="
                        padding: 0.5rem 1rem;
                        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
                        color: white;
                        border-radius: 0.5rem;
                        text-decoration: none;
                        font-size: 0.875rem;
                        font-weight: 600;
                        white-space: nowrap;
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        Bayar Sekarang
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Ready to Pickup Orders -->
        @if(isset($readyOrders) && $readyOrders->count() > 0)
        <div class="data-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h4 style="margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="bi bi-check-circle-fill" style="color: #22c55e;"></i>
                    Siap Diambil
                </h4>
                <span style="
                    background: rgba(34, 197, 94, 0.2);
                    color: #22c55e;
                    padding: 0.25rem 0.75rem;
                    border-radius: 1rem;
                    font-size: 0.875rem;
                    font-weight: 600;
                ">{{ $readyOrders->count() }} order</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($readyOrders as $order)
                <div style="
                    padding: 1rem;
                    background: rgba(34, 197, 94, 0.05);
                    border: 1px solid rgba(34, 197, 94, 0.2);
                    border-radius: 0.75rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                ">
                    <div>
                        <p style="margin: 0; color: #e5e7eb; font-weight: 600;">{{ $order->order_number }}</p>
                        <p style="margin: 0.25rem 0 0 0; color: #9ca3af; font-size: 0.875rem;">
                            {{ $order->items->count() }} layanan • Selesai {{ $order->completed_at?->diffForHumans() ?? 'baru saja' }}
                        </p>
                    </div>
                    <a href="{{ route('customer.orders.show', $order->id) }}" style="
                        padding: 0.5rem 1rem;
                        background: rgba(34, 197, 94, 0.2);
                        color: #22c55e;
                        border: 1px solid rgba(34, 197, 94, 0.3);
                        border-radius: 0.5rem;
                        text-decoration: none;
                        font-size: 0.875rem;
                        font-weight: 600;
                        white-space: nowrap;
                        transition: all 0.3s ease;
                    " onmouseover="this.style.backgroundColor='rgba(34, 197, 94, 0.3)'" onmouseout="this.style.backgroundColor='rgba(34, 197, 94, 0.2)'">
                        Lihat Detail
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Recent Orders Table -->
        <div class="data-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h4 style="margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="bi bi-clock-history"></i>
                    Order Terbaru
                </h4>
                <a href="{{ route('customer.orders.index') }}" style="
                    color: #6366f1;
                    text-decoration: none;
                    font-size: 0.875rem;
                    font-weight: 600;
                    transition: color 0.3s ease;
                " onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#6366f1'">
                    Lihat Semua →
                </a>
            </div>
            
            @if(isset($recentOrders) && $recentOrders->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                            <th style="padding: 0.75rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.875rem;">Order</th>
                            <th style="padding: 0.75rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.875rem;">Tanggal</th>
                            <th style="padding: 0.75rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.875rem;">Total</th>
                            <th style="padding: 0.75rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.875rem;">Status</th>
                            <th style="padding: 0.75rem; text-align: center; color: #9ca3af; font-weight: 600; font-size: 0.875rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 0.75rem;">
                                <p style="margin: 0; color: #e5e7eb; font-weight: 600; font-size: 0.875rem;">{{ $order->order_number }}</p>
                                <p style="margin: 0.25rem 0 0 0; color: #9ca3af; font-size: 0.75rem;">{{ $order->items->count() }} layanan</p>
                            </td>
                            <td style="padding: 0.75rem; color: #9ca3af; font-size: 0.875rem;">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td style="padding: 0.75rem; color: #e5e7eb; font-weight: 600; font-size: 0.875rem;">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                            <td style="padding: 0.75rem;">
                                @php
                                    $statusConfig = [
                                        'pending' => ['color' => '#fbbf24', 'bg' => 'rgba(251, 191, 36, 0.2)', 'label' => 'Pending'],
                                        'processing' => ['color' => '#3b82f6', 'bg' => 'rgba(59, 130, 246, 0.2)', 'label' => 'Diproses'],
                                        'completed' => ['color' => '#22c55e', 'bg' => 'rgba(34, 197, 94, 0.2)', 'label' => 'Selesai'],
                                        'picked_up' => ['color' => '#8b5cf6', 'bg' => 'rgba(139, 92, 246, 0.2)', 'label' => 'Diambil'],
                                        'cancelled' => ['color' => '#ef4444', 'bg' => 'rgba(239, 68, 68, 0.2)', 'label' => 'Dibatalkan'],
                                    ];
                                    $config = $statusConfig[$order->status] ?? $statusConfig['pending'];
                                @endphp
                                <span style="
                                    background: {{ $config['bg'] }};
                                    color: {{ $config['color'] }};
                                    padding: 0.375rem 0.75rem;
                                    border-radius: 0.5rem;
                                    font-size: 0.75rem;
                                    font-weight: 600;
                                    white-space: nowrap;
                                ">{{ $config['label'] }}</span>
                            </td>
                            <td style="padding: 0.75rem; text-align: center;">
                                <a href="{{ route('customer.orders.show', $order->id) }}" style="
                                    background: rgba(99, 102, 241, 0.2);
                                    color: #6366f1;
                                    padding: 0.5rem 0.875rem;
                                    border-radius: 0.5rem;
                                    text-decoration: none;
                                    font-size: 0.875rem;
                                    font-weight: 600;
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 0.375rem;
                                    transition: all 0.3s ease;
                                " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="text-align: center; padding: 3rem; color: #9ca3af;">
                <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.5;"></i>
                <p style="margin: 0; font-size: 1rem;">Belum ada order</p>
                <a href="{{ route('customer.orders.create') }}" style="
                    display: inline-block;
                    margin-top: 1rem;
                    padding: 0.75rem 1.5rem;
                    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                    color: white;
                    border-radius: 0.75rem;
                    text-decoration: none;
                    font-weight: 600;
                    transition: all 0.3s ease;
                " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 25px rgba(99, 102, 241, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    Buat Order Pertama
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Right Column -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        
        <!-- Profile Card -->
        <div class="data-card">
            <h4 style="margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                <i class="bi bi-person-circle"></i>
                Profil Saya
            </h4>
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="
                    width: 5rem;
                    height: 5rem;
                    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 1rem auto;
                    font-size: 2rem;
                    color: white;
                    font-weight: 700;
                ">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <h5 style="margin: 0; color: #e5e7eb; font-size: 1.125rem;">{{ auth()->user()->name }}</h5>
                <p style="margin: 0.5rem 0 0 0; color: #9ca3af; font-size: 0.875rem;">Member Customer</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="padding: 0.75rem; background: rgba(99, 102, 241, 0.1); border-radius: 0.5rem;">
                    <p style="margin: 0 0 0.25rem 0; color: #9ca3af; font-size: 0.75rem;">Email</p>
                    <p style="margin: 0; color: #e5e7eb; font-size: 0.875rem; font-weight: 600;">{{ auth()->user()->email }}</p>
                </div>

                <div style="padding: 0.75rem; background: rgba(99, 102, 241, 0.1); border-radius: 0.5rem;">
                    <p style="margin: 0 0 0.25rem 0; color: #9ca3af; font-size: 0.75rem;">Telepon</p>
                    <p style="margin: 0; color: #e5e7eb; font-size: 0.875rem; font-weight: 600;">{{ auth()->user()->phone ?? '-' }}</p>
                </div>

                @if(auth()->user()->address)
                <div style="padding: 0.75rem; background: rgba(99, 102, 241, 0.1); border-radius: 0.5rem;">
                    <p style="margin: 0 0 0.25rem 0; color: #9ca3af; font-size: 0.75rem;">Alamat</p>
                    <p style="margin: 0; color: #e5e7eb; font-size: 0.875rem; font-weight: 600;">{{ auth()->user()->address }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Favorite Services -->
        @if(isset($favoriteServices) && $favoriteServices->count() > 0)
        <div class="data-card">
            <h4 style="margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                Layanan Favorit
            </h4>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($favoriteServices->take(3) as $service)
                <div style="
                    padding: 0.75rem;
                    background: rgba(139, 92, 246, 0.1);
                    border: 1px solid rgba(139, 92, 246, 0.2);
                    border-radius: 0.5rem;
                ">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                        <p style="margin: 0; color: #e5e7eb; font-weight: 600; font-size: 0.875rem;">{{ $service->name }}</p>
                        <span style="
                            background: rgba(251, 191, 36, 0.2);
                            color: #fbbf24;
                            padding: 0.125rem 0.5rem;
                            border-radius: 0.25rem;
                            font-size: 0.75rem;
                            font-weight: 600;
                        ">{{ $service->usage_count }}x</span>
                    </div>
                    <p style="margin: 0; color: #9ca3af; font-size: 0.75rem;">
                        Rp {{ number_format($service->price, 0, ',', '.') }}/kg
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Monthly Spending Chart -->
        @if(isset($monthlySpending) && count($monthlySpending) > 0)
        <div class="data-card">
            <h4 style="margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                <i class="bi bi-graph-up-arrow"></i>
                Pengeluaran 6 Bulan
            </h4>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                @php
                    $maxAmount = max(array_column($monthlySpending, 'amount'));
                    $maxAmount = $maxAmount > 0 ? $maxAmount : 1;
                @endphp
                @foreach($monthlySpending as $data)
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                        <span style="color: #9ca3af; font-size: 0.75rem;">{{ $data['month'] }}</span>
                        <span style="color: #e5e7eb; font-size: 0.75rem; font-weight: 600;">Rp {{ number_format($data['amount'], 0, ',', '.') }}</span>
                    </div>
                    <div style="
                        width: 100%;
                        height: 0.5rem;
                        background: rgba(99, 102, 241, 0.2);
                        border-radius: 0.25rem;
                        overflow: hidden;
                    ">
                        <div style="
                            width: {{ $maxAmount > 0 ? ($data['amount'] / $maxAmount * 100) : 0 }}%;
                            height: 100%;
                            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 100%);
                            transition: width 0.5s ease;
                        "></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Processing Orders Status -->
        @if(isset($processingOrders) && $processingOrders->count() > 0)
        <div class="data-card">
            <h4 style="margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                <i class="bi bi-gear-fill" style="color: #3b82f6;"></i>
                Sedang Diproses
            </h4>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($processingOrders as $order)
                <div style="
                    padding: 0.875rem;
                    background: rgba(59, 130, 246, 0.1);
                    border: 1px solid rgba(59, 130, 246, 0.2);
                    border-radius: 0.5rem;
                ">
                    <p style="margin: 0 0 0.5rem 0; color: #e5e7eb; font-weight: 600; font-size: 0.875rem;">{{ $order->order_number }}</p>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <div style="
                            width: 2rem;
                            height: 2rem;
                            background: rgba(59, 130, 246, 0.2);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="bi bi-person" style="color: #3b82f6; font-size: 0.875rem;"></i>
                        </div>
                        <div>
                            <p style="margin: 0; color: #9ca3af; font-size: 0.75rem;">Ditangani oleh</p>
                            <p style="margin: 0; color: #e5e7eb; font-size: 0.8rem; font-weight: 600;">{{ $order->karyawan->name ?? 'Belum ditentukan' }}</p>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #9ca3af; font-size: 0.75rem;">{{ $order->items->count() }} layanan</span>
                        <a href="{{ route('customer.orders.show', $order->id) }}" style="
                            color: #3b82f6;
                            text-decoration: none;
                            font-size: 0.75rem;
                            font-weight: 600;
                            transition: color 0.3s ease;
                        " onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#3b82f6'">
                            Lihat Progress →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Additional Info Section -->
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Tips Card -->
    <div class="data-card" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%); border: 1px solid rgba(99, 102, 241, 0.2);">
        <div style="display: flex; align-items: start; gap: 1rem;">
            <div style="
                width: 3rem;
                height: 3rem;
                background: rgba(99, 102, 241, 0.2);
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            ">
                <i class="bi bi-lightbulb-fill" style="font-size: 1.5rem; color: #fbbf24;"></i>
            </div>
            <div>
                <h5 style="margin: 0 0 0.5rem 0; color: #e5e7eb; font-size: 0.95rem;">Tips Hemat</h5>
                <p style="margin: 0; color: #9ca3af; font-size: 0.875rem; line-height: 1.5;">
                    Kumpulkan cucian Anda dan order sekaligus untuk menghemat biaya antar!
                </p>
            </div>
        </div>
    </div>

    <!-- Promo Card -->
    <div class="data-card" style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%); border: 1px solid rgba(34, 197, 94, 0.2);">
        <div style="display: flex; align-items: start; gap: 1rem;">
            <div style="
                width: 3rem;
                height: 3rem;
                background: rgba(34, 197, 94, 0.2);
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            ">
                <i class="bi bi-tag-fill" style="font-size: 1.5rem; color: #22c55e;"></i>
            </div>
            <div>
                <h5 style="margin: 0 0 0.5rem 0; color: #e5e7eb; font-size: 0.95rem;">Promo Spesial</h5>
                <p style="margin: 0; color: #9ca3af; font-size: 0.875rem; line-height: 1.5;">
                    Dapatkan diskon 10% untuk order minimal 5kg. Hubungi admin untuk info lebih lanjut!
                </p>
            </div>
        </div>
    </div>

    <!-- Support Card -->
    <div class="data-card" style="background: linear-gradient(135deg, rgba(251, 191, 36, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%); border: 1px solid rgba(251, 191, 36, 0.2);">
        <div style="display: flex; align-items: start; gap: 1rem;">
            <div style="
                width: 3rem;
                height: 3rem;
                background: rgba(251, 191, 36, 0.2);
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            ">
                <i class="bi bi-headset" style="font-size: 1.5rem; color: #fbbf24;"></i>
            </div>
            <div>
                <h5 style="margin: 0 0 0.5rem 0; color: #e5e7eb; font-size: 0.95rem;">Bantuan 24/7</h5>
                <p style="margin: 0; color: #9ca3af; font-size: 0.875rem; line-height: 1.5;">
                    Ada pertanyaan? Hubungi customer service kami melalui WhatsApp.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Stat Card Grid Responsive */
@media (max-width: 1200px) {
    .stat-card-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 768px) {
    .stat-card-grid {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="grid-template-columns: 2fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="grid-template-columns: repeat(4, 1fr)"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    
    div[style*="grid-template-columns: repeat(3, 1fr)"] {
        grid-template-columns: 1fr !important;
    }
}

/* Smooth Transitions */
.data-card, .stat-card {
    transition: all 0.3s ease;
}

.data-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

/* Loading Animation */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}
</style>

@endsection