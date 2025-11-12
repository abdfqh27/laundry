@extends('layouts.app')

@section('title', 'Pembayaran Order #' . $order->order_number)

@section('content')
<div class="page-header">
    <a href="{{ route('customer.orders.show', $order) }}" class="text-decoration-none text-muted">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Detail Order
    </a>
    <h1 class="mt-3">Informasi Pembayaran</h1>
</div>

<div class="row g-4">
    <!-- LEFT COLUMN - Payment Methods -->
    <div class="col-lg-8">
        <!-- Total Amount Card -->
        <div class="data-card mb-4 text-center" style="background: linear-gradient(135deg, rgba(99,102,241,0.2) 0%, rgba(139,92,246,0.2) 100%); border: 2px solid rgba(99,102,241,0.3);">
            <h5 class="mb-2">Total yang harus dibayar</h5>
            <h1 class="mb-0" style="font-size: 3rem; font-weight: 700; color: #6366f1;">
                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
            </h1>
            <p class="text-muted mb-0">Order #{{ $order->order_number }}</p>
        </div>

        <div class="data-card mb-4">
            <h4 class="mb-4">
                <i class="bi bi-credit-card me-2"></i>Pilih Metode Pembayaran
            </h4>

            <!-- Transfer Bank -->
            <div class="payment-method-card mb-3" onclick="togglePaymentMethod('transfer')">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="payment-icon">
                            <i class="bi bi-bank2"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Transfer Bank</h5>
                            <small class="text-muted">Transfer ke rekening bank</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-down chevron-icon" id="chevron-transfer"></i>
                </div>
                
                <!-- Bank Details (Hidden by default) -->
                <div class="payment-details mt-3 d-none" id="details-transfer">
                    <hr style="border-color: rgba(255,255,255,0.1);">
                    <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Transfer ke rekening berikut:</h6>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="bank-card">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bank-logo bg-primary">
                                        <i class="bi bi-bank text-white"></i>
                                    </div>
                                    <strong>Bank BCA</strong>
                                </div>
                                <p class="mb-1"><small class="text-muted">Nomor Rekening</small></p>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="mb-0" id="bca-number">1234567890</h5>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('1234567890', 'bca')">
                                        <i class="bi bi-clipboard" id="icon-bca"></i>
                                    </button>
                                </div>
                                <p class="mb-0 mt-2"><small>a.n. <strong>LaundryKu</strong></small></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bank-card">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bank-logo bg-warning">
                                        <i class="bi bi-bank text-white"></i>
                                    </div>
                                    <strong>Bank Mandiri</strong>
                                </div>
                                <p class="mb-1"><small class="text-muted">Nomor Rekening</small></p>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="mb-0" id="mandiri-number">0987654321</h5>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('0987654321', 'mandiri')">
                                        <i class="bi bi-clipboard" id="icon-mandiri"></i>
                                    </button>
                                </div>
                                <p class="mb-0 mt-2"><small>a.n. <strong>LaundryKu</strong></small></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Setelah transfer, kirim bukti pembayaran via WhatsApp dengan format:
                        <br><br>
                        <strong>BAYAR-{{ $order->order_number }}</strong><br>
                        Nama: {{ auth()->user()->name }}<br>
                        Jumlah: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <!-- QRIS -->
            <div class="payment-method-card mb-3" onclick="togglePaymentMethod('qris')">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="payment-icon">
                            <i class="bi bi-qr-code"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">QRIS</h5>
                            <small class="text-muted">Scan & bayar dengan e-wallet</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-down chevron-icon" id="chevron-qris"></i>
                </div>
                
                <!-- QRIS Details (Hidden by default) -->
                <div class="payment-details mt-3 d-none" id="details-qris">
                    <hr style="border-color: rgba(255,255,255,0.1);">
                    <h6 class="mb-3 text-center"><i class="bi bi-info-circle me-2"></i>Scan QR Code berikut:</h6>
                    
                    <div class="text-center mb-3">
                        <div class="qris-container">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=LaundryKu-{{ $order->order_number }}-{{ $order->total_amount }}" 
                                 alt="QRIS Code" 
                                 class="qris-image">
                        </div>
                        <p class="mt-3 mb-0">
                            <small class="text-muted">Gunakan aplikasi mobile banking atau e-wallet<br>(GoPay, OVO, Dana, ShopeePay, dll)</small>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Setelah pembayaran berhasil, kirim screenshot bukti via WhatsApp dengan format:
                        <br><br>
                        <strong>BAYAR-{{ $order->order_number }}</strong><br>
                        Nama: {{ auth()->user()->name }}<br>
                        Jumlah: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <!-- Cash -->
            <div class="payment-method-card" onclick="togglePaymentMethod('cash')">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="payment-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Bayar di Tempat (Cash)</h5>
                            <small class="text-muted">Bayar tunai saat pickup/delivery</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-down chevron-icon" id="chevron-cash"></i>
                </div>
                
                <!-- Cash Details (Hidden by default) -->
                <div class="payment-details mt-3 d-none" id="details-cash">
                    <hr style="border-color: rgba(255,255,255,0.1);">
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        <strong>Bayar saat pengambilan cucian</strong>
                        <br><br>
                        Anda dapat membayar secara tunai ketika datang ke toko kami untuk mengambil cucian.
                        <br><br>
                        <strong>Alamat:</strong> Jl. Contoh No. 123, Jakarta<br>
                        <strong>Buka:</strong> Senin - Sabtu, 08:00 - 20:00
                    </div>
                </div>
            </div>
        </div>

        <!-- WhatsApp Button -->
        <div class="data-card text-center" style="background: linear-gradient(135deg, rgba(37,211,102,0.1) 0%, rgba(34,197,94,0.1) 100%); border: 2px solid rgba(37,211,102,0.3);">
            <i class="bi bi-whatsapp" style="font-size: 3rem; color: #25d366; margin-bottom: 1rem;"></i>
            <h5 class="mb-3">Kirim Bukti Pembayaran</h5>
            <p class="text-muted mb-4">Setelah melakukan pembayaran, kirim bukti transfer/screenshot ke WhatsApp kami</p>
            
            @php
                $waNumber = '6281234567890'; // Ganti dengan nomor WA laundry
                $message = "Halo, saya ingin konfirmasi pembayaran:\n\n*BAYAR-{$order->order_number}*\nNama: " . auth()->user()->name . "\nJumlah: Rp " . number_format($order->total_amount, 0, ',', '.') . "\n\n_Bukti pembayaran terlampir_";
                $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($message);
            @endphp
            
            <a href="{{ $waLink }}" target="_blank" class="btn btn-success btn-lg w-100">
                <i class="bi bi-whatsapp me-2"></i>Kirim Bukti via WhatsApp
            </a>
            <small class="text-muted d-block mt-2">
                <i class="bi bi-shield-check me-1"></i>Admin akan konfirmasi dalam 1-2 jam
            </small>
        </div>
    </div>

    <!-- RIGHT COLUMN - Order Summary -->
    <div class="col-lg-4">
        <!-- Order Details -->
        <div class="data-card mb-4">
            <h5 class="mb-3">
                <i class="bi bi-receipt me-2"></i>Ringkasan Order
            </h5>
            
            <div class="mb-3 pb-3" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <small class="text-muted d-block mb-1">Nomor Order</small>
                <div class="d-flex align-items-center gap-2">
                    <strong id="order-number">{{ $order->order_number }}</strong>
                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ $order->order_number }}', 'order')">
                        <i class="bi bi-clipboard" id="icon-order"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3 pb-3" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <small class="text-muted d-block">Tanggal Order</small>
                <strong>{{ $order->created_at->format('d M Y, H:i') }}</strong>
            </div>

            <div class="mb-3 pb-3" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <small class="text-muted d-block">Pickup</small>
                <strong>{{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y, H:i') }}</strong>
            </div>

            <div class="mb-2">
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Subtotal:</span>
                    <strong>Rp {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</strong>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Biaya Admin:</span>
                    <strong>Rp 5.000</strong>
                </div>
            </div>

            <div class="p-3" style="background: rgba(99,102,241,0.1); border-radius: 0.5rem;">
                <div class="d-flex justify-content-between align-items-center">
                    <span style="font-size: 1.1rem;"><strong>Total Bayar:</strong></span>
                    <span style="font-size: 1.5rem; font-weight: 700; color: #6366f1;">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Help Card -->
        <div class="data-card">
            <h5 class="mb-3">
                <i class="bi bi-headset me-2"></i>Butuh Bantuan?
            </h5>
            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                Jika mengalami kesulitan, hubungi kami:
            </p>
            
            <div class="contact-item mb-2">
                <i class="bi bi-whatsapp text-success me-2"></i>
                <a href="https://wa.me/6281234567890" class="text-decoration-none" target="_blank">
                    +62 812-3456-7890
                </a>
            </div>
            
            <div class="contact-item mb-3">
                <i class="bi bi-envelope text-primary me-2"></i>
                <a href="mailto:support@laundryku.com" class="text-decoration-none">
                    support@laundryku.com
                </a>
            </div>

            <div class="alert alert-warning mb-0" style="font-size: 0.85rem;">
                <i class="bi bi-clock-history me-2"></i>
                <small>Jam Operasional:<br>Senin - Sabtu: 08:00 - 20:00</small>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-method-card {
        background: rgba(99,102,241,0.05);
        border: 2px solid rgba(99,102,241,0.2);
        border-radius: 0.75rem;
        padding: 1.25rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-method-card:hover {
        background: rgba(99,102,241,0.1);
        border-color: rgba(99,102,241,0.4);
        transform: translateY(-2px);
    }

    .payment-method-card.active {
        background: rgba(99,102,241,0.15);
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
    }

    .payment-icon {
        width: 50px;
        height: 50px;
        background: rgba(99,102,241,0.2);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.5rem;
        color: #6366f1;
    }

    .chevron-icon {
        transition: transform 0.3s ease;
        color: #6366f1;
    }

    .chevron-icon.rotate {
        transform: rotate(180deg);
    }

    .bank-card {
        background: rgba(25,25,40,0.5);
        border: 1px solid rgba(99,102,241,0.2);
        border-radius: 0.75rem;
        padding: 1.25rem;
    }

    .bank-logo {
        width: 35px;
        height: 35px;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
    }

    .qris-container {
        background: white;
        padding: 1.5rem;
        border-radius: 1rem;
        display: inline-block;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .qris-image {
        max-width: 250px;
        height: auto;
        display: block;
    }

    .contact-item {
        padding: 0.5rem 0;
    }

    @media (max-width: 768px) {
        .payment-icon {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .qris-image {
            max-width: 200px;
        }
    }
</style>

<script>
function togglePaymentMethod(method) {
    const details = document.getElementById('details-' + method);
    const chevron = document.getElementById('chevron-' + method);
    const card = event.currentTarget;
    
    // Toggle current
    details.classList.toggle('d-none');
    chevron.classList.toggle('rotate');
    card.classList.toggle('active');
    
    // Close others
    ['transfer', 'qris', 'cash'].forEach(m => {
        if (m !== method) {
            document.getElementById('details-' + m).classList.add('d-none');
            document.getElementById('chevron-' + m).classList.remove('rotate');
            document.querySelector(`[onclick="togglePaymentMethod('${m}')"]`).classList.remove('active');
        }
    });
}

function copyToClipboard(text, id) {
    navigator.clipboard.writeText(text).then(() => {
        const icon = document.getElementById('icon-' + id);
        icon.classList.remove('bi-clipboard');
        icon.classList.add('bi-check-lg');
        
        setTimeout(() => {
            icon.classList.remove('bi-check-lg');
            icon.classList.add('bi-clipboard');
        }, 2000);
    });
}
</script>
@endsection