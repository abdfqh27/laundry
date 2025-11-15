<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Hejo Laundry</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            line-height: 1.6;
        }

        .container {
            padding: 20px;
        }

        /* Header */
        .header {
            border-bottom: 3px solid #16a34a;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .company-info {
            display: table;
            width: 100%;
        }

        .company-logo {
            display: table-cell;
            width: 70%;
            vertical-align: top;
        }

        .company-logo h1 {
            font-size: 24px;
            color: #16a34a;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .company-logo p {
            color: #666;
            margin: 2px 0;
            font-size: 10px;
        }

        .report-info {
            display: table-cell;
            width: 30%;
            text-align: right;
            vertical-align: top;
        }

        .report-info h2 {
            font-size: 16px;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .report-info p {
            color: #666;
            margin: 2px 0;
            font-size: 10px;
        }

        /* Filter Info */
        .filter-section {
            background: #f0fdf4;
            border: 1px solid #16a34a;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
        }

        .filter-section h3 {
            font-size: 12px;
            color: #16a34a;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .filter-grid {
            display: table;
            width: 100%;
        }

        .filter-item {
            display: table-cell;
            width: 25%;
            padding-right: 10px;
        }

        .filter-item label {
            font-weight: bold;
            color: #333;
            display: block;
            font-size: 9px;
            margin-bottom: 2px;
        }

        .filter-item span {
            color: #666;
            font-size: 10px;
        }

        /* Summary Cards */
        .summary-section {
            margin-bottom: 25px;
        }

        .summary-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .summary-card {
            display: table-cell;
            width: 25%;
            padding: 12px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            text-align: center;
        }

        .summary-card:first-child {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .summary-card:last-child {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .summary-card.green {
            background: #f0fdf4;
            border-color: #16a34a;
        }

        .summary-card.blue {
            background: #eff6ff;
            border-color: #3b82f6;
        }

        .summary-card.orange {
            background: #fff7ed;
            border-color: #f97316;
        }

        .summary-card.purple {
            background: #faf5ff;
            border-color: #a855f7;
        }

        .summary-card h4 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .summary-card.green h4 { color: #16a34a; }
        .summary-card.blue h4 { color: #3b82f6; }
        .summary-card.orange h4 { color: #f97316; }
        .summary-card.purple h4 { color: #a855f7; }

        .summary-card p {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Payment Method Breakdown */
        .payment-breakdown {
            margin-bottom: 25px;
        }

        .payment-breakdown h3 {
            font-size: 13px;
            color: #1a1a1a;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .payment-grid {
            display: table;
            width: 100%;
        }

        .payment-item {
            display: table-cell;
            width: 33.33%;
            padding: 10px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            text-align: center;
        }

        .payment-item:first-child {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
            background: #f0fdf4;
            border-color: #16a34a;
        }

        .payment-item:nth-child(2) {
            background: #eff6ff;
            border-color: #3b82f6;
        }

        .payment-item:last-child {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
            background: #faf5ff;
            border-color: #a855f7;
        }

        .payment-item h4 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .payment-item:first-child h4 { color: #16a34a; }
        .payment-item:nth-child(2) h4 { color: #3b82f6; }
        .payment-item:last-child h4 { color: #a855f7; }

        .payment-item p {
            font-size: 9px;
            color: #666;
        }

        /* Table */
        .table-section h3 {
            font-size: 13px;
            color: #1a1a1a;
            margin-bottom: 10px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background: #16a34a;
            color: white;
        }

        thead th {
            padding: 10px 8px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        tbody tr:hover {
            background: #f0fdf4;
        }

        tbody td {
            padding: 10px 8px;
            font-size: 10px;
            color: #333;
        }

        /* Badges */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }

        .badge-pending {
            background: #fff7ed;
            color: #f97316;
            border: 1px solid #f97316;
        }

        .badge-confirmed {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #16a34a;
        }

        .badge-rejected {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #ef4444;
        }

        .badge-cash {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #16a34a;
        }

        .badge-transfer {
            background: #eff6ff;
            color: #3b82f6;
            border: 1px solid #3b82f6;
        }

        .badge-qris {
            background: #faf5ff;
            color: #a855f7;
            border: 1px solid #a855f7;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
        }

        .footer p {
            color: #666;
            font-size: 9px;
            margin: 3px 0;
        }

        .footer .generated-at {
            color: #999;
            font-style: italic;
        }

        /* Amount Highlight */
        .amount {
            font-weight: bold;
            color: #16a34a;
        }

        /* Text Helpers */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-muted { color: #666; }
        .font-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <div class="company-logo">
                    <h1>🧺 HEJO LAUNDRY</h1>
                    <p>Jl. Laundry No. 123, Kota Anda</p>
                    <p>Telp: (021) 1234-5678 | Email: info@hejolaundry.com</p>
                </div>
                <div class="report-info">
                    <h2>LAPORAN TRANSAKSI</h2>
                    <p>Tanggal Cetak: {{ date('d F Y') }}</p>
                    <p>Waktu: {{ date('H:i:s') }} WIB</p>
                </div>
            </div>
        </div>

        <!-- Filter Info -->
        @if(!empty($filters))
        <div class="filter-section">
            <h3>📋 Filter yang Diterapkan</h3>
            <div class="filter-grid">
                @if(isset($filters['start_date']) && $filters['start_date'])
                <div class="filter-item">
                    <label>Tanggal Mulai:</label>
                    <span>{{ \Carbon\Carbon::parse($filters['start_date'])->format('d M Y') }}</span>
                </div>
                @endif

                @if(isset($filters['end_date']) && $filters['end_date'])
                <div class="filter-item">
                    <label>Tanggal Akhir:</label>
                    <span>{{ \Carbon\Carbon::parse($filters['end_date'])->format('d M Y') }}</span>
                </div>
                @endif

                @if(isset($filters['status']) && $filters['status'])
                <div class="filter-item">
                    <label>Status:</label>
                    <span>{{ ucfirst($filters['status']) }}</span>
                </div>
                @endif

                @if(isset($filters['payment_method']) && $filters['payment_method'])
                <div class="filter-item">
                    <label>Metode Pembayaran:</label>
                    <span>{{ ucfirst($filters['payment_method']) }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Summary Statistics -->
        <div class="summary-section">
            <div class="summary-grid">
                <div class="summary-card green">
                    <h4>{{ $summary['total_count'] }}</h4>
                    <p>Total Transaksi</p>
                </div>
                <div class="summary-card blue">
                    <h4>Rp {{ number_format($summary['total_amount'], 0, ',', '.') }}</h4>
                    <p>Total Pendapatan</p>
                </div>
                <div class="summary-card orange">
                    <h4>{{ $transactions->where('status', 'pending')->count() }}</h4>
                    <p>Pending</p>
                </div>
                <div class="summary-card purple">
                    <h4>{{ $transactions->where('status', 'confirmed')->count() }}</h4>
                    <p>Confirmed</p>
                </div>
            </div>
        </div>

        <!-- Payment Method Breakdown -->
        <div class="payment-breakdown">
            <h3>💳 Breakdown Metode Pembayaran</h3>
            <div class="payment-grid">
                <div class="payment-item">
                    <h4>Rp {{ number_format($summary['cash_amount'], 0, ',', '.') }}</h4>
                    <p>Cash</p>
                </div>
                <div class="payment-item">
                    <h4>Rp {{ number_format($summary['transfer_amount'], 0, ',', '.') }}</h4>
                    <p>Transfer Bank</p>
                </div>
                <div class="payment-item">
                    <h4>Rp {{ number_format($summary['qris_amount'], 0, ',', '.') }}</h4>
                    <p>QRIS</p>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="table-section">
            <h3>📊 Detail Transaksi</h3>
            <table>
                <thead>
                    <tr>
                        <th width="8%">ID</th>
                        <th width="10%">Order ID</th>
                        <th width="20%">Customer</th>
                        <th width="15%">Jumlah</th>
                        <th width="12%">Metode</th>
                        <th width="12%">Status</th>
                        <th width="15%">Tanggal</th>
                        <th width="18%">Dikonfirmasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr>
                        <td class="text-center">#{{ $transaction->id }}</td>
                        <td class="text-center">#{{ $transaction->order_id }}</td>
                        <td>{{ $transaction->order->customer->name ?? 'N/A' }}</td>
                        <td class="amount">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                        <td>
                            @if($transaction->payment_method == 'cash')
                                <span class="badge badge-cash">💵 Cash</span>
                            @elseif($transaction->payment_method == 'transfer')
                                <span class="badge badge-transfer">🏦 Transfer</span>
                            @else
                                <span class="badge badge-qris">📱 QRIS</span>
                            @endif
                        </td>
                        <td>
                            @if($transaction->status == 'pending')
                                <span class="badge badge-pending">⏳ Pending</span>
                            @elseif($transaction->status == 'confirmed')
                                <span class="badge badge-confirmed">✓ Confirmed</span>
                            @else
                                <span class="badge badge-rejected">✗ Rejected</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-muted">
                            @if($transaction->confirmed_by)
                                {{ $transaction->confirmedBy->name }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 30px;">
                            Tidak ada data transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="font-bold">Hejo Laundry - Laporan Transaksi</p>
            <p class="generated-at">Dokumen ini digenerate secara otomatis pada {{ date('d F Y, H:i:s') }} WIB</p>
            <p style="margin-top: 10px; color: #16a34a; font-weight: bold;">Terima kasih atas kepercayaan Anda 🌿</p>
        </div>
    </div>
</body>
</html>