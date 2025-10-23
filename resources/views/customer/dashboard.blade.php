@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<div class="page-header">
    <h1>Dashboard Saya</h1>
</div>

<!-- Stat Cards - 3 Columns -->
<div class="stat-card-grid" style="grid-template-columns: repeat(3, 1fr);">
    <!-- Total Order -->
    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $totalOrders ?? 0 }}</h3>
                <p>Total Order</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-box"></i>
            </div>
        </div>
    </div>

    <!-- Pending Orders -->
    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $pendingOrders ?? 0 }}</h3>
                <p>Menunggu Pembayaran</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
        </div>
    </div>

    <!-- Profile Status -->
    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ auth()->user()->is_active ? 'Aktif' : 'Tidak' }}</h3>
                <p>Status Profil</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<!-- Profile & Quick Actions -->
<div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Profile Card -->
    <div class="data-card">
        <h4><i class="bi bi-person" style="margin-right: 0.5rem;"></i>Profil Saya</h4>
        <div style="display: grid; gap: 1rem;">
            <div style="padding-bottom: 1rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <p style="color: #9ca3af; font-size: 0.85rem; margin: 0 0 0.25rem 0;">Nama</p>
                <p style="color: #e5e7eb; font-weight: 600; margin: 0;">{{ auth()->user()->name }}</p>
            </div>

            <div style="padding-bottom: 1rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <p style="color: #9ca3af; font-size: 0.85rem; margin: 0 0 0.25rem 0;">Email</p>
                <p style="color: #e5e7eb; font-weight: 600; margin: 0;">{{ auth()->user()->email }}</p>
            </div>

            <div style="padding-bottom: 1rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <p style="color: #9ca3af; font-size: 0.85rem; margin: 0 0 0.25rem 0;">Telepon</p>
                <p style="color: #e5e7eb; font-weight: 600; margin: 0;">{{ auth()->user()->phone ?? '-' }}</p>
            </div>

            <div>
                <p style="color: #9ca3af; font-size: 0.85rem; margin: 0 0 0.25rem 0;">Alamat</p>
                <p style="color: #e5e7eb; font-weight: 600; margin: 0;">{{ auth()->user()->address ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="data-card">
        <h4><i class="bi bi-lightning" style="margin-right: 0.5rem;"></i>Aksi Cepat</h4>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <a href="{{ route('customer.orders.create') }}" style="
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                padding: 0.875rem 1rem;
                background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
                color: white;
                text-decoration: none;
                border-radius: 0.5rem;
                font-weight: 600;
                transition: all 0.3s ease;
            " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0, 102, 255, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <i class="bi bi-plus-circle"></i> Pesan Laundry
            </a>

            <a href="{{ route('customer.orders.index') }}" style="
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                padding: 0.875rem 1rem;
                background: rgba(34, 197, 94, 0.2);
                color: #86efac;
                text-decoration: none;
                border: 1px solid rgba(34, 197, 94, 0.3);
                border-radius: 0.5rem;
                font-weight: 600;
                transition: all 0.3s ease;
            " onmouseover="this.style.backgroundColor='rgba(34, 197, 94, 0.3)'; this.style.borderColor='rgba(34, 197, 94, 0.5)'" onmouseout="this.style.backgroundColor='rgba(34, 197, 94, 0.2)'; this.style.borderColor='rgba(34, 197, 94, 0.3)'">
                <i class="bi bi-list-check"></i> Lihat Order
            </a>
        </div>
    </div>
</div>

<!-- Recent Orders -->
@if(isset($recentOrders) && $recentOrders->count() > 0)
<div class="data-card">
    <h4><i class="bi bi-clock-history" style="margin-right: 0.5rem;"></i>Order Terbaru</h4>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Order ID</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Total</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Status</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 1rem; color: #e5e7eb;">#{{ $order->id }}</td>
                        <td style="padding: 1rem; color: #e5e7eb;">Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}</td>
                        <td style="padding: 1rem;">
                            @php
                                $statusClass = '';
                                if($order->status === 'pending') {
                                    $statusClass = 'badge-warning';
                                } elseif($order->status === 'processing') {
                                    $statusClass = 'badge-processing';
                                } else {
                                    $statusClass = 'badge-success';
                                }
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td style="padding: 1rem;">
                            <a href="{{ route('customer.orders.show', $order->id) }}" style="
                                background-color: rgba(99, 102, 241, 0.2);
                                color: #6366f1;
                                padding: 0.4rem 0.8rem;
                                border-radius: 0.25rem;
                                text-decoration: none;
                                font-size: 0.85rem;
                                display: inline-flex;
                                align-items: center;
                                gap: 0.25rem;
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
</div>
@else
<div class="data-card">
    <p style="text-align: center; color: #9ca3af; padding: 2rem;">
        <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
        Belum ada order
    </p>
</div>
@endif
@endsection