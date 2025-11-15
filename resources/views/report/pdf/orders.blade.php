<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Orders</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #2563eb;
        }

        .header h1 {
            font-size: 20px;
            color: #1e40af;
            margin-bottom: 5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header .subtitle {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .header .date-info {
            font-size: 9px;
            color: #475569;
            background: #f1f5f9;
            padding: 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 5px;
        }

        .filters {
            background: #f8fafc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border-left: 4px solid #3b82f6;
        }

        .filters h3 {
            font-size: 11px;
            color: #1e40af;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .filters .filter-item {
            display: inline-block;
            margin-right: 15px;
            margin-bottom: 4px;
            font-size: 9px;
        }

        .filters .filter-label {
            font-weight: bold;
            color: #475569;
        }

        .filters .filter-value {
            color: #0f172a;
            background: white;
            padding: 2px 6px;
            border-radius: 3px;
        }

        .summary {
            margin-bottom: 20px;
        }

        .summary h3 {
            font-size: 12px;
            color: #1e40af;
            margin-bottom: 10px;
            font-weight: bold;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .summary-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .summary-row {
            display: table-row;
        }

        .summary-col {
            display: table-cell;
            width: 25%;
            padding: 8px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .summary-col .label {
            font-size: 8px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 3px;
            font-weight: 600;
        }

        .summary-col .value {
            font-size: 13px;
            color: #0f172a;
            font-weight: bold;
        }

        .summary-col.highlight {
            background: #dbeafe;
            border-color: #3b82f6;
        }

        .summary-col.highlight .value {
            color: #1e40af;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table thead {
            background: #1e40af;
            color: white;
        }

        table thead th {
            padding: 8px 5px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            border-right: 1px solid #3b82f6;
        }

        table thead th:last-child {
            border-right: none;
        }

        table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        table tbody tr:hover {
            background: #f1f5f9;
        }

        table tbody td {
            padding: 7px 5px;
            font-size: 9px;
            color: #334155;
        }

        .badge {
            display: inline-block;
            padding: 3px 7px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-processing {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-completed {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-picked-up {
            background: #e0e7ff;
            color: #3730a3;
        }

        .badge-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-unpaid {
            background: #fee2e2;
            color: #991b1b;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .order-details {
            font-size: 8px;
            color: #64748b;
            margin-top: 3px;
        }

        .footer {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            font-size: 8px;
            color: #64748b;
        }

        .footer .generated {
            margin-bottom: 5px;
            font-weight: bold;
            color: #475569;
        }

        .page-break {
            page-break-after: always;
        }

        .no-data {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 11px;
            background: #f8fafc;
            border-radius: 5px;
            border: 2px dashed #cbd5e1;
        }

        .amount {
            font-weight: bold;
            color: #059669;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Laporan Orders</h1>
        <div class="subtitle">Sistem Manajemen Laundry</div>
        <div class="date-info">
            <strong>Periode:</strong> 
            @if(isset($filters['start_date']) || isset($filters['end_date']))
                {{ isset($filters['start_date']) ? \Carbon\Carbon::parse($filters['start_date'])->format('d/m/Y') : 'Awal' }}
                s/d
                {{ isset($filters['end_date']) ? \Carbon\Carbon::parse($filters['end_date'])->format('d/m/Y') : 'Akhir' }}
            @else
                Semua Periode
            @endif
        </div>
    </div>

    <!-- Filters Applied -->
    @if(!empty($filters))
    <div class="filters">
        <h3>🔍 Filter yang Diterapkan:</h3>
        @if(isset($filters['status']))
            <div class="filter-item">
                <span class="filter-label">Status:</span>
                <span class="filter-value">{{ ucfirst($filters['status']) }}</span>
            </div>
        @endif
        @if(isset($filters['payment_status']))
            <div class="filter-item">
                <span class="filter-label">Status Pembayaran:</span>
                <span class="filter-value">{{ ucfirst($filters['payment_status']) }}</span>
            </div>
        @endif
        @if(isset($filters['customer_id']))
            <div class="filter-item">
                <span class="filter-label">Customer ID:</span>
                <span class="filter-value">#{{ $filters['customer_id'] }}</span>
            </div>
        @endif
        @if(isset($filters['karyawan_id']))
            <div class="filter-item">
                <span class="filter-label">Karyawan ID:</span>
                <span class="filter-value">#{{ $filters['karyawan_id'] }}</span>
            </div>
        @endif
    </div>
    @endif

    <!-- Summary Statistics -->
    <div class="summary">
        <h3>Ringkasan Data</h3>
        <div class="summary-grid">
            <div class="summary-row">
                <div class="summary-col highlight">
                    <div class="label">Total Orders</div>
                    <div class="value">{{ number_format($summary['total_count']) }}</div>
                </div>
                <div class="summary-col highlight">
                    <div class="label">Total Pendapatan</div>
                    <div class="value">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</div>
                </div>
                <div class="summary-col">
                    <div class="label">Pending</div>
                    <div class="value">{{ number_format($summary['pending_orders']) }}</div>
                </div>
                <div class="summary-col">
                    <div class="label">Processing</div>
                    <div class="value">{{ number_format($summary['processing_orders']) }}</div>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-col">
                    <div class="label">Completed</div>
                    <div class="value">{{ number_format($summary['completed_orders']) }}</div>
                </div>
                <div class="summary-col">
                    <div class="label">Picked Up</div>
                    <div class="value">{{ number_format($summary['picked_up_orders']) }}</div>
                </div>
                <div class="summary-col">
                    <div class="label">Cancelled</div>
                    <div class="value">{{ number_format($summary['cancelled_orders']) }}</div>
                </div>
                <div class="summary-col">
                    <div class="label">Unpaid / Paid</div>
                    <div class="value">{{ number_format($summary['unpaid_count']) }} / {{ number_format($summary['paid_count']) }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    @if($orders->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 8%;">No. Order</th>
                <th style="width: 15%;">Customer</th>
                <th style="width: 13%;">Karyawan</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 12%;">Status</th>
                <th style="width: 12%;">Pembayaran</th>
                <th style="width: 8%;" class="text-center">Items</th>
                <th style="width: 13%;" class="text-right">Total</th>
                <th style="width: 7%;" class="text-center">Metode</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td><strong>#{{ $order->order_number }}</strong></td>
                <td>
                    {{ $order->customer->name ?? 'N/A' }}
                    @if($order->customer)
                    <div class="order-details">{{ $order->customer->phone ?? '-' }}</div>
                    @endif
                </td>
                <td>{{ $order->karyawan->name ?? 'N/A' }}</td>
                <td>
                    {{ $order->created_at->format('d/m/Y') }}
                    <div class="order-details">{{ $order->created_at->format('H:i') }}</div>
                </td>
                <td>
                    @if($order->status == 'pending')
                        <span class="badge badge-pending">Pending</span>
                    @elseif($order->status == 'processing')
                        <span class="badge badge-processing">Processing</span>
                    @elseif($order->status == 'completed')
                        <span class="badge badge-completed">Completed</span>
                    @elseif($order->status == 'picked_up')
                        <span class="badge badge-picked-up">Picked Up</span>
                    @elseif($order->status == 'cancelled')
                        <span class="badge badge-cancelled">Cancelled</span>
                    @endif
                </td>
                <td>
                    @if($order->payment_status == 'paid')
                        <span class="badge badge-paid">Paid</span>
                    @else
                        <span class="badge badge-unpaid">Unpaid</span>
                    @endif
                </td>
                <td class="text-center">
                    <strong>{{ $order->items->count() }}</strong>
                    <div class="order-details">
                        {{ $order->items->sum('quantity') }} item
                    </div>
                </td>
                <td class="text-right">
                    <span class="amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </td>
                <td class="text-center">
                    @if($order->transaction)
                        {{ strtoupper($order->transaction->payment_method) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        <strong>📭 Tidak ada data order yang ditemukan</strong>
        <div style="margin-top: 5px;">Silakan ubah filter atau periode tanggal untuk melihat data.</div>
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <div class="generated">
            Laporan digenerate pada: {{ now()->format('d F Y, H:i:s') }} WIB
        </div>
        <div>
            © {{ date('Y') }} Sistem Manajemen Laundry - Laporan Orders
        </div>
    </div>
</body>
</html>