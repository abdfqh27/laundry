@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="page-header">
    <h1>Dashboard Admin</h1>
    <p style="color: #9ca3af; margin-top: 0.5rem;">Selamat datang, {{ auth()->user()->name }}!</p>
</div>

<!-- Stat Cards - 4 Columns -->
<div class="stat-card-grid">
    <!-- Total Revenue -->
    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>Rp {{ number_format($overview['total_revenue'], 0, ',', '.') }}</h3>
                <p>Total Pendapatan</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>

    <!-- Total Customers -->
    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $overview['total_customers'] }}</h3>
                <p>Total Customer</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-people"></i>
            </div>
        </div>
    </div>

    <!-- Active Orders -->
    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $overview['active_orders'] }}</h3>
                <p>Order Aktif</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-box"></i>
            </div>
        </div>
    </div>

    <!-- Completed Orders -->
    <div class="stat-card purple">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>{{ $overview['completed_orders'] }}</h3>
                <p>Order Selesai</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<!-- Revenue & Orders Statistics -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Pendapatan Section -->
    <div class="data-card">
        <h4>Pendapatan <span style="color: #9ca3af; font-size: 0.85rem;">Per Periode</span></h4>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div style="padding: 1rem; background: rgba(34, 197, 94, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Hari Ini</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #86efac;">
                    Rp {{ number_format($revenue['today'], 0, ',', '.') }}
                </p>
            </div>
            <div style="padding: 1rem; background: rgba(59, 130, 246, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Minggu Ini</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #60a5fa;">
                    Rp {{ number_format($revenue['this_week'], 0, ',', '.') }}
                </p>
            </div>
            <div style="padding: 1rem; background: rgba(168, 85, 247, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Bulan Ini</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #c084fc;">
                    Rp {{ number_format($revenue['this_month'], 0, ',', '.') }}
                </p>
            </div>
            <div style="padding: 1rem; background: rgba(249, 115, 22, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Tahun Ini</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #fb923c;">
                    Rp {{ number_format($revenue['this_year'], 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Order Status Statistics -->
    <div class="data-card">
        <h4>Status Order <span style="color: #9ca3af; font-size: 0.85rem;">Saat Ini</span></h4>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div style="padding: 1rem; background: rgba(251, 191, 36, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Pending</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #fbbf24;">
                    {{ $orderStats->get('pending')->total ?? 0 }}
                </p>
            </div>
            <div style="padding: 1rem; background: rgba(59, 130, 246, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Diproses</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #60a5fa;">
                    {{ $orderStats->get('processing')->total ?? 0 }}
                </p>
            </div>
            <div style="padding: 1rem; background: rgba(34, 197, 94, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Selesai</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #86efac;">
                    {{ $orderStats->get('completed')->total ?? 0 }}
                </p>
            </div>
            <div style="padding: 1rem; background: rgba(168, 85, 247, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Diambil</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #c084fc;">
                    {{ $orderStats->get('picked_up')->total ?? 0 }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Payment Methods & Performance -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Payment Methods -->
    <div class="data-card">
        <h4>Metode Pembayaran <span style="color: #9ca3af; font-size: 0.85rem;">Total Transaksi</span></h4>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(59, 130, 246, 0.1); border-radius: 0.5rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <i class="bi bi-cash-coin" style="font-size: 1.5rem; color: #60a5fa;"></i>
                    <span style="color: #e5e7eb;">Cash</span>
                </div>
                <span style="font-weight: 600; color: #60a5fa;">
                    Rp {{ number_format($paymentStats['cash'], 0, ',', '.') }}
                </span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(34, 197, 94, 0.1); border-radius: 0.5rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <i class="bi bi-bank" style="font-size: 1.5rem; color: #86efac;"></i>
                    <span style="color: #e5e7eb;">Transfer</span>
                </div>
                <span style="font-weight: 600; color: #86efac;">
                    Rp {{ number_format($paymentStats['transfer'], 0, ',', '.') }}
                </span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(168, 85, 247, 0.1); border-radius: 0.5rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <i class="bi bi-qr-code" style="font-size: 1.5rem; color: #c084fc;"></i>
                    <span style="color: #e5e7eb;">QRIS</span>
                </div>
                <span style="font-weight: 600; color: #c084fc;">
                    Rp {{ number_format($paymentStats['qris'], 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Performance Metrics -->
    <div class="data-card">
        <h4>Metrik Performa <span style="color: #9ca3af; font-size: 0.85rem;">Keseluruhan</span></h4>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="padding: 0.75rem; background: rgba(34, 197, 94, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Tingkat Penyelesaian</p>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="flex: 1; height: 8px; background: rgba(255, 255, 255, 0.1); border-radius: 999px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $completionRate }}%; background: linear-gradient(to right, #86efac, #22c55e); border-radius: 999px;"></div>
                    </div>
                    <span style="font-weight: 700; color: #86efac; min-width: 50px; text-align: right;">{{ $completionRate }}%</span>
                </div>
            </div>
            <div style="padding: 0.75rem; background: rgba(59, 130, 246, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Rata-rata Nilai Order</p>
                <p style="font-size: 1.25rem; font-weight: 700; margin: 0; color: #60a5fa;">
                    Rp {{ number_format($averageOrderValue, 0, ',', '.') }}
                </p>
            </div>
            <div style="padding: 0.75rem; background: rgba(249, 115, 22, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Pembayaran Pending</p>
                <p style="font-size: 1.25rem; font-weight: 700; margin: 0; color: #fb923c;">
                    {{ $overview['pending_payments'] }} Transaksi
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Pending Transactions Alert -->
@if($pendingTransactions->count() > 0)
<div class="data-card" style="background: linear-gradient(135deg, rgba(249, 115, 22, 0.1) 0%, rgba(251, 191, 36, 0.1) 100%); border-left: 4px solid #fb923c; margin-bottom: 2rem;">
    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
        <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color: #fb923c;"></i>
        <div>
            <h4 style="margin: 0; color: #fb923c;">Perhatian!</h4>
            <p style="color: #9ca3af; margin: 0.25rem 0 0 0; font-size: 0.9rem;">
                Ada {{ $pendingTransactions->count() }} transaksi menunggu konfirmasi
            </p>
        </div>
    </div>
    <a href="{{ route('transaction.pending') }}" class="btn btn-warning" style="background: #fb923c; border: none;">
        <i class="bi bi-eye"></i> Lihat Transaksi Pending
    </a>
</div>
@endif

<!-- Recent Orders Table -->
<div class="data-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h4 style="margin: 0;">Order Terbaru</h4>
        <a href="#" style="color: #6366f1; text-decoration: none; font-size: 0.9rem; transition: color 0.3s ease;" onmouseover="this.style.color='#4f46e5'" onmouseout="this.style.color='#6366f1'">
            Lihat Semua →
        </a>
    </div>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">No. Order</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Customer</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Karyawan</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Total</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Status</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Pembayaran</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 1rem; color: #e5e7eb; font-weight: 600;">{{ $order->order_number }}</td>
                    <td style="padding: 1rem; color: #e5e7eb;">{{ $order->customer->name }}</td>
                    <td style="padding: 1rem; color: #e5e7eb;">
                        {{ $order->karyawan ? $order->karyawan->name : '-' }}
                    </td>
                    <td style="padding: 1rem; color: #e5e7eb;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td style="padding: 1rem;">
                        @if($order->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($order->status === 'processing')
                            <span class="badge badge-processing">Diproses</span>
                        @elseif($order->status === 'completed')
                            <span class="badge badge-success">Selesai</span>
                        @elseif($order->status === 'picked_up')
                            <span class="badge badge-info">Diambil</span>
                        @elseif($order->status === 'cancelled')
                            <span class="badge badge-danger">Dibatalkan</span>
                        @endif
                    </td>
                    <td style="padding: 1rem;">
                        @if($order->payment_status === 'paid')
                            <span class="badge badge-success">Lunas</span>
                        @else
                            <span class="badge badge-danger">Belum Bayar</span>
                        @endif
                    </td>
                    <td style="padding: 1rem;">
                        <a href="#" style="
                            background-color: rgba(99, 102, 241, 0.2);
                            color: #6366f1;
                            border: none;
                            padding: 0.4rem 0.8rem;
                            border-radius: 0.25rem;
                            text-decoration: none;
                            font-size: 0.85rem;
                            transition: all 0.3s ease;
                            display: inline-block;
                        " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'; this.style.transform='translateY(0)'">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 2rem; text-align: center; color: #9ca3af;">
                        Belum ada order
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Top Services & Top Customers -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <!-- Top Services -->
    <div class="data-card">
        <h4 style="margin-bottom: 1.5rem;">
            <i class="bi bi-star-fill" style="color: #fbbf24;"></i> 
            Layanan Terpopuler
        </h4>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($topServices as $index => $item)
            <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(99, 102, 241, 0.05); border-radius: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.1)'; this.style.transform='translateX(5px)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'; this.style.transform='translateX(0)'">
                <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem;">
                    {{ $index + 1 }}
                </div>
                <div style="flex: 1;">
                    <p style="margin: 0; color: #e5e7eb; font-weight: 600;">{{ $item->service->name }}</p>
                    <p style="margin: 0.25rem 0 0 0; color: #9ca3af; font-size: 0.85rem;">
                        {{ $item->total_quantity }} kg • Rp {{ number_format($item->total_revenue, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            @empty
            <p style="text-align: center; color: #9ca3af; padding: 2rem;">Belum ada data layanan</p>
            @endforelse
        </div>
    </div>

    <!-- Top Customers -->
    <div class="data-card">
        <h4 style="margin-bottom: 1.5rem;">
            <i class="bi bi-trophy-fill" style="color: #fbbf24;"></i> 
            Customer Teratas
        </h4>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($topCustomers as $index => $item)
            <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(34, 197, 94, 0.05); border-radius: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.transform='translateX(5px)'" onmouseout="this.style.backgroundColor='rgba(34, 197, 94, 0.05)'; this.style.transform='translateX(0)'">
                <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #22c55e, #86efac); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem;">
                    {{ $index + 1 }}
                </div>
                <div style="flex: 1;">
                    <p style="margin: 0; color: #e5e7eb; font-weight: 600;">{{ $item->customer->name }}</p>
                    <p style="margin: 0.25rem 0 0 0; color: #9ca3af; font-size: 0.85rem;">
                        {{ $item->total_orders }} order • Rp {{ number_format($item->total_spent, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            @empty
            <p style="text-align: center; color: #9ca3af; padding: 2rem;">Belum ada data customer</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Quick Actions Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <!-- Manage Users Card -->
    <a href="{{ route('admin.users.index') }}" class="data-card" style="cursor: pointer; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 48px; height: 48px; background: rgba(59, 130, 246, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-people" style="color: #60a5fa;"></i>
            </div>
            <h4 style="margin: 0; color: #fff;">Kelola User</h4>
        </div>
        <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">Atur data pengguna dan role</p>
        <div style="display: inline-block; margin-top: 1rem; color: #6366f1; font-size: 0.9rem; font-weight: 600;">
            Buka <i class="bi bi-arrow-right"></i>
        </div>
    </a>

    <!-- Transactions Card -->
    <a href="{{ route('transaction.index') }}" class="data-card" style="cursor: pointer; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 48px; height: 48px; background: rgba(34, 197, 94, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-credit-card" style="color: #86efac;"></i>
            </div>
            <h4 style="margin: 0; color: #fff;">Data Transaksi</h4>
        </div>
        <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">Lihat riwayat transaksi</p>
        <div style="display: inline-block; margin-top: 1rem; color: #6366f1; font-size: 0.9rem; font-weight: 600;">
            Buka <i class="bi bi-arrow-right"></i>
        </div>
    </a>

    <!-- Services Card -->
    <a href="#" class="data-card" style="cursor: pointer; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 48px; height: 48px; background: rgba(168, 85, 247, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-gear" style="color: #c084fc;"></i>
            </div>
            <h4 style="margin: 0; color: #fff;">Data Harga</h4>
        </div>
        <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">Kelola layanan dan tarif</p>
        <div style="display: inline-block; margin-top: 1rem; color: #6366f1; font-size: 0.9rem; font-weight: 600;">
            Buka <i class="bi bi-arrow-right"></i>
        </div>
    </a>

    <!-- Reports Card -->
    <a href="#" class="data-card" style="cursor: pointer; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 48px; height: 48px; background: rgba(249, 115, 22, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-bar-chart" style="color: #fb923c;"></i>
            </div>
            <h4 style="margin: 0; color: #fff;">Laporan</h4>
        </div>
        <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">Laporan transaksi & keuangan</p>
        <div style="display: inline-block; margin-top: 1rem; color: #6366f1; font-size: 0.9rem; font-weight: 600;">
            Buka <i class="bi bi-arrow-right"></i>
        </div>
    </a>
</div>

<!-- User Statistics -->
<div class="data-card" style="margin-top: 2rem;">
    <h4 style="margin-bottom: 1.5rem;">
        <i class="bi bi-people-fill" style="color: #60a5fa;"></i> 
        Statistik Pengguna
    </h4>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
        <div style="padding: 1rem; background: rgba(59, 130, 246, 0.1); border-radius: 0.5rem; text-align: center;">
            <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.5rem;">Total User</p>
            <p style="font-size: 2rem; font-weight: 700; margin: 0; color: #60a5fa;">{{ $userStats['total_users'] }}</p>
        </div>
        <div style="padding: 1rem; background: rgba(249, 115, 22, 0.1); border-radius: 0.5rem; text-align: center;">
            <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.5rem;">Administrator</p>
            <p style="font-size: 2rem; font-weight: 700; margin: 0; color: #fb923c;">{{ $userStats['administrators'] }}</p>
        </div>
        <div style="padding: 1rem; background: rgba(168, 85, 247, 0.1); border-radius: 0.5rem; text-align: center;">
            <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.5rem;">Karyawan</p>
            <p style="font-size: 2rem; font-weight: 700; margin: 0; color: #c084fc;">{{ $userStats['karyawan'] }}</p>
        </div>
        <div style="padding: 1rem; background: rgba(34, 197, 94, 0.1); border-radius: 0.5rem; text-align: center;">
            <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.5rem;">Customer</p>
            <p style="font-size: 2rem; font-weight: 700; margin: 0; color: #86efac;">{{ $userStats['customers'] }}</p>
        </div>
        <div style="padding: 1rem; background: rgba(34, 197, 94, 0.1); border-radius: 0.5rem; text-align: center;">
            <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.5rem;">Aktif</p>
            <p style="font-size: 2rem; font-weight: 700; margin: 0; color: #86efac;">{{ $userStats['active_users'] }}</p>
        </div>
        <div style="padding: 1rem; background: rgba(239, 68, 68, 0.1); border-radius: 0.5rem; text-align: center;">
            <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.5rem;">Tidak Aktif</p>
            <p style="font-size: 2rem; font-weight: 700; margin: 0; color: #ef4444;">{{ $userStats['inactive_users'] }}</p>
        </div>
    </div>
</div>
@endsection