@extends('layouts.app')

@section('title', 'Laporan Pesanan')

@section('content')
<div style="padding: 2rem;">
    <!-- Header -->
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
                <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">
                    📦 Laporan Pesanan
                </h1>
                <p style="color: #6b7280; font-size: 0.95rem;">
                    Data lengkap semua pesanan laundry
                </p>
            </div>
            
            <!-- Export Buttons -->
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('report.orders.pdf', request()->query()) }}" 
                   style="padding: 0.625rem 1.25rem; background: #ef4444; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s;"
                   onmouseover="this.style.background='#dc2626'"
                   onmouseout="this.style.background='#ef4444'">
                    <i class="bi bi-file-pdf"></i>
                    Export PDF
                </a>
                
                <a href="{{ route('report.orders.excel', request()->query()) }}" 
                   style="padding: 0.625rem 1.25rem; background: #10b981; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s;"
                   onmouseover="this.style.background='#059669'"
                   onmouseout="this.style.background='#10b981'">
                    <i class="bi bi-file-earmark-excel"></i>
                    Export Excel
                </a>
                
                <a href="{{ route('report.index') }}" 
                   style="padding: 0.625rem 1.25rem; background: #6b7280; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s;"
                   onmouseover="this.style.background='#4b5563'"
                   onmouseout="this.style.background='#6b7280'">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
        <!-- Total Orders -->
        <div style="background: linear-gradient(135deg, #3b82f6, #2563eb); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);">
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem;">Total Pesanan</div>
            <div style="font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $summary['total_count'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8;">📦 Semua Status</div>
        </div>

        <!-- Total Revenue -->
        <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);">
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem;">Total Pendapatan</div>
            <div style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8;">💰 Pesanan Lunas</div>
        </div>

        <!-- Completed Orders -->
        <div style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 6px rgba(139, 92, 246, 0.3);">
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem;">Selesai</div>
            <div style="font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $summary['completed_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8;">✅ Completed</div>
        </div>

        <!-- Processing Orders -->
        <div style="background: linear-gradient(135deg, #f59e0b, #d97706); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 6px rgba(245, 158, 11, 0.3);">
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem;">Proses</div>
            <div style="font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $summary['processing_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8;">⏳ Processing</div>
        </div>

        <!-- Pending Orders -->
        <div style="background: linear-gradient(135deg, #f97316, #ea580c); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 6px rgba(249, 115, 22, 0.3);">
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem;">Pending</div>
            <div style="font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $summary['pending_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8;">⏰ Menunggu</div>
        </div>

        <!-- Picked Up Orders -->
        <div style="background: linear-gradient(135deg, #06b6d4, #0891b2); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 6px rgba(6, 182, 212, 0.3);">
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem;">Diambil</div>
            <div style="font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $summary['picked_up_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8;">🎉 Picked Up</div>
        </div>

        <!-- Cancelled Orders -->
        <div style="background: linear-gradient(135deg, #ef4444, #dc2626); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);">
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem;">Dibatalkan</div>
            <div style="font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $summary['cancelled_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8;">❌ Cancelled</div>
        </div>

        <!-- Payment Status - Paid -->
        <div style="background: linear-gradient(135deg, #14b8a6, #0d9488); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 6px rgba(20, 184, 166, 0.3);">
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem;">Lunas</div>
            <div style="font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $summary['paid_count'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8;">💳 Pembayaran Lunas</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1.5rem;">
        <form method="GET" action="{{ route('report.orders') }}">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                <!-- Start Date -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Dari Tanggal
                    </label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                           style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                </div>

                <!-- End Date -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Sampai Tanggal
                    </label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                </div>

                <!-- Status -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Status Pesanan
                    </label>
                    <select name="status"
                            style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="picked_up" {{ request('status') == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Payment Status -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Status Pembayaran
                    </label>
                    <select name="payment_status"
                            style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        <option value="">Semua Status</option>
                        <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <!-- Customer -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Pelanggan
                    </label>
                    <select name="customer_id"
                            style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        <option value="">Semua Pelanggan</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Karyawan -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Karyawan
                    </label>
                    <select name="karyawan_id"
                            style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        <option value="">Semua Karyawan</option>
                        @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" {{ request('karyawan_id') == $karyawan->id ? 'selected' : '' }}>
                            {{ $karyawan->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <button type="submit"
                        style="padding: 0.625rem 1.5rem; background: #3b82f6; color: white; border: none; border-radius: 0.5rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s;"
                        onmouseover="this.style.background='#2563eb'"
                        onmouseout="this.style.background='#3b82f6'">
                    <i class="bi bi-funnel"></i>
                    Filter
                </button>

                @if(request()->hasAny(['start_date', 'end_date', 'status', 'payment_status', 'customer_id', 'karyawan_id']))
                <a href="{{ route('report.orders') }}"
                   style="padding: 0.625rem 1.5rem; background: #ef4444; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s;"
                   onmouseover="this.style.background='#dc2626'"
                   onmouseout="this.style.background='#ef4444'">
                    <i class="bi bi-x-circle"></i>
                    Reset Filter
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div style="background: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                    <tr>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Order ID</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Tanggal</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Pelanggan</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Karyawan</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Layanan</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151; font-size: 0.875rem;">Status</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151; font-size: 0.875rem;">Pembayaran</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #374151; font-size: 0.875rem;">Total</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151; font-size: 0.875rem;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr style="border-bottom: 1px solid #e5e7eb; transition: background 0.2s;"
                        onmouseover="this.style.background='#f9fafb'"
                        onmouseout="this.style.background='white'">
                        <td style="padding: 1rem;">
                            <span style="font-weight: 600; color: #3b82f6; font-size: 0.875rem;">
                                #{{ $order->id }}
                            </span>
                        </td>
                        <td style="padding: 1rem; color: #6b7280; font-size: 0.875rem;">
                            <div>{{ $order->created_at->format('d M Y') }}</div>
                            <div style="font-size: 0.75rem; color: #9ca3af;">{{ $order->created_at->format('H:i') }}</div>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">
                                {{ $order->customer->name }}
                            </div>
                            <div style="color: #9ca3af; font-size: 0.75rem;">
                                {{ $order->customer->email }}
                            </div>
                        </td>
                        <td style="padding: 1rem; color: #6b7280; font-size: 0.875rem;">
                            {{ $order->karyawan ? $order->karyawan->name : '-' }}
                        </td>
                        <td style="padding: 1rem;">
                            @if($order->items->count() > 0)
                                <div style="font-size: 0.875rem; color: #1f2937; font-weight: 500;">
                                    {{ $order->items->first()->service->name }}
                                </div>
                                @if($order->items->count() > 1)
                                <div style="font-size: 0.75rem; color: #9ca3af;">
                                    +{{ $order->items->count() - 1 }} layanan lainnya
                                </div>
                                @endif
                            @else
                                <span style="color: #9ca3af; font-size: 0.875rem;">-</span>
                            @endif
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            @php
                                $statusConfig = [
                                    'pending' => ['bg' => '#fef3c7', 'color' => '#92400e', 'text' => 'Pending', 'icon' => '⏰'],
                                    'processing' => ['bg' => '#dbeafe', 'color' => '#1e40af', 'text' => 'Processing', 'icon' => '⏳'],
                                    'completed' => ['bg' => '#d1fae5', 'color' => '#065f46', 'text' => 'Completed', 'icon' => '✅'],
                                    'picked_up' => ['bg' => '#e9d5ff', 'color' => '#6b21a8', 'text' => 'Picked Up', 'icon' => '🎉'],
                                    'cancelled' => ['bg' => '#fee2e2', 'color' => '#991b1b', 'text' => 'Cancelled', 'icon' => '❌'],
                                ];
                                $config = $statusConfig[$order->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'text' => $order->status, 'icon' => ''];
                            @endphp
                            <span style="display: inline-block; padding: 0.375rem 0.875rem; background: {{ $config['bg'] }}; color: {{ $config['color'] }}; border-radius: 9999px; font-weight: 600; font-size: 0.75rem;">
                                {{ $config['icon'] }} {{ $config['text'] }}
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            @if($order->payment_status === 'paid')
                                <span style="display: inline-block; padding: 0.375rem 0.875rem; background: #d1fae5; color: #065f46; border-radius: 9999px; font-weight: 600; font-size: 0.75rem;">
                                    💳 Lunas
                                </span>
                            @else
                                <span style="display: inline-block; padding: 0.375rem 0.875rem; background: #fee2e2; color: #991b1b; border-radius: 9999px; font-weight: 600; font-size: 0.75rem;">
                                    ⏳ Belum Lunas
                                </span>
                            @endif
                        </td>
                        <td style="padding: 1rem; text-align: right;">
                            <div style="font-weight: 700; color: #1f2937; font-size: 0.95rem;">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <a href="{{ route('transaction.byOrder', $order->id) }}" 
                               style="display: inline-block; padding: 0.5rem 1rem; background: #3b82f6; color: white; border-radius: 0.5rem; text-decoration: none; font-size: 0.75rem; font-weight: 500; transition: all 0.3s;"
                               onmouseover="this.style.background='#2563eb'"
                               onmouseout="this.style.background='#3b82f6'"
                               title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="padding: 3rem; text-align: center;">
                            <div style="color: #9ca3af;">
                                <i class="bi bi-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                                <p style="font-size: 1.125rem; font-weight: 500; margin-bottom: 0.5rem;">Tidak ada data pesanan</p>
                                <p style="font-size: 0.875rem;">Silakan ubah filter untuk melihat data lain</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div style="padding: 1.5rem; border-top: 1px solid #e5e7eb;">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .pagination li {
        display: inline-block;
    }
    
    .pagination a,
    .pagination span {
        padding: 0.5rem 0.875rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .pagination a:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
    }
    
    .pagination .active span {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    .pagination .disabled span {
        color: #d1d5db;
        cursor: not-allowed;
    }
</style>
@endsectio