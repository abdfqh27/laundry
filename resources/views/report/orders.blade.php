@extends('layouts.app')

@section('title', 'Laporan Pesanan')

@section('content')
<div style="margin-left: 250px; padding: 2rem; min-height: calc(100vh - 80px); max-width: calc(100vw - 250px); box-sizing: border-box;">
    <!-- Header Section -->
    <div style="margin-bottom: 2rem;">
        <div style="background: linear-gradient(135deg, #1a5f3f 0%, #2d8659 100%); padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1); margin-bottom: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-size: 1.875rem; font-weight: 700; color: white; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                        <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
                        Laporan Pesanan
                    </h1>
                    <p style="color: rgba(255,255,255,0.8); font-size: 0.95rem; margin: 0;">
                        Data lengkap semua pesanan laundry
                    </p>
                </div>
                
                <!-- Export Buttons -->
                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <a href="{{ route('report.orders.pdf', request()->query()) }}" 
                       style="padding: 0.75rem 1.5rem; background: white; color: #dc2626; border-radius: 0.75rem; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)'"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                        <i class="bi bi-file-pdf-fill"></i>
                        PDF
                    </a>
                    
                    <a href="{{ route('report.orders.excel', request()->query()) }}" 
                       style="padding: 0.75rem 1.5rem; background: white; color: #059669; border-radius: 0.75rem; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)'"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                        <i class="bi bi-file-earmark-excel-fill"></i>
                        Excel
                    </a>
                    
                    <a href="{{ route('report.index') }}" 
                       style="padding: 0.75rem 1.5rem; background: rgba(255,255,255,0.2); color: white; border-radius: 0.75rem; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s; border: 1px solid rgba(255,255,255,0.3);"
                       onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                       onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
        <!-- Total Orders -->
        <div style="background: linear-gradient(135deg, #3b82f6, #2563eb); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 5rem; opacity: 0.1;">📦</div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">Total Pesanan</div>
            <div style="font-size: 2.25rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $summary['total_count'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8; display: flex; align-items: center; gap: 0.25rem;">
                <i class="bi bi-check-circle-fill"></i> Semua Status
            </div>
        </div>

        <!-- Total Revenue -->
        <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 5rem; opacity: 0.1;">💰</div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">Total Pendapatan</div>
            <div style="font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem;">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8; display: flex; align-items: center; gap: 0.25rem;">
                <i class="bi bi-wallet2"></i> Pesanan Lunas
            </div>
        </div>

        <!-- Completed Orders -->
        <div style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 5rem; opacity: 0.1;">✅</div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">Selesai</div>
            <div style="font-size: 2.25rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $summary['completed_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8; display: flex; align-items: center; gap: 0.25rem;">
                <i class="bi bi-check-circle-fill"></i> Completed
            </div>
        </div>

        <!-- Processing Orders -->
        <div style="background: linear-gradient(135deg, #f59e0b, #d97706); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 5rem; opacity: 0.1;">⏳</div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">Proses</div>
            <div style="font-size: 2.25rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $summary['processing_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8; display: flex; align-items: center; gap: 0.25rem;">
                <i class="bi bi-arrow-repeat"></i> Processing
            </div>
        </div>
    </div>

    <!-- Additional Summary Cards Row 2 -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
        <!-- Pending Orders -->
        <div style="background: linear-gradient(135deg, #f97316, #ea580c); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 5rem; opacity: 0.1;">⏰</div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">Pending</div>
            <div style="font-size: 2.25rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $summary['pending_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8; display: flex; align-items: center; gap: 0.25rem;">
                <i class="bi bi-hourglass-split"></i> Menunggu
            </div>
        </div>

        <!-- Picked Up Orders -->
        <div style="background: linear-gradient(135deg, #06b6d4, #0891b2); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 5rem; opacity: 0.1;">🎉</div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">Diambil</div>
            <div style="font-size: 2.25rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $summary['picked_up_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8; display: flex; align-items: center; gap: 0.25rem;">
                <i class="bi bi-bag-check-fill"></i> Picked Up
            </div>
        </div>

        <!-- Cancelled Orders -->
        <div style="background: linear-gradient(135deg, #ef4444, #dc2626); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 5rem; opacity: 0.1;">❌</div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">Dibatalkan</div>
            <div style="font-size: 2.25rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $summary['cancelled_orders'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8; display: flex; align-items: center; gap: 0.25rem;">
                <i class="bi bi-x-circle-fill"></i> Cancelled
            </div>
        </div>

        <!-- Payment Status - Paid -->
        <div style="background: linear-gradient(135deg, #14b8a6, #0d9488); padding: 1.5rem; border-radius: 1rem; color: white; box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 5rem; opacity: 0.1;">💳</div>
            <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">Lunas</div>
            <div style="font-size: 2.25rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $summary['paid_count'] }}</div>
            <div style="font-size: 0.75rem; opacity: 0.8; display: flex; align-items: center; gap: 0.25rem;">
                <i class="bi bi-credit-card-fill"></i> Pembayaran Lunas
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 1.5rem;">
        <h5 style="font-size: 1.125rem; font-weight: 700; color: #1f2937; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="bi bi-funnel-fill" style="color: #16a34a;"></i>
            Filter Data
        </h5>
        <form method="GET" action="{{ route('report.orders') }}">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                <!-- Start Date -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                        <i class="bi bi-calendar-event" style="color: #16a34a;"></i> Dari Tanggal
                    </label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                           style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s;"
                           onfocus="this.style.borderColor='#16a34a'"
                           onblur="this.style.borderColor='#e5e7eb'">
                </div>

                <!-- End Date -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                        <i class="bi bi-calendar-check" style="color: #16a34a;"></i> Sampai Tanggal
                    </label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s;"
                           onfocus="this.style.borderColor='#16a34a'"
                           onblur="this.style.borderColor='#e5e7eb'">
                </div>

                <!-- Status -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                        <i class="bi bi-list-check" style="color: #16a34a;"></i> Status Pesanan
                    </label>
                    <select name="status"
                            style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s;"
                            onfocus="this.style.borderColor='#16a34a'"
                            onblur="this.style.borderColor='#e5e7eb'">
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
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                        <i class="bi bi-credit-card" style="color: #16a34a;"></i> Status Pembayaran
                    </label>
                    <select name="payment_status"
                            style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s;"
                            onfocus="this.style.borderColor='#16a34a'"
                            onblur="this.style.borderColor='#e5e7eb'">
                        <option value="">Semua Status</option>
                        <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <!-- Customer -->
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                        <i class="bi bi-person" style="color: #16a34a;"></i> Pelanggan
                    </label>
                    <select name="customer_id"
                            style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s;"
                            onfocus="this.style.borderColor='#16a34a'"
                            onblur="this.style.borderColor='#e5e7eb'">
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
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                        <i class="bi bi-person-badge" style="color: #16a34a;"></i> Karyawan
                    </label>
                    <select name="karyawan_id"
                            style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s;"
                            onfocus="this.style.borderColor='#16a34a'"
                            onblur="this.style.borderColor='#e5e7eb'">
                        <option value="">Semua Karyawan</option>
                        @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" {{ request('karyawan_id') == $karyawan->id ? 'selected' : '' }}>
                            {{ $karyawan->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <button type="submit"
                        style="padding: 0.75rem 1.75rem; background: linear-gradient(135deg, #16a34a, #059669); color: white; border: none; border-radius: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s; box-shadow: 0 2px 8px rgba(22, 163, 74, 0.3);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(22, 163, 74, 0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(22, 163, 74, 0.3)'">
                    <i class="bi bi-funnel-fill"></i>
                    Terapkan Filter
                </button>

                @if(request()->hasAny(['start_date', 'end_date', 'status', 'payment_status', 'customer_id', 'karyawan_id']))
                <a href="{{ route('report.orders') }}"
                   style="padding: 0.75rem 1.75rem; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 0.75rem; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.4)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(239, 68, 68, 0.3)'">
                    <i class="bi bi-x-circle-fill"></i>
                    Reset Filter
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div style="background: white; border-radius: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow: hidden;">
        <div style="padding: 1.5rem; border-bottom: 2px solid #f3f4f6;">
            <h5 style="font-size: 1.125rem; font-weight: 700; color: #1f2937; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                <i class="bi bi-table" style="color: #16a34a;"></i>
                Data Pesanan
            </h5>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: linear-gradient(135deg, #f9fafb, #f3f4f6);">
                    <tr>
                        <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Order ID</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Tanggal</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Pelanggan</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Karyawan</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Layanan</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Status</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Pembayaran</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Total</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 700; color: #1f2937; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr style="border-bottom: 1px solid #f3f4f6; transition: all 0.2s;"
                        onmouseover="this.style.background='#f9fafb'"
                        onmouseout="this.style.background='white'">
                        <td style="padding: 1rem;">
                            <span style="font-weight: 700; color: #16a34a; font-size: 0.875rem; background: rgba(22, 163, 74, 0.1); padding: 0.375rem 0.75rem; border-radius: 0.5rem;">
                                #{{ $order->id }}
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">{{ $order->created_at->format('d M Y') }}</div>
                            <div style="font-size: 0.75rem; color: #9ca3af;">{{ $order->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">
                                {{ $order->customer->name }}
                            </div>
                            <div style="color: #9ca3af; font-size: 0.75rem;">
                                {{ $order->customer->email }}
                            </div>
                        </td>
                        <td style="padding: 1rem; color: #6b7280; font-size: 0.875rem; font-weight: 500;">
                            {{ $order->karyawan ? $order->karyawan->name : '-' }}
                        </td>
                        <td style="padding: 1rem;">
                            @if($order->items->count() > 0)
                                <div style="font-size: 0.875rem; color: #1f2937; font-weight: 600;">
                                    {{ $order->items->first()->service->name }}
                                </div>
                                @if($order->items->count() > 1)
                                <div style="font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem;">
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
                            <span style="display: inline-block; padding: 0.5rem 1rem; background: {{ $config['bg'] }}; color: {{ $config['color'] }}; border-radius: 9999px; font-weight: 700; font-size: 0.75rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                {{ $config['icon'] }} {{ $config['text'] }}
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            @if($order->payment_status === 'paid')
                                <span style="display: inline-block; padding: 0.5rem 1rem; background: #d1fae5; color: #065f46; border-radius: 9999px; font-weight: 700; font-size: 0.75rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    💳 Lunas
                                </span>
                            @else
                                <span style="display: inline-block; padding: 0.5rem 1rem; background: #fee2e2; color: #991b1b; border-radius: 9999px; font-weight: 700; font-size: 0.75rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    ⏳ Belum Lunas
                                </span>
                            @endif
                        </td>
                        <td style="padding: 1rem; text-align: right;">
                            <div style="font-weight: 700; color: #059669; font-size: 1rem; background: rgba(5, 150, 105, 0.1); padding: 0.5rem 0.75rem; border-radius: 0.5rem; display: inline-block;">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <a href="{{ route('transaction.byOrder', $order->id) }}" 
                               style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: linear-gradient(135deg, #16a34a, #059669); color: white; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 600; transition: all 0.3s; box-shadow: 0 2px 6px rgba(22, 163, 74, 0.3);"
                               onmouseover="this.style.transform='translateY(-2px) scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(22, 163, 74, 0.4)'"
                               onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 2px 6px rgba(22, 163, 74, 0.3)'"
                               title="Lihat Detail">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="padding: 4rem 2rem; text-align: center;">
                            <div style="color: #9ca3af;">
                                <div style="background: #f3f4f6; width: 120px; height: 120px; border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-inbox" style="font-size: 4rem; color: #d1d5db;"></i>
                                </div>
                                <p style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #6b7280;">Tidak ada data pesanan</p>
                                <p style="font-size: 0.875rem; color: #9ca3af;">Silakan ubah filter untuk melihat data lain</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div style="padding: 1.5rem; border-top: 2px solid #f3f4f6; background: #f9fafb;">
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
        padding: 0.625rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        color: #374151;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .pagination a:hover {
        background: #16a34a;
        color: white;
        border-color: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(22, 163, 74, 0.3);
    }
    
    .pagination .active span {
        background: linear-gradient(135deg, #16a34a, #059669);
        color: white;
        border-color: #16a34a;
        box-shadow: 0 2px 8px rgba(22, 163, 74, 0.3);
    }
    
    .pagination .disabled span {
        color: #d1d5db;
        cursor: not-allowed;
        border-color: #f3f4f6;
        background: #f9fafb;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        div[style*="margin-left: 250px"] {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 1.5rem !important;
        }
    }

    @media (max-width: 768px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }

        table {
            font-size: 0.75rem;
        }

        th, td {
            padding: 0.75rem !important;
        }
    }
</style>
@endsection