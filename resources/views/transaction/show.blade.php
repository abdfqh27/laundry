@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Back Button & Header -->
    <div class="mb-4">
        <a href="{{ route('transaction.index') }}" class="back-button">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Transactions</span>
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success-custom alert-dismissible fade show" role="alert">
            <div class="alert-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="alert-content">
                <strong>Success!</strong>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger-custom alert-dismissible fade show" role="alert">
            <div class="alert-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <div class="alert-content">
                <strong>Error!</strong>
                <p class="mb-0">{{ session('error') }}</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Left Column - Transaction Details -->
        <div class="col-lg-8">
            <!-- Transaction Status Card -->
            <div class="detail-card status-card">
                <div class="card-header-detail">
                    <div class="header-icon-box">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <div>
                        <h4 class="mb-1">Transaction Details</h4>
                        <p class="text-muted mb-0">Complete information about this transaction</p>
                    </div>
                </div>

                <div class="card-body-detail">
                    <!-- Status Badge -->
                    <div class="status-section">
                        <label class="section-label">
                            <i class="bi bi-info-circle"></i> Current Status
                        </label>
                        <div class="status-badge-large">
                            @if($transaction->status === 'confirmed')
                                <div class="status-badge-xl confirmed">
                                    <span class="pulse-large"></span>
                                    <div class="status-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="status-text">
                                        <div class="status-title">CONFIRMED</div>
                                        <div class="status-subtitle">Payment has been verified</div>
                                    </div>
                                </div>
                            @elseif($transaction->status === 'pending')
                                <div class="status-badge-xl pending">
                                    <span class="pulse-large"></span>
                                    <div class="status-icon">
                                        <i class="bi bi-clock-fill"></i>
                                    </div>
                                    <div class="status-text">
                                        <div class="status-title">PENDING</div>
                                        <div class="status-subtitle">Waiting for confirmation</div>
                                    </div>
                                </div>
                            @else
                                <div class="status-badge-xl rejected">
                                    <span class="pulse-large"></span>
                                    <div class="status-icon">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </div>
                                    <div class="status-text">
                                        <div class="status-title">REJECTED</div>
                                        <div class="status-subtitle">Payment was declined</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Transaction Info Grid -->
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-hash"></i>
                            </div>
                            <div class="info-content">
                                <label>Order Number</label>
                                <div class="info-value">{{ $transaction->order->order_number }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="info-content">
                                <label>Customer</label>
                                <div class="info-value">{{ $transaction->order->customer->name }}</div>
                            </div>
                        </div>

                        <div class="info-item highlight">
                            <div class="info-icon">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="info-content">
                                <label>Amount</label>
                                <div class="info-value amount">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <div class="info-content">
                                <label>Payment Method</label>
                                <div class="info-value">
                                    @if($transaction->payment_method === 'cash')
                                        <span class="payment-badge-detail cash">
                                            <i class="bi bi-cash-stack"></i> CASH
                                        </span>
                                    @elseif($transaction->payment_method === 'transfer')
                                        <span class="payment-badge-detail transfer">
                                            <i class="bi bi-bank"></i> TRANSFER
                                        </span>
                                    @else
                                        <span class="payment-badge-detail qris">
                                            <i class="bi bi-qr-code-scan"></i> QRIS
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="info-content">
                                <label>Created At</label>
                                <div class="info-value">{{ $transaction->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>

                        @if($transaction->confirmed_at)
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-check2-circle"></i>
                                </div>
                                <div class="info-content">
                                    <label>Confirmed At</label>
                                    <div class="info-value">{{ $transaction->confirmed_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        @endif

                        @if($transaction->confirmedBy)
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <div class="info-content">
                                    <label>Confirmed By</label>
                                    <div class="info-value">{{ $transaction->confirmedBy->name }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Rejection Reason (if rejected) -->
                    @if($transaction->status === 'rejected' && $transaction->rejection_reason)
                        <div class="rejection-reason-box mt-4">
                            <div class="rejection-header">
                                <i class="bi bi-exclamation-triangle"></i>
                                <span>Rejection Reason</span>
                            </div>
                            <div class="rejection-content">
                                {{ $transaction->rejection_reason }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Proof Card -->
            @if($transaction->payment_proof)
                <div class="detail-card mt-4">
                    <div class="card-header-detail">
                        <div class="header-icon-box">
                            <i class="bi bi-image"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">Payment Proof</h4>
                            <p class="text-muted mb-0">Uploaded payment verification image</p>
                        </div>
                    </div>

                    <div class="card-body-detail">
                        <div class="payment-proof-container">
                            <img src="{{ Storage::url($transaction->payment_proof) }}" 
                                 alt="Payment Proof" 
                                 class="payment-proof-image"
                                 onclick="openImageModal(this.src)">
                            <div class="image-overlay">
                                <i class="bi bi-zoom-in"></i>
                                <span>Click to enlarge</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Order Notes (if exists) -->
            @if($transaction->order->notes)
                <div class="detail-card mt-4">
                    <div class="card-header-detail">
                        <div class="header-icon-box">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">Order Notes History</h4>
                            <p class="text-muted mb-0">Historical notes and updates</p>
                        </div>
                    </div>

                    <div class="card-body-detail">
                        <div class="order-notes-box">
                            {!! nl2br(e($transaction->order->notes)) !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column - Actions & Order Management -->
        <div class="col-lg-4">
            <!-- Quick Payment Actions Card (Only if Pending) -->
            @if($transaction->status === 'pending')
                <div class="detail-card action-card">
                    <div class="card-header-detail">
                        <div class="header-icon-box">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">Payment Actions</h4>
                            <p class="text-muted mb-0">Quick payment management</p>
                        </div>
                    </div>

                    <div class="card-body-detail">
                        <!-- Update Payment Status Form -->
                        <form action="{{ route('transaction.update-status', $transaction) }}" method="POST" class="mb-3">
                            @csrf
                            
                            <div class="form-group-inline mb-3">
                                <label class="form-label-inline">
                                    <i class="bi bi-credit-card"></i> Payment Method
                                </label>
                                <select name="payment_method" class="form-select-inline" required>
                                    <option value="cash" {{ $transaction->payment_method === 'cash' ? 'selected' : '' }}>💵 Cash</option>
                                    <option value="transfer" {{ $transaction->payment_method === 'transfer' ? 'selected' : '' }}>🏦 Transfer</option>
                                    <option value="qris" {{ $transaction->payment_method === 'qris' ? 'selected' : '' }}>📱 QRIS</option>
                                </select>
                            </div>

                            <div class="form-group-inline mb-3">
                                <label class="form-label-inline">
                                    <i class="bi bi-check-circle"></i> Payment Status
                                </label>
                                <select name="status" id="payment_status" class="form-select-inline" required>
                                    <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>⏱️ Pending</option>
                                    <option value="confirmed" {{ $transaction->status === 'confirmed' ? 'selected' : '' }}>✅ Confirmed</option>
                                    <option value="rejected" {{ $transaction->status === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                                </select>
                            </div>

                            <div class="form-group-inline mb-3" id="rejection_reason_group" style="display: none;">
                                <label class="form-label-inline">
                                    <i class="bi bi-chat-left-text"></i> Rejection Reason
                                </label>
                                <textarea name="rejection_reason" rows="3" class="form-textarea-inline" placeholder="Enter reason for rejection..."></textarea>
                            </div>

                            <button type="submit" class="btn-submit-inline">
                                <i class="bi bi-check-lg"></i> Update Payment Status
                            </button>
                        </form>

                        <div class="divider-or">
                            <span>OR QUICK ACTIONS</span>
                        </div>

                        <!-- Quick Buttons -->
                        <div class="quick-buttons">
                            <form action="{{ route('transaction.quick-confirm', $transaction) }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" onclick="return confirm('Confirm this payment?')" class="btn-quick success">
                                    <i class="bi bi-check-circle"></i> Quick Confirm
                                </button>
                            </form>

                            <form action="{{ route('transaction.quick-reject', $transaction) }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" onclick="return confirm('Reject this payment?')" class="btn-quick danger">
                                    <i class="bi bi-x-circle"></i> Quick Reject
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Order Information Card -->
            <div class="detail-card {{ $transaction->status === 'pending' ? 'mt-4' : '' }}">
                <div class="card-header-detail">
                    <div class="header-icon-box">
                        <i class="bi bi-bag-check"></i>
                    </div>
                    <div>
                        <h4 class="mb-1">Order Information</h4>
                        <p class="text-muted mb-0">Current order details</p>
                    </div>
                </div>

                <div class="card-body-detail">
                    <div class="order-info-list">
                        <div class="order-info-item">
                            <span class="label">Order Status</span>
                            <span class="value">
                                @if($transaction->order->status === 'completed')
                                    <span class="mini-badge success">
                                        <i class="bi bi-check-circle"></i> Completed
                                    </span>
                                @elseif($transaction->order->status === 'processing')
                                    <span class="mini-badge warning">
                                        <i class="bi bi-hourglass-split"></i> Processing
                                    </span>
                                @elseif($transaction->order->status === 'picked_up')
                                    <span class="mini-badge info">
                                        <i class="bi bi-box-seam"></i> Picked Up
                                    </span>
                                @elseif($transaction->order->status === 'cancelled')
                                    <span class="mini-badge danger">
                                        <i class="bi bi-x-circle"></i> Cancelled
                                    </span>
                                @else
                                    <span class="mini-badge secondary">
                                        <i class="bi bi-clock"></i> {{ ucfirst($transaction->order->status) }}
                                    </span>
                                @endif
                            </span>
                        </div>

                        <div class="order-info-item">
                            <span class="label">Payment Status</span>
                            <span class="value">
                                @if($transaction->order->payment_status === 'paid')
                                    <span class="mini-badge success">
                                        <i class="bi bi-cash-coin"></i> Paid
                                    </span>
                                @elseif($transaction->order->payment_status === 'unpaid')
                                    <span class="mini-badge danger">
                                        <i class="bi bi-exclamation-circle"></i> Unpaid
                                    </span>
                                @else
                                    <span class="mini-badge warning">
                                        <i class="bi bi-dash-circle"></i> Partial
                                    </span>
                                @endif
                            </span>
                        </div>

                        @if($transaction->order->karyawan)
                        <div class="order-info-item">
                            <span class="label">Handled By</span>
                            <span class="value">{{ $transaction->order->karyawan->name }}</span>
                        </div>
                        @endif

                        <div class="order-info-item">
                            <span class="label">Customer Phone</span>
                            <span class="value">{{ $transaction->order->customer->phone ?? '-' }}</span>
                        </div>

                        <div class="order-info-item">
                            <span class="label">Customer Email</span>
                            <span class="value">{{ $transaction->order->customer->email ?? '-' }}</span>
                        </div>

                        @if($transaction->order->completed_at)
                        <div class="order-info-item">
                            <span class="label">Completed At</span>
                            <span class="value">{{ $transaction->order->completed_at->format('d M Y, H:i') }}</span>
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('customer.orders.show', $transaction->order) }}" class="view-order-btn">
                        <i class="bi bi-box-arrow-up-right"></i>
                        View Full Order Details
                    </a>
                </div>
            </div>

            <!-- Update Order Status Card -->
            <div class="detail-card mt-4">
                <div class="card-header-detail">
                    <div class="header-icon-box order-icon">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                    <div>
                        <h4 class="mb-1">Update Order Status</h4>
                        <p class="text-muted mb-0">Manage order workflow</p>
                    </div>
                </div>

                <div class="card-body-detail">
                    <form action="{{ route('transaction.update-order-status', $transaction) }}" method="POST">
                        @csrf
                        
                        <div class="form-group-inline mb-3">
                            <label class="form-label-inline">
                                <i class="bi bi-gear"></i> Order Status
                            </label>
                            <select name="order_status" class="form-select-inline" required>
                                <option value="pending" {{ $transaction->order->status === 'pending' ? 'selected' : '' }}>
                                    ⏱️ Pending - Menunggu Diproses
                                </option>
                                <option value="processing" {{ $transaction->order->status === 'processing' ? 'selected' : '' }}>
                                    ⚙️ Processing - Sedang Dikerjakan
                                </option>
                                <option value="completed" {{ $transaction->order->status === 'completed' ? 'selected' : '' }}>
                                    ✅ Completed - Selesai Dikerjakan
                                </option>
                                <option value="picked_up" {{ $transaction->order->status === 'picked_up' ? 'selected' : '' }}>
                                    📦 Picked Up - Sudah Diambil
                                </option>
                                <option value="cancelled" {{ $transaction->order->status === 'cancelled' ? 'selected' : '' }}>
                                    ❌ Cancelled - Dibatalkan
                                </option>
                            </select>
                            <small class="form-text-helper">
                                <i class="bi bi-info-circle"></i> Current: <strong>{{ ucfirst($transaction->order->status) }}</strong>
                            </small>
                        </div>

                        <div class="form-group-inline mb-3">
                            <label class="form-label-inline">
                                <i class="bi bi-person-gear"></i> Assign to Employee <span class="optional-text">(Optional)</span>
                            </label>
                            <select name="karyawan_id" class="form-select-inline">
                                <option value="">-- Keep Current Employee --</option>
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}" 
                                            {{ $transaction->order->karyawan_id == $karyawan->id ? 'selected' : '' }}>
                                        {{ $karyawan->name }} ({{ ucfirst($karyawan->role) }})
                                    </option>
                                @endforeach
                            </select>
                            @if($transaction->order->karyawan)
                            <small class="form-text-helper">
                                <i class="bi bi-person-check"></i> Currently: <strong>{{ $transaction->order->karyawan->name }}</strong>
                            </small>
                            @endif
                        </div>

                        <div class="form-group-inline mb-3">
                            <label class="form-label-inline">
                                <i class="bi bi-journal-text"></i> Additional Notes <span class="optional-text">(Optional)</span>
                            </label>
                            <textarea name="notes" rows="4" class="form-textarea-inline" placeholder="Add notes about this status update (e.g., completion details, issues, customer requests)..."></textarea>
                            <small class="form-text-helper">
                                <i class="bi bi-clock-history"></i> Notes will be timestamped automatically
                            </small>
                        </div>

                        <button type="submit" class="btn-submit-inline primary">
                            <i class="bi bi-arrow-repeat"></i> Update Order Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="detail-card danger-zone mt-4">
                <div class="card-header-detail">
                    <div class="header-icon-box danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h4 class="mb-1">Danger Zone</h4>
                        <p class="text-muted mb-0">Irreversible actions</p>
                    </div>
                </div>

                <div class="card-body-detail">
                    <form action="{{ route('transaction.destroy', $transaction) }}" 
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this transaction? This action cannot be undone!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">
                            <i class="bi bi-trash3"></i>
                            <span>Delete Transaction</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal (Hanya untuk zoom gambar) -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content image-modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" src="" alt="Payment Proof" class="w-100">
            </div>
        </div>
    </div>
</div>

<style>
    /* Base Variables */
    :root {
        --primary-color: #10b981;
        --primary-dark: #059669;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        --info-color: #3b82f6;
        --dark-bg: rgba(17, 24, 39, 0.7);
        --light-border: rgba(255, 255, 255, 0.1);
    }

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--light-border);
        border-radius: 12px;
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background: rgba(16, 185, 129, 0.15);
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateX(-5px);
    }

    /* Alert Styles */
    .alert-success-custom, .alert-danger-custom {
        border: none;
        border-radius: 15px;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        backdrop-filter: blur(10px);
        animation: slideInDown 0.4s ease;
        margin-bottom: 1.5rem;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success-custom {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.1) 100%);
        border-left: 4px solid var(--primary-color);
    }

    .alert-danger-custom {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.1) 100%);
        border-left: 4px solid var(--danger-color);
    }

    .alert-icon {
        font-size: 1.75rem;
    }

    .alert-success-custom .alert-icon {
        color: var(--primary-color);
    }

    .alert-danger-custom .alert-icon {
        color: var(--danger-color);
    }

    .alert-content strong {
        display: block;
        margin-bottom: 0.25rem;
    }

    /* Detail Cards */
    .detail-card {
        background: var(--dark-bg);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        border: 1px solid var(--light-border);
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .card-header-detail {
        padding: 1.75rem 2rem;
        border-bottom: 1px solid var(--light-border);
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, transparent 100%);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-icon-box {
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: white;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .header-icon-box.danger {
        background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }

    .header-icon-box.order-icon {
        background: linear-gradient(135deg, var(--info-color) 0%, #2563eb 100%);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .card-header-detail h4 {
        color: white;
        font-weight: 700;
        font-size: 1.35rem;
        margin: 0;
    }

    .card-body-detail {
        padding: 2rem;
    }

    /* Status Section */
    .status-section {
        margin-bottom: 2rem;
    }

    .section-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .section-label i {
        color: var(--primary-color);
    }

    .status-badge-large {
        display: flex;
        justify-content: center;
    }

    .status-badge-xl {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.75rem 2.5rem;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        min-width: 400px;
    }

    .status-badge-xl.confirmed {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(16, 185, 129, 0.05) 100%);
        border: 2px solid rgba(16, 185, 129, 0.4);
    }

    .status-badge-xl.pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(245, 158, 11, 0.05) 100%);
        border: 2px solid rgba(245, 158, 11, 0.4);
    }

    .status-badge-xl.rejected {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(239, 68, 68, 0.05) 100%);
        border: 2px solid rgba(239, 68, 68, 0.4);
    }

    .pulse-large {
        position: absolute;
        left: 2rem;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        animation: pulseLarge 2s infinite;
    }

    .status-badge-xl.confirmed .pulse-large {
        background: var(--primary-color);
    }

    .status-badge-xl.pending .pulse-large {
        background: var(--warning-color);
    }

    .status-badge-xl.rejected .pulse-large {
        background: var(--danger-color);
    }

    @keyframes pulseLarge {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.5;
            transform: scale(1.3);
        }
    }

    .status-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        flex-shrink: 0;
    }

    .status-badge-xl.confirmed .status-icon {
        background: rgba(16, 185, 129, 0.2);
        color: var(--primary-color);
    }

    .status-badge-xl.pending .status-icon {
        background: rgba(245, 158, 11, 0.2);
        color: var(--warning-color);
    }

    .status-badge-xl.rejected .status-icon {
        background: rgba(239, 68, 68, 0.2);
        color: var(--danger-color);
    }

    .status-text {
        flex: 1;
    }

    .status-title {
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 0.25rem;
    }

    .status-badge-xl.confirmed .status-title {
        color: var(--primary-color);
    }

    .status-badge-xl.pending .status-title {
        color: var(--warning-color);
    }

    .status-badge-xl.rejected .status-title {
        color: var(--danger-color);
    }

    .status-subtitle {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.95rem;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.25rem;
    }

    .info-item {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--light-border);
        border-radius: 14px;
        padding: 1.25rem;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(16, 185, 129, 0.3);
        transform: translateY(-2px);
    }

    .info-item.highlight {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.03) 100%);
        border-color: rgba(16, 185, 129, 0.3);
    }

    .info-icon {
        width: 44px;
        height: 44px;
        background: rgba(16, 185, 129, 0.15);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--primary-color);
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-content label {
        display: block;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.35rem;
    }

    .info-value {
        color: white;
        font-size: 1.05rem;
        font-weight: 600;
    }

    .info-value.amount {
        color: var(--primary-color);
        font-size: 1.4rem;
        font-weight: 800;
    }

    /* Payment Badge Detail */
    .payment-badge-detail {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .payment-badge-detail.cash {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(34, 197, 94, 0.1) 100%);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.4);
    }

    .payment-badge-detail.transfer {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0.1) 100%);
        color: var(--info-color);
        border: 1px solid rgba(59, 130, 246, 0.4);
    }

    .payment-badge-detail.qris {
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.2) 0%, rgba(168, 85, 247, 0.1) 100%);
        color: #a855f7;
        border: 1px solid rgba(168, 85, 247, 0.4);
    }

    /* Rejection Reason Box */
    .rejection-reason-box {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 12px;
        overflow: hidden;
    }

    .rejection-header {
        background: rgba(239, 68, 68, 0.15);
        padding: 0.875rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--danger-color);
        font-weight: 700;
        font-size: 0.95rem;
    }

    .rejection-header i {
        font-size: 1.25rem;
    }

    .rejection-content {
        padding: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
    }

    /* Order Notes Box */
    .order-notes-box {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--light-border);
        border-radius: 12px;
        padding: 1.5rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.8;
        font-size: 0.95rem;
        max-height: 400px;
        overflow-y: auto;
    }

    .order-notes-box::-webkit-scrollbar {
        width: 8px;
    }

    .order-notes-box::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 4px;
    }

    .order-notes-box::-webkit-scrollbar-thumb {
        background: rgba(16, 185, 129, 0.3);
        border-radius: 4px;
    }

    .order-notes-box::-webkit-scrollbar-thumb:hover {
        background: rgba(16, 185, 129, 0.5);
    }

    /* Payment Proof */
    .payment-proof-container {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        max-width: 100%;
    }

    .payment-proof-image {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
    }

    .payment-proof-container:hover .payment-proof-image {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 100%);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: white;
        font-weight: 600;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .payment-proof-container:hover .image-overlay {
        opacity: 1;
    }

    .image-overlay i {
        font-size: 1.5rem;
    }

    /* Form Inline Styles */
    .form-group-inline {
        margin-bottom: 1rem;
    }

    .form-label-inline {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label-inline i {
        color: var(--primary-color);
    }

    .optional-text {
        color: rgba(255, 255, 255, 0.4);
        font-size: 0.8rem;
        font-weight: 400;
    }

    .form-select-inline {
        width: 100%;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--light-border);
        border-radius: 10px;
        color: white;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .form-select-inline:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-select-inline option {
        background: #1f2937;
        color: white;
        padding: 0.75rem;
    }

    .form-textarea-inline {
        width: 100%;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--light-border);
        border-radius: 10px;
        color: white;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        resize: vertical;
        font-family: inherit;
    }

    .form-textarea-inline:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-textarea-inline::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-text-helper {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        margin-top: 0.5rem;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .form-text-helper i {
        font-size: 0.85rem;
    }

    .form-text-helper strong {
        color: var(--primary-color);
    }

    /* Submit Buttons */
    .btn-submit-inline {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.875rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 12px;
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        border: none;
        cursor: pointer;
    }

    .btn-submit-inline:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(16, 185, 129, 0.4);
    }

    .btn-submit-inline.primary {
        background: linear-gradient(135deg, var(--info-color) 0%, #2563eb 100%);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-submit-inline.primary:hover {
        box-shadow: 0 6px 25px rgba(59, 130, 246, 0.4);
    }

    /* Divider */
    .divider-or {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
        color: rgba(255, 255, 255, 0.4);
        font-size: 0.8rem;
        font-weight: 600;
    }

    .divider-or::before,
    .divider-or::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--light-border);
    }

    .divider-or span {
        padding: 0 1rem;
    }

    /* Quick Buttons */
    .quick-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .btn-quick {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.75rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: 1px solid var(--light-border);
        cursor: pointer;
    }

    .btn-quick.success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--primary-color);
        border-color: rgba(16, 185, 129, 0.3);
    }

    .btn-quick.success:hover {
        background: rgba(16, 185, 129, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
    }

    .btn-quick.danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border-color: rgba(239, 68, 68, 0.3);
    }

    .btn-quick.danger:hover {
        background: rgba(239, 68, 68, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
    }

    /* Order Info List */
    .order-info-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .order-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.875rem;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .order-info-item .label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        font-weight: 600;
    }

    .order-info-item .value {
        color: white;
        font-weight: 600;
        text-align: right;
    }

    /* Mini Badges */
    .mini-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .mini-badge.success {
        background: rgba(16, 185, 129, 0.15);
        color: var(--primary-color);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .mini-badge.warning {
        background: rgba(245, 158, 11, 0.15);
        color: var(--warning-color);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .mini-badge.danger {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger-color);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .mini-badge.info {
        background: rgba(59, 130, 246, 0.15);
        color: var(--info-color);
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .mini-badge.secondary {
        background: rgba(107, 114, 128, 0.15);
        color: #9ca3af;
        border: 1px solid rgba(107, 114, 128, 0.3);
    }

    /* View Order Button */
    .view-order-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.875rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 12px;
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .view-order-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(16, 185, 129, 0.4);
        color: white;
    }

    /* Danger Zone */
    .danger-zone {
        border: 2px solid rgba(239, 68, 68, 0.3);
    }

    .danger-zone .card-body-detail {
        padding: 1.5rem;
    }

    .delete-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        width: 100%;
        padding: 1rem;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 12px;
        color: var(--danger-color);
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .delete-btn:hover {
        background: rgba(239, 68, 68, 0.2);
        border-color: var(--danger-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(239, 68, 68, 0.3);
    }

    .delete-btn i {
        font-size: 1.25rem;
    }

    /* Image Modal */
    .image-modal-content {
        background: rgba(17, 24, 39, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid var(--light-border);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .status-badge-xl {
            min-width: auto;
            flex-direction: column;
            text-align: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .card-header-detail {
            flex-direction: column;
            align-items: flex-start;
        }

        .back-button {
            font-size: 0.9rem;
            padding: 0.65rem 1.25rem;
        }

        .status-badge-xl {
            padding: 1.25rem 1.5rem;
        }

        .card-body-detail {
            padding: 1.5rem;
        }
    }
</style>

<script>
function openImageModal(imageSrc) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageSrc;
    modal.show();
}

// Show/hide rejection reason field based on status
document.addEventListener('DOMContentLoaded', function() {
    const paymentStatusSelect = document.getElementById('payment_status');
    const rejectionReasonGroup = document.getElementById('rejection_reason_group');
    
    if (paymentStatusSelect && rejectionReasonGroup) {
        paymentStatusSelect.addEventListener('change', function() {
            if (this.value === 'rejected') {
                rejectionReasonGroup.style.display = 'block';
            } else {
                rejectionReasonGroup.style.display = 'none';
            }
        });
        
        // Check initial value
        if (paymentStatusSelect.value === 'rejected') {
            rejectionReasonGroup.style.display = 'block';
        }
    }

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endsection