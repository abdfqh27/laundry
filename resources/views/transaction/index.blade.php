@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Enhanced Header with Gradient -->
    <div class="header-section mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-content">
                <div class="header-icon-wrapper">
                    <i class="bi bi-receipt-cutoff"></i>
                </div>
                <div>
                    <h1 class="page-title mb-2">All Transactions</h1>
                    <p class="page-subtitle mb-0">
                        <i class="bi bi-info-circle"></i> 
                        Manage and monitor all payment transactions
                    </p>
                </div>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('transaction.pending') }}" class="action-btn btn-warning-gradient">
                    <i class="bi bi-clock-history"></i>
                    <span>Pending</span>
                    <span class="badge-count">3</span>
                </a>
                <a href="{{ route('transaction.statistics') }}" class="action-btn btn-primary-gradient">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Statistics</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages with Animation -->
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

    <!-- Enhanced Table Card -->
    <div class="modern-card">
        <div class="card-header-modern">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><i class="bi bi-table"></i> Transaction List</h5>
                    <small class="text-muted">Total: {{ $transactions->total() }} transactions</small>
                </div>
                <div class="search-wrapper">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" placeholder="Search transactions..." class="form-control">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table modern-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>
                            <i class="bi bi-hash"></i> Order Number
                        </th>
                        <th>
                            <i class="bi bi-person"></i> Customer
                        </th>
                        <th>
                            <i class="bi bi-currency-dollar"></i> Amount
                        </th>
                        <th>
                            <i class="bi bi-credit-card"></i> Payment
                        </th>
                        <th>
                            <i class="bi bi-toggle-on"></i> Status
                        </th>
                        <th>
                            <i class="bi bi-calendar-event"></i> Date
                        </th>
                        <th class="text-center">
                            <i class="bi bi-gear"></i> Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr class="table-row-hover">
                            <td>
                                <div class="order-number">
                                    <i class="bi bi-receipt"></i>
                                    <span>{{ $transaction->order->order_number ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="avatar-circle">
                                        {{ substr($transaction->order->customer->name ?? 'N', 0, 1) }}
                                    </div>
                                    <span>{{ $transaction->order->customer->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="amount-display">
                                    <span class="currency">Rp</span>
                                    <span class="value">{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                </div>
                            </td>
                            <td>
                                @if($transaction->payment_method === 'cash')
                                    <span class="payment-badge cash">
                                        <i class="bi bi-cash-stack"></i> CASH
                                    </span>
                                @elseif($transaction->payment_method === 'transfer')
                                    <span class="payment-badge transfer">
                                        <i class="bi bi-bank"></i> TRANSFER
                                    </span>
                                @else
                                    <span class="payment-badge qris">
                                        <i class="bi bi-qr-code-scan"></i> QRIS
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($transaction->status === 'confirmed')
                                    <span class="status-badge confirmed">
                                        <span class="pulse"></span>
                                        <i class="bi bi-check-circle-fill"></i> CONFIRMED
                                    </span>
                                @elseif($transaction->status === 'pending')
                                    <span class="status-badge pending">
                                        <span class="pulse"></span>
                                        <i class="bi bi-clock-fill"></i> PENDING
                                    </span>
                                @else
                                    <span class="status-badge rejected">
                                        <span class="pulse"></span>
                                        <i class="bi bi-x-circle-fill"></i> REJECTED
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="date-display">
                                    <i class="bi bi-calendar3"></i>
                                    <div>
                                        <div class="date-text">{{ $transaction->created_at->format('d M Y') }}</div>
                                        <small class="time-text">{{ $transaction->created_at->format('H:i') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('transaction.show', $transaction) }}" 
                                       class="action-icon view" 
                                       data-bs-toggle="tooltip" 
                                       title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @if($transaction->status === 'pending')
                                        <form action="{{ route('transaction.quick-confirm', $transaction) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            <button type="submit" 
                                                    onclick="return confirm('Konfirmasi pembayaran ini?')"
                                                    class="action-icon confirm"
                                                    data-bs-toggle="tooltip" 
                                                    title="Confirm">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>

                                        <button type="button" 
                                                onclick="openEditModal({{ $transaction->id }}, '{{ $transaction->payment_method }}', '{{ $transaction->status }}')"
                                                class="action-icon edit"
                                                data-bs-toggle="tooltip" 
                                                title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form action="{{ route('transaction.quick-reject', $transaction) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            <button type="submit" 
                                                    onclick="return confirm('Tolak pembayaran ini?')"
                                                    class="action-icon reject"
                                                    data-bs-toggle="tooltip" 
                                                    title="Reject">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('transaction.destroy', $transaction) }}" 
                                          method="POST" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus transaction ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-icon delete"
                                                data-bs-toggle="tooltip" 
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <h5>No Transactions Found</h5>
                                    <p class="text-muted">There are no transactions to display at the moment.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Enhanced Pagination -->
        <div class="card-footer-modern">
            {{ $transactions->links() }}
        </div>
    </div>
</div>

<!-- Enhanced Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header-modern">
                <div class="modal-title-wrapper">
                    <div class="modal-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h5 class="modal-title">Update Transaction</h5>
                </div>
                <button type="button" class="btn-close-modern" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <form id="editForm" method="POST">
                @csrf
                
                <div class="modal-body-modern">
                    <div class="form-group-modern mb-4">
                        <label for="edit_payment_method" class="form-label-modern">
                            <i class="bi bi-credit-card"></i> Payment Method
                        </label>
                        <select name="payment_method" id="edit_payment_method" class="form-select-modern" required>
                            <option value="cash">💵 Cash (Tunai)</option>
                            <option value="transfer">🏦 Transfer Bank</option>
                            <option value="qris">📱 QRIS</option>
                        </select>
                    </div>

                    <div class="form-group-modern">
                        <label for="edit_status" class="form-label-modern">
                            <i class="bi bi-check-circle"></i> Payment Status
                        </label>
                        <select name="status" id="edit_status" class="form-select-modern" required>
                            <option value="pending">⏱️ Pending (Menunggu)</option>
                            <option value="confirmed">✅ Confirmed (Terkonfirmasi)</option>
                            <option value="rejected">❌ Rejected (Ditolak)</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer-modern">
                    <button type="button" class="btn-modal cancel" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn-modal submit">
                        <i class="bi bi-check-lg"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Header Section */
    .header-section {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.05) 100%);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(16, 185, 129, 0.2);
        position: relative;
        overflow: hidden;
    }

    .header-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .header-icon-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff 0%, #d1d5db 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Action Buttons */
    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: none;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transition: left 0.3s ease;
    }

    .action-btn:hover::before {
        left: 100%;
    }

    .btn-warning-gradient {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 4px 20px rgba(245, 158, 11, 0.3);
    }

    .btn-warning-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 30px rgba(245, 158, 11, 0.4);
        color: white;
    }

    .btn-primary-gradient {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 30px rgba(59, 130, 246, 0.4);
        color: white;
    }

    .badge-count {
        background: rgba(255, 255, 255, 0.3);
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    /* Enhanced Alerts */
    .alert-success-custom, .alert-danger-custom {
        border: none;
        border-radius: 15px;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        backdrop-filter: blur(10px);
        animation: slideInDown 0.4s ease;
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
        border-left: 4px solid #10b981;
    }

    .alert-danger-custom {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.1) 100%);
        border-left: 4px solid #ef4444;
    }

    .alert-icon {
        font-size: 1.75rem;
        display: flex;
        align-items: center;
    }

    .alert-success-custom .alert-icon {
        color: #10b981;
    }

    .alert-danger-custom .alert-icon {
        color: #ef4444;
    }

    .alert-content strong {
        display: block;
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }

    /* Modern Card */
    .modern-card {
        background: rgba(17, 24, 39, 0.7);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .card-header-modern {
        padding: 2rem 2.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(5, 150, 105, 0.03) 50%, transparent 100%);
        position: relative;
        overflow: hidden;
    }

    .card-header-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent 0%, rgba(16, 185, 129, 0.03) 50%, transparent 100%);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .card-header-modern > div {
        position: relative;
        z-index: 1;
    }

    .card-header-modern h5 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        letter-spacing: 0.3px;
    }

    .card-header-modern h5 i {
        font-size: 1.6rem;
        color: #10b981;
        background: rgba(16, 185, 129, 0.15);
        padding: 0.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
    }

    .card-header-modern small {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(16, 185, 129, 0.1);
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        color: #10b981;
        font-weight: 600;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .card-header-modern small::before {
        content: '📊';
        font-size: 1rem;
    }

    /* Search Wrapper */
    .search-wrapper {
        position: relative;
        width: 300px;
    }

    .search-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.5);
        font-size: 1rem;
    }

    .search-wrapper input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 0.65rem 1rem 0.65rem 2.75rem;
        color: white;
        transition: all 0.3s ease;
    }

    .search-wrapper input:focus {
        background: rgba(255, 255, 255, 0.08);
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        outline: none;
    }

    .search-wrapper input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    /* Modern Table */
    .modern-table {
        color: white;
    }

    .modern-table thead {
        background: rgba(16, 185, 129, 0.1);
        border-bottom: 2px solid rgba(16, 185, 129, 0.3);
    }

    .modern-table thead th {
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: rgba(255, 255, 255, 0.9);
        border: none;
    }

    .modern-table thead th i {
        color: #10b981;
        margin-right: 0.5rem;
    }

    .modern-table tbody td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        vertical-align: middle;
        background: transparent;
    }

    .table-row-hover {
        transition: all 0.3s ease;
        background: rgba(0, 0, 0, 0.2);
    }

    .table-row-hover:hover {
        background: rgba(16, 185, 129, 0.08);
        transform: scale(1.005);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.1);
    }

    /* Order Number */
    .order-number {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        color: #60a5fa;
    }

    .order-number i {
        color: #3b82f6;
    }

    /* Customer Info */
    .customer-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    /* Amount Display */
    .amount-display {
        display: flex;
        align-items: baseline;
        gap: 0.25rem;
        font-weight: 700;
        color: #10b981;
        font-size: 1.1rem;
    }

    .amount-display .currency {
        font-size: 0.85rem;
        color: rgba(16, 185, 129, 0.7);
    }

    /* Payment Badges */
    .payment-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    .payment-badge.cash {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(34, 197, 94, 0.05) 100%);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .payment-badge.transfer {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%);
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .payment-badge.qris {
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.15) 0%, rgba(168, 85, 247, 0.05) 100%);
        color: #a855f7;
        border: 1px solid rgba(168, 85, 247, 0.3);
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        position: relative;
    }

    .status-badge .pulse {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        left: 0.75rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.5;
            transform: scale(1.2);
        }
    }

    .status-badge.confirmed {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0.05) 100%);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
        padding-left: 1.75rem;
    }

    .status-badge.confirmed .pulse {
        background: #10b981;
    }

    .status-badge.pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(245, 158, 11, 0.05) 100%);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.3);
        padding-left: 1.75rem;
    }

    .status-badge.pending .pulse {
        background: #f59e0b;
    }

    .status-badge.rejected {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.05) 100%);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding-left: 1.75rem;
    }

    .status-badge.rejected .pulse {
        background: #ef4444;
    }

    /* Date Display */
    .date-display {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .date-display i {
        font-size: 1.25rem;
        color: #10b981;
    }

    .date-text {
        font-weight: 600;
        color: white;
        font-size: 0.9rem;
    }

    .time-text {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.8rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .action-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .action-icon:hover {
        transform: translateY(-2px) scale(1.05);
    }

    .action-icon.view {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
        text-decoration: none;
    }

    .action-icon.view:hover {
        background: rgba(59, 130, 246, 0.25);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
    }

    .action-icon.confirm {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .action-icon.confirm:hover {
        background: rgba(16, 185, 129, 0.25);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }

    .action-icon.edit {
        background: rgba(245, 158, 11, 0.15);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .action-icon.edit:hover {
        background: rgba(245, 158, 11, 0.25);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
    }

    .action-icon.reject {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .action-icon.reject:hover {
        background: rgba(239, 68, 68, 0.25);
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
    }

    .action-icon.delete {
        background: rgba(220, 38, 38, 0.15);
        color: #dc2626;
        border: 1px solid rgba(220, 38, 38, 0.3);
    }

    .action-icon.delete:hover {
        background: rgba(220, 38, 38, 0.25);
        box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
    }

    /* Empty State */
    .empty-state {
        padding: 3rem 2rem;
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.05) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: rgba(16, 185, 129, 0.5);
    }

    .empty-state h5 {
        color: white;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.95rem;
    }

    /* Card Footer */
    .card-footer-modern {
        padding: 1.5rem 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(0, 0, 0, 0.2);
    }

    /* Enhanced Modal */
    .modern-modal {
        background: rgba(17, 24, 39, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.5);
    }

    .modal-header-modern {
        padding: 1.75rem 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, transparent 100%);
        border-radius: 20px 20px 0 0;
    }

    .modal-title-wrapper {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .modal-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .modal-title {
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
        margin: 0;
    }

    .btn-close-modern {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #ef4444;
        font-size: 1rem;
    }

    .btn-close-modern:hover {
        background: rgba(239, 68, 68, 0.25);
        transform: rotate(90deg);
    }

    .modal-body-modern {
        padding: 2rem;
    }

    .form-group-modern {
        position: relative;
    }

    .form-label-modern {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label-modern i {
        color: #10b981;
    }

    .form-select-modern {
        width: 100%;
        padding: 0.9rem 1.25rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: white;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .form-select-modern:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.08);
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-select-modern option {
        background: #1f2937;
        color: white;
        padding: 0.75rem;
    }

    .modal-footer-modern {
        padding: 1.5rem 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(0, 0, 0, 0.2);
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        border-radius: 0 0 20px 20px;
    }

    .btn-modal {
        padding: 0.85rem 1.75rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-modal.cancel {
        background: rgba(107, 114, 128, 0.15);
        color: #9ca3af;
        border: 1px solid rgba(107, 114, 128, 0.3);
    }

    .btn-modal.cancel:hover {
        background: rgba(107, 114, 128, 0.25);
        transform: translateY(-2px);
    }

    .btn-modal.submit {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-modal.submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 30px rgba(16, 185, 129, 0.4);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-wrapper {
            width: 100%;
        }

        .action-btn {
            font-size: 0.9rem;
            padding: 0.75rem 1.25rem;
        }
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.75rem;
        }

        .header-icon-wrapper {
            width: 60px;
            height: 60px;
            font-size: 1.75rem;
        }

        .modern-table thead th {
            font-size: 0.7rem;
            padding: 1rem;
        }

        .modern-table tbody td {
            padding: 1rem;
        }

        .action-buttons {
            gap: 0.35rem;
        }

        .action-icon {
            width: 34px;
            height: 34px;
            font-size: 0.85rem;
        }
    }

    /* Pagination Styling */
    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        padding: 0.6rem 1rem;
        margin: 0 0.25rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: rgba(16, 185, 129, 0.15);
        border-color: #10b981;
        color: #10b981;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-color: #10b981;
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .pagination .page-item.disabled .page-link {
        background: rgba(255, 255, 255, 0.02);
        border-color: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.3);
    }

    /* Scrollbar Styling */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }
</style>

<script>
function openEditModal(transactionId, paymentMethod, status) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    const form = document.getElementById('editForm');
    
    // Set form action URL
    form.action = `/transaction/${transactionId}/update-status`;
    
    // Set current values
    document.getElementById('edit_payment_method').value = paymentMethod;
    document.getElementById('edit_status').value = status;
    
    // Show modal
    modal.show();
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('.modern-table tbody tr');
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endsection