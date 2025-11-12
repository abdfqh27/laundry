@extends('layouts.app')

@section('title', 'Pembayaran Order #' . $order->order_number)

@section('content')
<div class="page-header">
    <a href="{{ route('customer.orders.show', $order->id) }}" class="text-decoration-none text-light">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Detail Order
    </a>
    <div class="mt-3">
        <h1><i class="bi bi-credit-card me-2 text-primary"></i>Pilih Metode Pembayaran</h1>
        <p class="text-light">Order #{{ $order->order_number }}</p>
    </div>
</div>

<div class="row g-4">
    <!-- LEFT COLUMN - Payment Methods -->
    <div class="col-lg-8">
        <div class="data-card mb-4">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-wallet2 fs-3"></i>
                </div>
                <div>
                    <h4 class="mb-0">Metode Pembayaran</h4>
                    <small class="text-light">Pilih metode pembayaran yang Anda inginkan</small>
                </div>
            </div>

            <div class="payment-methods">
                @foreach($paymentMethods as $method)
                    <div class="payment-method-card" data-method="{{ $method['id'] }}">
                        <input type="radio" name="payment_method" id="method_{{ $method['id'] }}" value="{{ $method['id'] }}" class="payment-radio">
                        <label for="method_{{ $method['id'] }}" class="payment-label">
                            <div class="d-flex align-items-center">
                                <div class="payment-icon-wrapper me-3">
                                    <i class="bi bi-{{ $method['icon'] }} fs-2"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $method['name'] }}</h5>
                                    @if(isset($method['description']))
                                        <small class="text-light opacity-75">{{ $method['description'] }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="check-icon-wrapper">
                                <i class="bi bi-check-circle-fill check-icon"></i>
                            </div>
                        </label>

                        <!-- Detail for Transfer Bank -->
                        @if($method['id'] === 'transfer')
                            <div class="payment-detail" id="detail_transfer">
                                <div class="detail-divider"></div>
                                <h6 class="mb-3 text-primary">
                                    <i class="bi bi-bank me-2"></i>Pilih Bank Tujuan Transfer:
                                </h6>
                                <div class="banks-grid">
                                    @foreach($method['banks'] as $index => $bank)
                                        <div class="bank-card-selectable">
                                            <input type="radio" name="bank_account" id="bank_{{ $index }}" 
                                                   value="{{ $bank['name'] }}|{{ $bank['account'] }}|{{ $bank['holder'] }}" 
                                                   class="bank-radio">
                                            <label for="bank_{{ $index }}" class="bank-label">
                                                <div class="bank-content">
                                                    <div class="bank-header">
                                                        <div class="bank-logo">
                                                            <i class="bi bi-bank2"></i>
                                                        </div>
                                                        <strong class="text-primary">{{ $bank['name'] }}</strong>
                                                    </div>
                                                    <div class="bank-body">
                                                        <div class="account-number">{{ $bank['account'] }}</div>
                                                        <small class="text-light">a.n {{ $bank['holder'] }}</small>
                                                    </div>
                                                </div>
                                                <div class="bank-check">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                </div>
                                            </label>
                                            <button class="btn btn-sm btn-outline-primary copy-btn w-100 mt-2" 
                                                    data-copy="{{ $bank['account'] }}"
                                                    onclick="copyToClipboard('{{ $bank['account'] }}', this); event.stopPropagation();">
                                                <i class="bi bi-clipboard me-1"></i>Salin Nomor Rekening
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="alert alert-info-custom mt-3">
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    <div>
                                        <strong>Instruksi Pembayaran:</strong>
                                        <p class="mb-0 mt-1">Pilih rekening tujuan, transfer sesuai jumlah total pembayaran, lalu kirim bukti transfer via WhatsApp</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Detail for QRIS -->
                        @if($method['id'] === 'qris')
                            <div class="payment-detail" id="detail_qris">
                                <div class="detail-divider"></div>
                                <div class="text-center">
                                    <h6 class="mb-3 text-primary">
                                        <i class="bi bi-qr-code me-2"></i>Scan QRIS untuk Pembayaran
                                    </h6>
                                    <div class="qris-container">
                                        <div class="qris-frame">
                                            <img src="{{ asset($method['qr_image']) }}" alt="QRIS" class="img-fluid qris-image" 
                                                 onerror="this.src='https://via.placeholder.com/300x300?text=QRIS+Code'">
                                        </div>
                                    </div>
                                    <p class="text-light mt-3 mb-0">
                                        <i class="bi bi-phone me-2"></i>
                                        <small>Scan menggunakan aplikasi mobile banking atau e-wallet</small>
                                    </p>
                                </div>
                                <div class="alert alert-info-custom mt-3">
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    <div>
                                        <strong>Instruksi Pembayaran:</strong>
                                        <p class="mb-0 mt-1">Setelah pembayaran berhasil, kirim screenshot bukti pembayaran via WhatsApp</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Detail for Cash -->
                        @if($method['id'] === 'cash')
                            <div class="payment-detail" id="detail_cash">
                                <div class="detail-divider"></div>
                                <div class="alert alert-warning-custom">
                                    <i class="bi bi-cash-stack fs-3 mb-2"></i>
                                    <h6><strong>Pembayaran Tunai</strong></h6>
                                    <p class="mb-2">Anda dapat membayar langsung saat:</p>
                                    <ul class="cash-list">
                                        <li><i class="bi bi-check-circle-fill me-2"></i>Pengambilan laundry oleh kurir</li>
                                        <li><i class="bi bi-check-circle-fill me-2"></i>Pengantaran laundry yang sudah selesai</li>
                                        <li><i class="bi bi-check-circle-fill me-2"></i>Datang langsung ke toko</li>
                                    </ul>
                                </div>
                                <div class="alert alert-info-custom">
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    <div>
                                        <strong>Catatan:</strong>
                                        <p class="mb-0 mt-1">Tetap konfirmasi via WhatsApp bahwa Anda akan membayar tunai</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- WhatsApp Confirmation Button -->
            <div class="text-center mt-4">
                <button id="whatsappBtn" class="btn btn-whatsapp btn-lg" disabled>
                    <span class="btn-content">
                        <i class="bi bi-whatsapp me-2"></i>
                        <span>Konfirmasi Pembayaran via WhatsApp</span>
                    </span>
                </button>
                <p class="text-light mt-2 mb-0">
                    <small id="btnHelpText">
                        <i class="bi bi-arrow-up me-1"></i>Pilih metode pembayaran terlebih dahulu
                    </small>
                </p>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN - Order Summary -->
    <div class="col-lg-4">
        <div class="data-card sticky-summary">
            <div class="summary-header mb-4">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="bi bi-receipt fs-3"></i>
                    </div>
                    <div>
                        <h4 class="mb-0">Ringkasan Order</h4>
                        <small class="text-light">Detail pembayaran Anda</small>
                    </div>
                </div>
            </div>

            <div class="order-info-card mb-3">
                <div class="info-row">
                    <span class="text-light">
                        <i class="bi bi-hash me-1"></i>Nomor Order:
                    </span>
                    <strong class="text-primary">{{ $order->order_number }}</strong>
                </div>
                <div class="info-row">
                    <span class="text-light">
                        <i class="bi bi-calendar3 me-1"></i>Tanggal Order:
                    </span>
                    <strong>{{ $order->created_at->format('d M Y') }}</strong>
                </div>
                <div class="info-row">
                    <span class="text-light">
                        <i class="bi bi-clock-history me-1"></i>Status:
                    </span>
                    <span class="badge bg-warning">{{ ucfirst($order->status) }}</span>
                </div>
            </div>

            <div class="divider-line"></div>

            <h6 class="mb-3 text-primary">
                <i class="bi bi-list-check me-2"></i>Detail Pembayaran:
            </h6>
            
            <div class="items-list mb-3">
                @foreach($order->items as $item)
                    <div class="item-row">
                        <div class="item-info">
                            <span class="item-name">{{ $item->service->name }}</span>
                            <small class="text-light">({{ $item->quantity }} {{ $item->service->unit }})</small>
                        </div>
                        <span class="item-price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="divider-line"></div>

            <div class="calculation-section">
                <div class="calc-row">
                    <span class="text-light">Subtotal:</span>
                    <span>Rp {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</span>
                </div>
                <div class="calc-row">
                    <span class="text-light">Biaya Admin:</span>
                    <span>Rp 5.000</span>
                </div>
            </div>

            <div class="divider-line"></div>

            <div class="total-section">
                <span class="total-label">Total Pembayaran:</span>
                <span class="total-amount">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </span>
            </div>

            <div class="alert alert-warning-custom-compact mt-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <small><strong>Penting:</strong> Bayar sesuai jumlah total di atas</small>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-wrapper {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, rgba(99,102,241,0.2) 0%, rgba(99,102,241,0.1) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
    }

    .payment-methods {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .payment-method-card {
        background: linear-gradient(135deg, rgba(99,102,241,0.03) 0%, rgba(99,102,241,0.08) 100%);
        border: 2px solid rgba(99,102,241,0.2);
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .payment-method-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(99,102,241,0.1), transparent);
        transition: left 0.5s;
    }

    .payment-method-card:hover::before {
        left: 100%;
    }

    .payment-method-card:hover {
        border-color: rgba(99,102,241,0.4);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(99,102,241,0.2);
    }

    .payment-radio {
        display: none;
    }

    .payment-label {
        cursor: pointer;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .payment-icon-wrapper {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(99,102,241,0.15) 0%, rgba(99,102,241,0.05) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
        transition: all 0.3s ease;
    }

    .payment-method-card:hover .payment-icon-wrapper {
        transform: scale(1.05) rotate(5deg);
    }

    .check-icon-wrapper {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .check-icon {
        font-size: 1.8rem;
        color: rgba(99,102,241,0.3);
        transition: all 0.3s ease;
    }

    .payment-radio:checked ~ .payment-label .check-icon {
        color: #6366f1;
        transform: scale(1.2) rotate(360deg);
    }

    .payment-method-card:has(.payment-radio:checked) {
        border-color: #6366f1;
        background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(99,102,241,0.15) 100%);
        box-shadow: 0 0 0 4px rgba(99,102,241,0.15), 0 8px 16px rgba(99,102,241,0.3);
    }

    .payment-method-card:has(.payment-radio:checked) .payment-icon-wrapper {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white;
        transform: scale(1.1);
    }

    .detail-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(99,102,241,0.3), transparent);
        margin: 1.5rem 0;
    }

    .payment-detail {
        display: none;
        animation: fadeInUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .payment-radio:checked ~ .payment-detail {
        display: block;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .banks-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .bank-card-selectable {
        position: relative;
    }

    .bank-radio {
        display: none;
    }

    .bank-label {
        background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.02) 100%);
        border: 2px solid rgba(99,102,241,0.3);
        border-radius: 0.75rem;
        padding: 1.25rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: block;
        position: relative;
        margin-bottom: 0;
    }

    .bank-label:hover {
        border-color: #6366f1;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99,102,241,0.2);
    }

    .bank-radio:checked + .bank-label {
        border-color: #6366f1;
        background: linear-gradient(135deg, rgba(99,102,241,0.15) 0%, rgba(99,102,241,0.1) 100%);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.15), 0 4px 12px rgba(99,102,241,0.3);
    }

    .bank-content {
        position: relative;
        z-index: 1;
    }

    .bank-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .bank-logo {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.3s ease;
    }

    .bank-radio:checked + .bank-label .bank-logo {
        transform: scale(1.1) rotate(5deg);
    }

    .bank-body {
        margin-bottom: 0;
    }

    .account-number {
        font-size: 1.1rem;
        font-weight: 700;
        color: #e0e7ff;
        letter-spacing: 1px;
        margin-bottom: 0.25rem;
    }

    .bank-check {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
        color: rgba(99,102,241,0.3);
        transition: all 0.3s ease;
    }

    .bank-radio:checked + .bank-label .bank-check i {
        color: #6366f1;
        transform: scale(1.2) rotate(360deg);
    }

    .qris-container {
        position: relative;
        display: inline-block;
        margin: 1rem 0;
    }

    .qris-frame {
        background: white;
        padding: 1.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
    }

    .qris-frame::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #6366f1, #8b5cf6, #6366f1);
        border-radius: 1.5rem;
        z-index: -1;
        animation: borderRotate 3s linear infinite;
    }

    @keyframes borderRotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .qris-image {
        max-width: 280px;
        height: auto;
        display: block;
    }

    .copy-btn {
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .copy-btn:hover {
        transform: scale(1.02);
    }

    .copy-btn.copied {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border-color: #10b981 !important;
        color: white !important;
        transform: scale(1.05);
    }

    .alert-info-custom {
        background: linear-gradient(135deg, rgba(59,130,246,0.1) 0%, rgba(37,99,235,0.05) 100%);
        border: 1px solid rgba(59,130,246,0.3);
        border-radius: 0.75rem;
        padding: 1rem;
        display: flex;
        gap: 0.75rem;
        color: #e0e7ff;
    }

    .alert-info-custom i {
        color: #60a5fa;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .alert-warning-custom {
        background: linear-gradient(135deg, rgba(251,191,36,0.1) 0%, rgba(245,158,11,0.05) 100%);
        border: 1px solid rgba(251,191,36,0.3);
        border-radius: 0.75rem;
        padding: 1.25rem;
        text-align: center;
        color: #fef3c7;
    }

    .alert-warning-custom i {
        color: #fbbf24;
    }

    .cash-list {
        list-style: none;
        padding: 0;
        margin: 0.75rem 0 0 0;
        text-align: left;
    }

    .cash-list li {
        padding: 0.5rem;
        display: flex;
        align-items: center;
    }

    .cash-list i {
        color: #10b981;
    }

    .btn-whatsapp {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        padding: 1rem 2.5rem;
        font-weight: 600;
        color: white;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(16,185,129,0.3);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .btn-whatsapp::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-whatsapp:hover:not(:disabled)::before {
        left: 100%;
    }

    .btn-whatsapp:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16,185,129,0.4);
    }

    .btn-whatsapp:active:not(:disabled) {
        transform: translateY(0);
    }

    .btn-whatsapp:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: linear-gradient(135deg, rgba(16,185,129,0.3) 0%, rgba(5,150,105,0.3) 100%);
    }

    .btn-content {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sticky-summary {
        position: sticky;
        top: 2rem;
    }

    .summary-header {
        border-bottom: 2px solid rgba(99,102,241,0.2);
        padding-bottom: 1rem;
    }

    .order-info-card {
        background: linear-gradient(135deg, rgba(99,102,241,0.05) 0%, rgba(99,102,241,0.02) 100%);
        border: 1px solid rgba(99,102,241,0.2);
        border-radius: 0.75rem;
        padding: 1rem;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
    }

    .info-row:not(:last-child) {
        border-bottom: 1px solid rgba(99,102,241,0.1);
    }

    .divider-line {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(99,102,241,0.3), transparent);
        margin: 1rem 0;
    }

    .items-list {
        max-height: 200px;
        overflow-y: auto;
        padding-right: 0.5rem;
    }

    .items-list::-webkit-scrollbar {
        width: 6px;
    }

    .items-list::-webkit-scrollbar-track {
        background: rgba(99,102,241,0.1);
        border-radius: 10px;
    }

    .items-list::-webkit-scrollbar-thumb {
        background: rgba(99,102,241,0.3);
        border-radius: 10px;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: start;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(99,102,241,0.1);
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .item-name {
        font-weight: 600;
        color: #e0e7ff;
    }

    .item-price {
        font-weight: 600;
        color: #e0e7ff;
        white-space: nowrap;
    }

    .calculation-section {
        margin: 0.5rem 0;
    }

    .calc-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
    }

    .total-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.15) 0%, rgba(99,102,241,0.1) 100%);
        border-radius: 0.75rem;
        margin-top: 0.5rem;
    }

    .total-label {
        font-size: 1.1rem;
        font-weight: 700;
        color: #e0e7ff;
    }

    .total-amount {
        font-size: 1.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .alert-warning-custom-compact {
        background: linear-gradient(135deg, rgba(251,191,36,0.1) 0%, rgba(245,158,11,0.05) 100%);
        border: 1px solid rgba(251,191,36,0.3);
        border-radius: 0.5rem;
        padding: 0.75rem;
        display: flex;
        align-items: center;
        color: #fef3c7;
    }

    .alert-warning-custom-compact i {
        color: #fbbf24;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .sticky-summary {
            position: static;
        }

        .qris-image {
            max-width: 220px;
        }

        .banks-grid {
            grid-template-columns: 1fr;
        }

        .btn-whatsapp {
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
        }

        .total-amount {
            font-size: 1.3rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentRadios = document.querySelectorAll('.payment-radio');
        const bankRadios = document.querySelectorAll('.bank-radio');
        const whatsappBtn = document.getElementById('whatsappBtn');
        const btnHelpText = document.getElementById('btnHelpText');
        const orderNumber = '{{ $order->order_number }}';
        const totalAmount = 'Rp {{ number_format($order->total_amount, 0, ",", ".") }}';
        const whatsappNumber = '{{ $whatsappNumber }}';
        
        let selectedMethod = '';
        let selectedMethodName = '';
        let selectedBank = '';
        let selectedBankAccount = '';
        let selectedBankHolder = '';

        // Handle payment method selection
        paymentRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                selectedMethod = this.value;
                selectedMethodName = this.closest('.payment-method-card')
                    .querySelector('.payment-label h5').textContent;
                
                // Reset bank selection when changing payment method
                selectedBank = '';
                selectedBankAccount = '';
                selectedBankHolder = '';
                
                // Enable button for non-transfer methods
                if (selectedMethod !== 'transfer') {
                    whatsappBtn.disabled = false;
                    btnHelpText.innerHTML = '<i class="bi bi-cursor-fill me-1"></i>Klik untuk mengirim konfirmasi pembayaran';
                } else {
                    whatsappBtn.disabled = true;
                    btnHelpText.innerHTML = '<i class="bi bi-arrow-down me-1"></i>Pilih rekening bank tujuan terlebih dahulu';
                }
            });
        });

        // Handle bank account selection
        bankRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                const bankData = this.value.split('|');
                selectedBank = bankData[0];
                selectedBankAccount = bankData[1];
                selectedBankHolder = bankData[2];
                
                // Enable WhatsApp button when bank is selected
                if (selectedMethod === 'transfer') {
                    whatsappBtn.disabled = false;
                    btnHelpText.innerHTML = '<i class="bi bi-cursor-fill me-1"></i>Klik untuk mengirim konfirmasi pembayaran';
                }
            });
        });

        // Handle WhatsApp button click
        whatsappBtn.addEventListener('click', function() {
            if (!selectedMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu');
                return;
            }

            if (selectedMethod === 'transfer' && !selectedBank) {
                alert('Silakan pilih rekening bank tujuan terlebih dahulu');
                return;
            }

            // Create WhatsApp message
            let message = `Halo, saya ingin mengkonfirmasi pembayaran order saya:%0A%0A`;
            message += `📋 *Nomor Order:* ${orderNumber}%0A`;
            message += `💰 *Total Pembayaran:* ${totalAmount}%0A`;
            message += `💳 *Metode Pembayaran:* ${selectedMethodName}%0A`;
            
            if (selectedMethod === 'transfer') {
                message += `🏦 *Bank Tujuan:* ${selectedBank}%0A`;
                message += `📱 *Nomor Rekening:* ${selectedBankAccount}%0A`;
                message += `👤 *Atas Nama:* ${selectedBankHolder}%0A%0A`;
                message += `Saya akan melakukan transfer bank dan akan mengirimkan bukti transfer setelah ini.%0A%0A`;
            } else if (selectedMethod === 'qris') {
                message += `%0ASaya akan melakukan pembayaran via QRIS dan akan mengirimkan bukti pembayaran setelah ini.%0A%0A`;
            } else if (selectedMethod === 'cash') {
                message += `%0ASaya akan membayar cash saat pengambilan/pengantaran laundry.%0A%0A`;
            }
            
            message += `Terima kasih! 🙏`;

            // Open WhatsApp
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${message}`;
            window.open(whatsappUrl, '_blank');
        });
    });

    // Copy to clipboard function
    function copyToClipboard(text, button) {
        navigator.clipboard.writeText(text).then(function() {
            // Change button appearance
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="bi bi-check-lg me-1"></i>Tersalin!';
            button.classList.add('copied');
            
            // Reset after 2 seconds
            setTimeout(function() {
                button.innerHTML = originalHTML;
                button.classList.remove('copied');
            }, 2000);
        }).catch(function(err) {
            alert('Gagal menyalin: ' + err);
        });
    }
</script>
@endsection