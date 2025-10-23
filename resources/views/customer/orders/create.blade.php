@extends('layouts.app')

@section('title', 'Pesan Laundry')

@section('content')
<div class="page-header">
    <a href="{{ route('customer.orders.index') }}" class="text-decoration-none text-muted">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
    <h1 class="mt-3">Pesan Laundry</h1>
</div>

<form method="POST" action="{{ route('customer.orders.store') }}" id="orderForm">
    @csrf

    <div class="row g-4">
        <!-- LEFT COLUMN -->
        <div class="col-lg-8">
            <!-- LAYANAN SECTION -->
            <div class="data-card mb-4">
                <h4 class="mb-4">
                    <i class="bi bi-bag-check me-2"></i>Pilih Layanan
                </h4>

                <div id="services-container" class="space-y-3">
                    <div class="service-item" data-index="0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-light">Layanan</label>
                                <select name="items[0][service_id]" class="form-select form-select-dark service-select" onchange="calculateTotal()" required>
                                    <option value="">-- Pilih Layanan --</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-light">Jumlah (kg)</label>
                                <input type="number" step="0.5" name="items[0][quantity]" 
                                       class="form-control form-control-dark quantity-input" 
                                       onchange="calculateTotal()" min="0.5" value="1" required
                                       style="color: #fff;">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" onclick="removeService(this)" 
                                        class="btn btn-outline-danger w-100" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between p-3" style="background-color: rgba(99,102,241,0.05); border-radius: 0.5rem;">
                                    <span class="text-muted">Subtotal:</span>
                                    <span class="service-subtotal fw-bold" style="color: #86c7ff;">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" onclick="addService()" class="btn btn-outline-primary mt-4 w-100">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Layanan
                </button>
            </div>

            <!-- PENGAMBILAN SECTION -->
            <div class="data-card mb-4">
                <h4 class="mb-4">
                    <i class="bi bi-calendar-event me-2"></i>Jadwal Pengambilan
                </h4>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="pickup_date" class="form-label">Tanggal Pengambilan</label>
                        <input type="date" id="pickup_date" name="pickup_date" required
                               class="form-control form-control-dark"
                               min="{{ now()->format('Y-m-d') }}"
                               style="color: #fff;">
                        @error('pickup_date')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="pickup_time" class="form-label">Waktu Pengambilan (Opsional)</label>
                        <input type="time" id="pickup_time" name="pickup_time" 
                               class="form-control form-control-dark"
                               style="color: #fff;">
                    </div>
                </div>
            </div>

            <!-- CATATAN SECTION -->
            <div class="data-card">
                <h4 class="mb-4">
                    <i class="bi bi-pencil-square me-2"></i>Catatan Khusus
                </h4>

                <textarea id="notes" name="notes" rows="5"
                          class="form-control form-control-dark"
                          placeholder="Tuliskan catatan khusus, permintaan khusus, atau instruksi lainnya..."
                          style="color: #fff;"></textarea>
                <small class="text-muted d-block mt-2">
                    Contoh: Jangan gunakan pemutih, cuci dengan air dingin, dsb.
                </small>
            </div>
        </div>

        <!-- RIGHT COLUMN - RINGKASAN ORDER -->
        <div class="col-lg-4">
            <div class="data-card sticky-top" style="top: 100px;">
                <h4 class="mb-4">
                    <i class="bi bi-receipt me-2"></i>Ringkasan Order
                </h4>

                <div class="order-summary">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-light">Total Berat:</span>
                            <span class="total-weight fw-bold" style="color: #e0e7ff;">0 kg</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-light">Total Layanan:</span>
                            <span class="total-items fw-bold" style="color: #e0e7ff;">0</span>
                        </div>
                        <hr style="border-color: rgba(255,255,255,0.1);">
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="text-light">Subtotal:</span>
                            <span class="subtotal-amount fw-bold" style="color: #86c7ff;">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="text-light">Biaya Admin:</span>
                            <span class="admin-fee fw-bold" style="color: #86c7ff;">Rp 0</span>
                        </div>
                        <hr style="border-color: rgba(255,255,255,0.1);">
                    </div>

                    <div class="mb-4 p-3" style="background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(59,130,246,0.1) 100%); border-radius: 0.5rem; border: 1px solid rgba(99,102,241,0.2);">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Pembayaran:</span>
                            <span class="total-amount" style="font-size: 1.5rem; font-weight: 700; color: #6366f1;">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold" id="submitBtn">
                        <i class="bi bi-check-circle me-2"></i>Buat Order
                    </button>
                    <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .form-control-dark,
    .form-select-dark {
        background-color: rgba(99, 102, 241, 0.05) !important;
        border: 1px solid rgba(99, 102, 241, 0.2) !important;
        color: #fff !important;
    }

    .form-control-dark:focus,
    .form-select-dark:focus {
        background-color: rgba(99, 102, 241, 0.08) !important;
        border-color: #6366f1 !important;
        color: #fff !important;
        box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25) !important;
    }

    .form-control-dark::placeholder {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .form-select-dark option {
        background-color: #1a1f3a;
        color: #fff;
    }

    .service-item {
        background-color: rgba(99, 102, 241, 0.05);
        border: 1px solid rgba(99, 102, 241, 0.2);
        padding: 1.5rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .service-item:hover {
        background-color: rgba(99, 102, 241, 0.08);
        border-color: rgba(99, 102, 241, 0.4);
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #e0e7ff !important;
    }
    
    .text-light {
        color: #e0e7ff !important;
    }
    
    .text-muted {
        color: #cbd5e1 !important;
    }

    .btn-outline-primary {
        color: #6366f1;
        border-color: rgba(99, 102, 241, 0.4);
    }

    .btn-outline-primary:hover {
        background-color: rgba(99, 102, 241, 0.1);
        border-color: #6366f1;
        color: #818cf8;
    }

    .btn-outline-secondary {
        color: #a0aec0;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .btn-outline-secondary:hover {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.2);
        color: #e2e8f0;
    }

    .btn-outline-danger {
        color: #fca5a5;
        border-color: rgba(239, 68, 68, 0.3);
    }

    .btn-outline-danger:hover {
        background-color: rgba(239, 68, 68, 0.1);
        border-color: #fca5a5;
    }

    .btn-primary {
        background-color: #6366f1;
        border-color: #6366f1;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #4f46e5;
        border-color: #4f46e5;
        box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
    }

    .sticky-top {
        top: 100px !important;
    }

    @media (max-width: 992px) {
        .sticky-top {
            position: static !important;
            top: auto !important;
        }
    }

    .space-y-3 > * + * {
        margin-top: 1rem;
    }
</style>

<script>
let services = [];
let serviceCount = 1;
const ADMIN_FEE = 5000; // Sesuaikan dengan kebijakan bisnis Anda

document.addEventListener('DOMContentLoaded', function() {
    loadServices();
    setMinDate();
});

function setMinDate() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('pickup_date').setAttribute('min', today);
}

function loadServices() {
    fetch('/api/services')
        .then(response => response.json())
        .then(data => {
            services = data;
            populateServiceSelects();
            calculateTotal();
        })
        .catch(error => {
            console.error('Error loading services:', error);
        });
}

function populateServiceSelects() {
    const serviceOptions = services.map(s => 
        `<option value="${s.id}" data-price="${s.price}">${s.name} - Rp ${parseInt(s.price).toLocaleString('id-ID')}/kg</option>`
    ).join('');
    
    document.querySelectorAll('.service-select').forEach(select => {
        select.innerHTML = '<option value="">-- Pilih Layanan --</option>' + serviceOptions;
    });
}

function addService() {
    serviceCount++;
    const container = document.getElementById('services-container');
    
    const serviceOptions = services.map(s => 
        `<option value="${s.id}" data-price="${s.price}">${s.name} - Rp ${parseInt(s.price).toLocaleString('id-ID')}/kg</option>`
    ).join('');
    
    const html = `
                            <div class="service-item" data-index="${serviceCount}">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-light">Layanan</label>
                    <select name="items[${serviceCount}][service_id]" class="form-select form-select-dark service-select" onchange="calculateTotal()" required>
                        <option value="">-- Pilih Layanan --</option>
                        ${serviceOptions}
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-light">Jumlah (kg)</label>
                    <input type="number" step="0.5" name="items[${serviceCount}][quantity]" 
                           class="form-control form-control-dark quantity-input" 
                           onchange="calculateTotal()" min="0.5" value="1" required
                           style="color: #fff;">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" onclick="removeService(this)" class="btn btn-outline-danger w-100">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between p-3" style="background-color: rgba(99,102,241,0.05); border-radius: 0.5rem;">
                        <span class="text-muted">Subtotal:</span>
                        <span class="service-subtotal fw-bold text-info">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', html);
    calculateTotal();
}

function removeService(btn) {
    const items = document.querySelectorAll('.service-item');
    if (items.length > 1) {
        btn.closest('.service-item').remove();
        calculateTotal();
    } else {
        alert('Minimal harus ada 1 layanan');
    }
}

function calculateTotal() {
    let total = 0;
    let totalWeight = 0;
    let totalItems = 0;

    document.querySelectorAll('.service-item').forEach((item, index) => {
        const select = item.querySelector('.service-select');
        const qty = item.querySelector('.quantity-input');
        const subtotalEl = item.querySelector('.service-subtotal');

        if (select.value && qty.value) {
            const price = parseFloat(select.options[select.selectedIndex].dataset.price);
            const quantity = parseFloat(qty.value);
            const subtotal = price * quantity;
            
            total += subtotal;
            totalWeight += quantity;
            totalItems += 1;

            subtotalEl.textContent = 'Rp ' + parseInt(subtotal).toLocaleString('id-ID');
        } else {
            if (subtotalEl) subtotalEl.textContent = 'Rp 0';
        }
    });

    const finalTotal = total + ADMIN_FEE;

    // Update ringkasan
    document.querySelector('.total-weight').textContent = totalWeight + ' kg';
    document.querySelector('.total-items').textContent = totalItems;
    document.querySelector('.subtotal-amount').textContent = 'Rp ' + parseInt(total).toLocaleString('id-ID');
    document.querySelector('.admin-fee').textContent = 'Rp ' + parseInt(ADMIN_FEE).toLocaleString('id-ID');
    document.querySelector('.total-amount').textContent = 'Rp ' + parseInt(finalTotal).toLocaleString('id-ID');
}

// Form validation
document.getElementById('orderForm').addEventListener('submit', function(e) {
    const items = document.querySelectorAll('.service-item');
    const hasValidItems = Array.from(items).some(item => {
        const select = item.querySelector('.service-select');
        const qty = item.querySelector('.quantity-input');
        return select.value && qty.value;
    });

    if (!hasValidItems) {
        e.preventDefault();
        alert('Pilih minimal satu layanan dengan jumlah');
        return false;
    }

    const pickupDate = document.getElementById('pickup_date').value;
    if (!pickupDate) {
        e.preventDefault();
        alert('Tanggal pengambilan harus diisi');
        return false;
    }
});
</script>
@endsection