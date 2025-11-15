<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan - Hejo Laundry</title>
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

        /* Period Info */
        .period-section {
            background: #f0fdf4;
            border: 2px solid #16a34a;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .period-section h3 {
            font-size: 13px;
            color: #16a34a;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .period-section p {
            font-size: 12px;
            color: #333;
            margin: 0;
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
            padding: 15px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            text-align: center;
        }

        .summary-card:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            background: #f0fdf4;
            border-color: #16a34a;
        }

        .summary-card:nth-child(2) {
            background: #eff6ff;
            border-color: #3b82f6;
        }

        .summary-card:nth-child(3) {
            background: #faf5ff;
            border-color: #a855f7;
        }

        .summary-card:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            background: #fff7ed;
            border-color: #f97316;
        }

        .summary-card h4 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .summary-card:first-child h4 { color: #16a34a; }
        .summary-card:nth-child(2) h4 { color: #3b82f6; }
        .summary-card:nth-child(3) h4 { color: #a855f7; }
        .summary-card:last-child h4 { color: #f97316; }

        .summary-card p {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }

        /* Payment Method Breakdown */
        .payment-breakdown {
            margin-bottom: 25px;
        }

        .payment-breakdown h3 {
            font-size: 13px;
            color: #1a1a1a;
            margin-bottom: 12px;
            font-weight: bold;
            border-bottom: 2px solid #16a34a;
            padding-bottom: 5px;
        }

        .payment-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .payment-item {
            display: table-cell;
            width: 33.33%;
            padding: 12px;
            text-align: center;
            border: 1px solid #e5e7eb;
        }

        .payment-item:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            background: #f0fdf4;
            border-color: #16a34a;
        }

        .payment-item:nth-child(2) {
            background: #eff6ff;
            border-color: #3b82f6;
        }

        .payment-item:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
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
            margin: 3px 0;
        }

        .payment-item .percentage {
            font-size: 10px;
            font-weight: bold;
            color: #333;
        }

        /* Table */
        .table-section {
            margin-bottom: 20px;
        }

        .table-section h3 {
            font-size: 13px;
            color: #1a1a1a;
            margin-bottom: 10px;
            font-weight: bold;
            border-bottom: 2px solid #16a34a;
            padding-bottom: 5px;
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

        tbody td {
            padding: 10px 8px;
            font-size: 10px;
            color: #333;
        }

        tfoot {
            background: #f0fdf4;
            border-top: 2px solid #16a34a;
        }

        tfoot td {
            padding: 12px 8px;
            font-size: 10px;
            font-weight: bold;
            color: #16a34a;
        }

        /* Highlight */
        .highlight-green {
            color: #16a34a;
            font-weight: bold;
        }

        .highlight-blue {
            color: #3b82f6;
            font-weight: bold;
        }

        .highlight-purple {
            color: #a855f7;
            font-weight: bold;
        }

        /* Badge */
        .badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }

        .badge-info {
            background: #eff6ff;
            color: #3b82f6;
            border: 1px solid #3b82f6;
        }

        /* Progress Bar */
        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            margin: 3px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #16a34a 0%, #22c55e 100%);
            border-radius: 3px;
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

        /* Text Helpers */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-muted { color: #666; }
        .font-bold { font-weight: bold; }

        /* Statistics Box */
        .stats-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .stats-box h4 {
            font-size: 11px;
            color: #333;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .stats-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }

        .stats-label {
            display: table-cell;
            width: 60%;
            font-size: 9px;
            color: #666;
        }

        .stats-value {
            display: table-cell;
            width: 40%;
            text-align: right;
            font-size: 10px;
            font-weight: bold;
            color: #16a34a;
        }
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
                    <h2>LAPORAN PENDAPATAN</h2>
                    <p>Tanggal Cetak: {{ date('d F Y') }}</p>
                    <p>Waktu: {{ date('H:i:s') }} WIB</p>
                </div>
            </div>
        </div>

        <!-- Period Info -->
        @php
            $totalDaysInPeriod = $startDate->copy()->startOfDay()->diffInDays($endDate->copy()->endOfDay()) + 1;
        @endphp
        <div class="period-section">
            <h3>📅 PERIODE LAPORAN</h3>
            <p>{{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
            <p style="font-size: 9px; color: #666; margin-top: 3px;">
                ({{ $totalDaysInPeriod }} hari)
            </p>
        </div>

        <!-- Summary Statistics -->
        <div class="summary-section">
            <div class="summary-grid">
                <div class="summary-card">
                    <h4>Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</h4>
                    <p>Total Pendapatan</p>
                </div>
                <div class="summary-card">
                    <h4>{{ number_format($summary['total_transactions']) }}</h4>
                    <p>Total Transaksi</p>
                </div>
                <div class="summary-card">
                    <h4>Rp {{ number_format($summary['average_transaction'], 0, ',', '.') }}</h4>
                    <p>Rata-rata/Transaksi</p>
                </div>
                <div class="summary-card">
                    <h4>{{ $dailyRevenue->count() }}</h4>
                    <p>Hari Operasional</p>
                </div>
            </div>
        </div>

        <!-- Payment Method Breakdown -->
        <div class="payment-breakdown">
            <h3>💳 Breakdown Metode Pembayaran</h3>
            <div class="payment-grid">
                <div class="payment-item">
                    <h4>Rp {{ number_format($summary['by_payment_method']['cash'], 0, ',', '.') }}</h4>
                    <p>💵 Cash</p>
                    <p class="percentage">
                        {{ $summary['total_revenue'] > 0 ? number_format(($summary['by_payment_method']['cash'] / $summary['total_revenue']) * 100, 1) : 0 }}%
                    </p>
                </div>
                <div class="payment-item">
                    <h4>Rp {{ number_format($summary['by_payment_method']['transfer'], 0, ',', '.') }}</h4>
                    <p>🏦 Transfer Bank</p>
                    <p class="percentage">
                        {{ $summary['total_revenue'] > 0 ? number_format(($summary['by_payment_method']['transfer'] / $summary['total_revenue']) * 100, 1) : 0 }}%
                    </p>
                </div>
                <div class="payment-item">
                    <h4>Rp {{ number_format($summary['by_payment_method']['qris'], 0, ',', '.') }}</h4>
                    <p>📱 QRIS</p>
                    <p class="percentage">
                        {{ $summary['total_revenue'] > 0 ? number_format(($summary['by_payment_method']['qris'] / $summary['total_revenue']) * 100, 1) : 0 }}%
                    </p>
                </div>
            </div>
        </div>

        <!-- Daily Revenue Statistics -->
        @if($dailyRevenue->count() > 0)
        <div class="stats-box">
            <h4>📊 Statistik Harian</h4>
            <div class="stats-row">
                <div class="stats-label">Pendapatan Tertinggi per Hari:</div>
                <div class="stats-value">Rp {{ number_format($dailyRevenue->max('total'), 0, ',', '.') }}</div>
            </div>
            <div class="stats-row">
                <div class="stats-label">Pendapatan Terendah per Hari:</div>
                <div class="stats-value">Rp {{ number_format($dailyRevenue->min('total'), 0, ',', '.') }}</div>
            </div>
            <div class="stats-row">
                <div class="stats-label">Rata-rata Pendapatan per Hari:</div>
                <div class="stats-value">Rp {{ number_format($dailyRevenue->avg('total'), 0, ',', '.') }}</div>
            </div>
        </div>
        @endif

        <!-- Daily Revenue Table -->
        <div class="table-section">
            <h3>📅 Rincian Pendapatan Harian</h3>
            <table>
                <thead>
                    <tr>
                        <th width="15%">Tanggal</th>
                        <th width="10%" class="text-center">Transaksi</th>
                        <th width="15%" class="text-right">Total</th>
                        <th width="13%" class="text-right">Cash</th>
                        <th width="13%" class="text-right">Transfer</th>
                        <th width="13%" class="text-right">QRIS</th>
                        <th width="13%" class="text-right">Rata-rata</th>
                        <th width="8%" class="text-center">%</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $maxRevenue = $dailyRevenue->max('total');
                    @endphp
                    @forelse($dailyRevenue as $date => $revenue)
                    <tr>
                        <td>
                            <strong class="highlight-green">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</strong>
                            <div style="font-size: 8px; color: #666;">{{ \Carbon\Carbon::parse($date)->isoFormat('dddd') }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-info">{{ number_format($revenue['count']) }}</span>
                        </td>
                        <td class="text-right highlight-green">
                            Rp {{ number_format($revenue['total'], 0, ',', '.') }}
                        </td>
                        <td class="text-right">
                            Rp {{ number_format($revenue['cash'], 0, ',', '.') }}
                        </td>
                        <td class="text-right highlight-blue">
                            Rp {{ number_format($revenue['transfer'], 0, ',', '.') }}
                        </td>
                        <td class="text-right highlight-purple">
                            Rp {{ number_format($revenue['qris'], 0, ',', '.') }}
                        </td>
                        <td class="text-right text-muted">
                            Rp {{ number_format($revenue['count'] > 0 ? $revenue['total'] / $revenue['count'] : 0, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            @php
                                $percentage = $maxRevenue > 0 ? ($revenue['total'] / $maxRevenue) * 100 : 0;
                            @endphp
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $percentage }}%;"></div>
                            </div>
                            <div style="font-size: 7px; color: #16a34a; margin-top: 2px;">
                                {{ number_format($percentage, 0) }}%
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 30px;">
                            Tidak ada data pendapatan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>TOTAL</strong></td>
                        <td class="text-center">
                            <strong>{{ number_format($summary['total_transactions']) }}</strong>
                        </td>
                        <td class="text-right" style="font-size: 11px;">
                            <strong>Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</strong>
                        </td>
                        <td class="text-right">
                            <strong>Rp {{ number_format($summary['by_payment_method']['cash'], 0, ',', '.') }}</strong>
                        </td>
                        <td class="text-right">
                            <strong>Rp {{ number_format($summary['by_payment_method']['transfer'], 0, ',', '.') }}</strong>
                        </td>
                        <td class="text-right">
                            <strong>Rp {{ number_format($summary['by_payment_method']['qris'], 0, ',', '.') }}</strong>
                        </td>
                        <td class="text-right">
                            <strong>Rp {{ number_format($summary['average_transaction'], 0, ',', '.') }}</strong>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Summary Insights -->
        @php
            $totalDaysInPeriod = $startDate->copy()->startOfDay()->diffInDays($endDate->copy()->endOfDay()) + 1;
            $operationalDays = $dailyRevenue->count();
            $operationalRate = $totalDaysInPeriod > 0 ? ($operationalDays / $totalDaysInPeriod) * 100 : 0;
        @endphp
        <div class="stats-box">
            <h4>💡 Ringkasan Analisis</h4>
            <div class="stats-row">
                <div class="stats-label">Total Hari dalam Periode:</div>
                <div class="stats-value" style="color: #333;">{{ $totalDaysInPeriod }} hari</div>
            </div>
            <div class="stats-row">
                <div class="stats-label">Hari dengan Transaksi:</div>
                <div class="stats-value" style="color: #333;">{{ $operationalDays }} hari</div>
            </div>
            <div class="stats-row">
                <div class="stats-label">Tingkat Operasional:</div>
                <div class="stats-value" style="color: #333;">
                    {{ number_format($operationalRate, 1) }}%
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="font-bold">Hejo Laundry - Laporan Pendapatan</p>
            <p class="generated-at">Dokumen ini digenerate secara otomatis pada {{ date('d F Y, H:i:s') }} WIB</p>
            <p style="margin-top: 10px; color: #16a34a; font-weight: bold;">Terima kasih atas kepercayaan Anda 🌿</p>
        </div>
    </div>
</body>
</html>
<!-- format harinya masih salah -->