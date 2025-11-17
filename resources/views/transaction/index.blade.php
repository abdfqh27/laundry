@extends('layouts.app')

@section('title', 'Kelola Transaction')

@section('content')
<style>
    /* Custom styling for select dropdown */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        padding-right: 2.5rem;
    }
    
    select:focus {
        outline: none;
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    select:active {
        background-color: rgba(99, 102, 241, 0.1) !important;
    }
    
    select option {
        background-color: #1f2937;
        color: white;
        padding: 0.5rem;
    }
    
    select option:hover {
        background-color: #6366f1;
    }
    
    input[type="text"]:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
</style>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Kelola Transaction</h1>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('transaction.pending') }}" style="
                background-color: rgba(249, 115, 22, 0.2);
                color: #fb923c;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                border: 1px solid rgba(249, 115, 22, 0.3);
            " onmouseover="this.style.backgroundColor='rgba(249, 115, 22, 0.3)'" onmouseout="this.style.backgroundColor='rgba(249, 115, 22, 0.2)'">
                <i class="bi bi-clock-history"></i> Pending <span style="background: rgba(255, 255, 255, 0.2); padding: 0.2rem 0.5rem; border-radius: 1rem; font-size: 0.75rem;">3</span>
            </a>
            <a href="{{ route('transaction.statistics') }}" style="
                background-color: #6366f1;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                text-decoration: none;
                font-weight: 600;
                transition: background-color 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            " onmouseover="this.style.backgroundColor='#4f46e5'" onmouseout="this.style.backgroundColor='#6366f1'">
                <i class="bi bi-bar-chart-fill"></i> Statistics
            </a>
        </div>
    </div>
</div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

<!-- Filter Section -->
<div class="data-card" style="margin-bottom: 2rem;">
    <form method="GET" action="{{ route('transaction.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
        <!-- Search -->
        <div>
            <input type="text" name="search" id="searchInput" placeholder="Cari nomor order, customer, atau telepon..." value="{{ request('search') }}" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.9rem;
                transition: all 0.3s ease;
            ">
        </div>

        <!-- Payment Method Filter -->
        <div>
            <select name="payment_method" id="paymentFilter" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.9rem;
                cursor: pointer;
                transition: all 0.3s ease;
            ">
                <option value="">Semua Payment</option>
                <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ request('payment_method') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}>QRIS</option>
            </select>
        </div>

        <!-- Status Filter -->
        <div>
            <select name="status" id="statusFilter" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.9rem;
                cursor: pointer;
                transition: all 0.3s ease;
            ">
                <option value="">Semua Status</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <!-- Buttons -->
        <div style="display: flex; gap: 0.5rem; align-items: flex-end;">
            <button type="submit" style="
                flex: 1;
                padding: 0.75rem;
                background-color: #6366f1;
                color: white;
                border: none;
                border-radius: 0.5rem;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.3s ease;
            " onmouseover="this.style.backgroundColor='#4f46e5'" onmouseout="this.style.backgroundColor='#6366f1'">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('transaction.index') }}" style="
                padding: 0.75rem 1rem;
                background-color: rgba(99, 102, 241, 0.2);
                color: #6366f1;
                border: 1px solid rgba(99, 102, 241, 0.3);
                border-radius: 0.5rem;
                text-decoration: none;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </a>
        </div>
    </form>
</div>

<!-- Transactions Table -->
<div class="data-card">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Order Number</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Customer</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Email</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Amount</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Payment</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Status</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 1rem; color: #e5e7eb;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-receipt" style="color: #6366f1;"></i>
                                <span style="font-weight: 600;">{{ $transaction->order->order_number ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td style="padding: 1rem; color: #e5e7eb;">{{ $transaction->order->customer->name ?? 'N/A' }}</td>
                        <td style="padding: 1rem; color: #e5e7eb;">{{ $transaction->order->customer->email ?? '-' }}</td>
                        <td style="padding: 1rem;">
                            <span style="font-weight: 700; color: #10b981; font-size: 0.95rem;">
                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            @if($transaction->payment_method === 'cash')
                                <span class="badge badge-success">Cash</span>
                            @elseif($transaction->payment_method === 'transfer')
                                <span class="badge badge-processing">Transfer</span>
                            @else
                                <span class="badge badge-danger">QRIS</span>
                            @endif
                        </td>
                        <td style="padding: 1rem;">
                            @if($transaction->status === 'confirmed')
                                <span class="badge badge-success">Confirmed</span>
                            @elseif($transaction->status === 'pending')
                                <span class="badge badge-processing">Pending</span>
                            @else
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>
                        <td style="padding: 1rem;">
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <!-- View Button -->
                                <a href="{{ route('transaction.show', $transaction) }}" style="
                                    background-color: rgba(99, 102, 241, 0.2);
                                    color: #6366f1;
                                    padding: 0.4rem 0.8rem;
                                    border-radius: 0.25rem;
                                    text-decoration: none;
                                    font-size: 0.85rem;
                                    transition: all 0.3s ease;
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 0.3rem;
                                " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'">
                                    <i class="bi bi-eye"></i> Edit
                                </a>

                                @if($transaction->status === 'pending')
                                    <!-- Edit Button -->
                                    <button type="button" onclick="openEditModal({{ $transaction->id }}, '{{ $transaction->payment_method }}', '{{ $transaction->status }}')" style="
                                        background-color: rgba(249, 115, 22, 0.2);
                                        color: #fb923c;
                                        padding: 0.4rem 0.8rem;
                                        border-radius: 0.25rem;
                                        border: none;
                                        font-size: 0.85rem;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 0.3rem;
                                    " onmouseover="this.style.backgroundColor='rgba(249, 115, 22, 0.3)'" onmouseout="this.style.backgroundColor='rgba(249, 115, 22, 0.2)'">
                                        <i class="bi bi-pencil"></i> Nonaktifkan
                                    </button>
                                @endif

                                <!-- Delete Button -->
                                <form action="{{ route('transaction.destroy', $transaction) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus transaction ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="
                                        background-color: rgba(239, 68, 68, 0.2);
                                        color: #f87171;
                                        padding: 0.4rem 0.8rem;
                                        border-radius: 0.25rem;
                                        border: none;
                                        font-size: 0.85rem;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 0.3rem;
                                    " onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.3)'" onmouseout="this.style.backgroundColor='rgba(239, 68, 68, 0.2)'">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 2rem; text-align: center; color: #9ca3af;">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                            Tidak ada transaction
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($transactions->hasPages())
        <div style="display: flex; justify-content: center; margin-top: 2rem; gap: 0.5rem;">
            {{ $transactions->links() }}
        </div>
    @endif
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i>Update Transaction
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form id="editForm" method="POST">
                @csrf
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_payment_method" class="form-label">
                            <i class="bi bi-credit-card me-1"></i> Payment Method
                        </label>
                        <select name="payment_method" id="edit_payment_method" class="form-select" required>
                            <option value="cash">💵 Cash (Tunai)</option>
                            <option value="transfer">🏦 Transfer Bank</option>
                            <option value="qris">📱 QRIS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">
                            <i class="bi bi-check-circle me-1"></i> Payment Status
                        </label>
                        <select name="status" id="edit_status" class="form-select" required>
                            <option value="pending">⏱️ Pending (Menunggu)</option>
                            <option value="confirmed">✅ Confirmed (Terkonfirmasi)</option>
                            <option value="rejected">❌ Rejected (Ditolak)</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Base Styles */
    body {
        background: linear-gradient(135deg, #0a3d2e 0%, #0d1f1a 100%);
        color: #e5e7eb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container-fluid {
        max-width: 1400px;
    }

    /* Header Section */
    .header-section {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #f9fafb;
        margin: 0;
    }

    .highlight-text {
        color: #10b981;
    }

    /* Action Buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.9rem;
    }

    .btn-warning {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .btn-warning:hover {
        background: rgba(245, 158, 11, 0.25);
        color: #fbbf24;
        transform: translateY(-2px);
    }

    .btn-primary {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        background: rgba(59, 130, 246, 0.25);
        color: #60a5fa;
        transform: translateY(-2px);
    }

    .badge-count {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.2rem 0.5rem;
        border-radius: 12px;
        font-size: 0.75rem;
    }

    /* Alert Messages */
    .alert {
        border: none;
        border-radius: 10px;
        padding: 1rem 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #10b981;
        color: #d1fae5;
    }

    .alert-danger {
        border-left-color: #ef4444;
        color: #fecaca;
    }

    /* Filter Section */
    .filter-section {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .form-control-custom,
    .form-select-custom {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        padding: 0.65rem 1rem;
        color: #f9fafb;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        background: rgba(255, 255, 255, 0.12);
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        outline: none;
        color: #f9fafb;
    }

    .form-control-custom::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .form-select-custom option {
        background: #1f2937;
        color: #f9fafb;
    }

    .btn-filter,
    .btn-reset {
        padding: 0.65rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-filter {
        background: rgba(99, 102, 241, 0.15);
        color: #818cf8;
        border: 1px solid rgba(99, 102, 241, 0.3);
        margin-right: 0.5rem;
    }

    .btn-filter:hover {
        background: rgba(99, 102, 241, 0.25);
        transform: translateY(-2px);
    }

    .btn-reset {
        background: rgba(107, 114, 128, 0.15);
        color: #9ca3af;
        border: 1px solid rgba(107, 114, 128, 0.3);
    }

    .btn-reset:hover {
        background: rgba(107, 114, 128, 0.25);
        transform: translateY(-2px);
    }

    /* Table Card */
    .table-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    /* Custom Table */
    .custom-table {
        color: #e5e7eb;
        margin: 0;
    }

    .custom-table thead {
        background: rgba(255, 255, 255, 0.05);
    }

    .custom-table thead th {
        padding: 1rem 1.5rem;
        font-weight: 600;
        font-size: 0.85rem;
        color: #9ca3af;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .custom-table tbody td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        vertical-align: middle;
        color: #f3f4f6;
        font-size: 0.9rem;
    }

    .table-row {
        transition: all 0.3s ease;
    }

    .table-row:hover {
        background: rgba(16, 185, 129, 0.08);
    }

    /* Amount Text */
    .amount-text {
        font-weight: 700;
        color: #10b981;
        font-size: 1rem;
    }

    /* Badge Styles */
    .badge-payment {
        display: inline-block;
        padding: 0.4rem 0.9rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: capitalize;
    }

    .badge-payment.cash {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .badge-payment.transfer {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .badge-payment.qris {
        background: rgba(168, 85, 247, 0.15);
        color: #c084fc;
        border: 1px solid rgba(168, 85, 247, 0.3);
    }

    .badge-status {
        display: inline-block;
        padding: 0.4rem 0.9rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: capitalize;
    }

    .badge-status.aktif {
        background: rgba(16, 185, 129, 0.15);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .badge-status.nonaktif {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .badge-status.rejected {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* Date Info */
    .date-info {
        display: flex;
        flex-direction: column;
    }

    .date-text {
        font-weight: 600;
        color: #e5e7eb;
        font-size: 0.9rem;
    }

    .time-text {
        color: #9ca3af;
        font-size: 0.8rem;
    }

    /* Action Buttons Group */
    .action-buttons-group {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 0.9rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-action.view {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .btn-action.view:hover {
        background: rgba(59, 130, 246, 0.25);
        transform: translateY(-2px);
    }

    .btn-action.edit {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .btn-action.edit:hover {
        background: rgba(245, 158, 11, 0.25);
        transform: translateY(-2px);
    }

    .btn-action.confirm {
        background: rgba(16, 185, 129, 0.15);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .btn-action.confirm:hover {
        background: rgba(16, 185, 129, 0.25);
        transform: translateY(-2px);
    }

    .btn-action.delete {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-action.delete:hover {
        background: rgba(239, 68, 68, 0.25);
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        padding: 3rem 2rem;
        text-align: center;
    }

    /* Table Footer */
    .table-footer {
        padding: 1.5rem 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        background: rgba(255, 255, 255, 0.02);
    }

    /* Pagination */
    .pagination {
        margin: 0;
        gap: 0.5rem;
    }

    .pagination .page-link {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #e5e7eb;
        padding: 0.5rem 0.9rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .pagination .page-link:hover {
        background: rgba(16, 185, 129, 0.15);
        border-color: #10b981;
        color: #10b981;
    }

    .pagination .page-item.active .page-link {
        background: rgba(16, 185, 129, 0.2);
        border-color: #10b981;
        color: #10b981;
    }

    .pagination .page-item.disabled .page-link {
        background: rgba(255, 255, 255, 0.02);
        border-color: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.3);
    }

    /* Modal Styles */
    .modal-content {
        background: #1f2937;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #f9fafb;
    }

    .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.05);
    }

    .modal-title {
        color: #f9fafb;
        font-weight: 700;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-body .form-label {
        color: #e5e7eb;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .modal-body .form-select {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #f9fafb;
        border-radius: 8px;
    }

    .modal-body .form-select:focus {
        background: rgba(255, 255, 255, 0.12);
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        color: #f9fafb;
    }

    .modal-body .form-select option {
        background: #1f2937;
        color: #f9fafb;
    }

    .modal-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.02);
    }

    .btn-close {
        filter: invert(1);
        opacity: 0.7;
    }

    .btn-close:hover {
        opacity: 1;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }

        .action-buttons-group {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .filter-section .row {
            gap: 1rem;
        }

        .btn-filter,
        .btn-reset {
            width: 100%;
        }
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
    // Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('.custom-table tbody .table-row');
            
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

    // Filter functionality
    const filterBtn = document.getElementById('filterBtn');
    const resetBtn = document.getElementById('resetBtn');
    const paymentFilter = document.getElementById('paymentFilter');
    const statusFilter = document.getElementById('statusFilter');

    if (filterBtn) {
        filterBtn.addEventListener('click', function() {
            const paymentValue = paymentFilter.value.toLowerCase();
            const statusValue = statusFilter.value.toLowerCase();
            const tableRows = document.querySelectorAll('.custom-table tbody .table-row');
            
            tableRows.forEach(row => {
                const paymentText = row.querySelector('.badge-payment').textContent.toLowerCase();
                const statusText = row.querySelector('.badge-status').textContent.toLowerCase();
                
                const paymentMatch = !paymentValue || paymentText.includes(paymentValue);
                const statusMatch = !statusValue || statusText.includes(statusValue);
                
                if (paymentMatch && statusMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            searchInput.value = '';
            paymentFilter.value = '';
            statusFilter.value = '';
            
            const tableRows = document.querySelectorAll('.custom-table tbody .table-row');
            tableRows.forEach(row => {
                row.style.display = '';
            });
        });
    }
});
</script>
@endsection