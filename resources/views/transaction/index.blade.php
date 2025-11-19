@extends('layouts.app')

@section('title', 'Kelola Transaction')

@section('content')
<style>
    /* Custom Enhanced Styling */
    .page-header-enhanced {
        background: linear-gradient(135deg, rgba(22, 163, 74, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header-enhanced::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(34, 197, 94, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .page-header-enhanced .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .page-header-enhanced h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, #fff 0%, #22c55e 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .page-header-enhanced h1 i {
        color: #16a34a;
        -webkit-text-fill-color: #16a34a;
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .action-btn-enhanced {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .action-btn-enhanced::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .action-btn-enhanced:hover::before {
        width: 300px;
        height: 300px;
    }

    .action-btn-enhanced span {
        position: relative;
        z-index: 1;
    }

    .btn-pending {
        background: linear-gradient(135deg, rgba(249, 115, 22, 0.2) 0%, rgba(249, 115, 22, 0.1) 100%);
        color: #fb923c;
        border: 1px solid rgba(249, 115, 22, 0.4);
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.2);
    }

    .btn-pending:hover {
        border-color: #f97316;
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.3);
        transform: translateY(-2px);
    }

    .btn-statistics {
        background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        color: white;
        border: 1px solid rgba(34, 197, 94, 0.4);
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .btn-statistics:hover {
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
        transform: translateY(-2px);
    }

    .badge-count-enhanced {
        background: rgba(255, 255, 255, 0.25);
        padding: 0.25rem 0.6rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Enhanced Filter Section */
    .filter-card-enhanced {
        background: linear-gradient(135deg, rgba(22, 163, 74, 0.08) 0%, rgba(34, 197, 94, 0.04) 100%);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(34, 197, 94, 0.1);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .input-enhanced {
        width: 100%;
        padding: 0.85rem 1rem;
        background: rgba(10, 31, 10, 0.6);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 0.75rem;
        color: white;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .input-enhanced:focus {
        outline: none;
        border-color: #16a34a;
        background: rgba(34, 197, 94, 0.1);
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15);
    }

    .input-enhanced::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    select.input-enhanced {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2316a34a' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 2.5rem;
        cursor: pointer;
    }

    select.input-enhanced option {
        background: #1a3a1a;
        color: white;
        padding: 0.5rem;
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-filter-enhanced {
        flex: 1;
        padding: 0.85rem 1.5rem;
        border: none;
        border-radius: 0.75rem;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-filter-submit {
        background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .btn-filter-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
    }

    .btn-filter-reset {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .btn-filter-reset:hover {
        background: rgba(34, 197, 94, 0.2);
        border-color: #16a34a;
    }

    /* Enhanced Table Card */
    .table-card-enhanced {
        background: linear-gradient(135deg, rgba(22, 163, 74, 0.08) 0%, rgba(34, 197, 94, 0.04) 100%);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(34, 197, 94, 0.1);
    }

    .table-enhanced {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table-enhanced thead {
        background: linear-gradient(135deg, rgba(22, 163, 74, 0.15) 0%, rgba(34, 197, 94, 0.1) 100%);
    }

    .table-enhanced thead th {
        padding: 1.25rem 1.5rem;
        text-align: left;
        color: #22c55e;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(34, 197, 94, 0.3);
    }

    .table-enhanced tbody tr {
        border-bottom: 1px solid rgba(34, 197, 94, 0.1);
        transition: all 0.3s ease;
    }

    .table-enhanced tbody tr:hover {
        background: rgba(34, 197, 94, 0.08);
        transform: scale(1.01);
    }

    .table-enhanced tbody td {
        padding: 1.25rem 1.5rem;
        color: #e5e7eb;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    /* Enhanced Order Number */
    .order-number-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .order-icon {
        width: 40px;
        height: 40px;
        border-radius: 0.5rem;
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(34, 197, 94, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #22c55e;
        font-size: 1.2rem;
    }

    .order-number {
        font-weight: 700;
        color: white;
        font-size: 0.95rem;
    }

    /* Enhanced Amount */
    .amount-enhanced {
        font-weight: 700;
        color: #22c55e;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .amount-enhanced i {
        font-size: 1.2rem;
    }

    /* Enhanced Badges */
    .badge-enhanced {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.85rem;
        border: 1px solid;
    }

    .badge-cash {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
        border-color: rgba(34, 197, 94, 0.4);
    }

    .badge-transfer {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border-color: rgba(59, 130, 246, 0.4);
    }

    .badge-qris {
        background: rgba(168, 85, 247, 0.15);
        color: #c084fc;
        border-color: rgba(168, 85, 247, 0.4);
    }

    .badge-confirmed {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
        border-color: rgba(34, 197, 94, 0.4);
    }

    .badge-pending {
        background: rgba(249, 115, 22, 0.15);
        color: #fb923c;
        border-color: rgba(249, 115, 22, 0.4);
    }

    .badge-rejected {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.4);
    }

    /* Enhanced Action Buttons */
    .action-buttons-group {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-action-table {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        border: 1px solid;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-view {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border-color: rgba(59, 130, 246, 0.4);
    }

    .btn-view:hover {
        background: rgba(59, 130, 246, 0.25);
        border-color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-edit {
        background: rgba(249, 115, 22, 0.15);
        color: #fb923c;
        border-color: rgba(249, 115, 22, 0.4);
    }

    .btn-edit:hover {
        background: rgba(249, 115, 22, 0.25);
        border-color: #f97316;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.4);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.25);
        border-color: #ef4444;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    /* Empty State Enhanced */
    .empty-state-enhanced {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: rgba(34, 197, 94, 0.3);
        margin-bottom: 1rem;
        animation: float 3s ease-in-out infinite;
    }

    .empty-state-enhanced h3 {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .empty-state-enhanced p {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.9rem;
    }

    /* Enhanced Modal */
    .modal-content-enhanced {
        background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .modal-header-enhanced {
        border-bottom: 1px solid rgba(34, 197, 94, 0.2);
        padding: 1.5rem;
        background: rgba(34, 197, 94, 0.05);
    }

    .modal-title-enhanced {
        color: #22c55e;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .modal-body-enhanced {
        padding: 2rem 1.5rem;
    }

    .form-group-enhanced {
        margin-bottom: 1.5rem;
    }

    .form-label-enhanced {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-footer-enhanced {
        border-top: 1px solid rgba(34, 197, 94, 0.2);
        padding: 1.5rem;
        background: rgba(34, 197, 94, 0.05);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header-enhanced h1 {
            font-size: 1.5rem;
        }

        .header-actions {
            width: 100%;
        }

        .action-btn-enhanced {
            flex: 1;
            justify-content: center;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .table-card-enhanced {
            overflow-x: auto;
        }

        .action-buttons-group {
            flex-direction: column;
        }

        .btn-action-table {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header-enhanced">
    <div class="header-content">
        <h1>
            <i class="bi bi-receipt-cutoff"></i>
            Kelola Transaction
        </h1>
        <div class="header-actions">
            <a href="{{ route('transaction.pending') }}" class="action-btn-enhanced btn-pending">
                <span><i class="bi bi-clock-history"></i></span>
                <span>Pending</span>
                <span class="badge-count-enhanced">3</span>
            </a>
            <a href="{{ route('transaction.statistics') }}" class="action-btn-enhanced btn-statistics">
                <span><i class="bi bi-bar-chart-fill"></i></span>
                <span>Statistics</span>
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
<div class="filter-card-enhanced">
    <form method="GET" action="{{ route('transaction.index') }}">
        <div class="filter-grid">
            <div>
                <input 
                    type="text" 
                    name="search" 
                    class="input-enhanced" 
                    placeholder="🔍 Cari nomor order, customer, atau telepon..." 
                    value="{{ request('search') }}"
                >
            </div>

            <div>
                <select name="payment_method" class="input-enhanced">
                    <option value="">💳 Semua Payment</option>
                    <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>💵 Cash</option>
                    <option value="transfer" {{ request('payment_method') === 'transfer' ? 'selected' : '' }}>🏦 Transfer</option>
                    <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}>📱 QRIS</option>
                </select>
            </div>

            <div>
                <select name="status" class="input-enhanced">
                    <option value="">📊 Semua Status</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>✅ Confirmed</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏱️ Pending</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                </select>
            </div>

            <div class="filter-buttons">
                <button type="submit" class="btn-filter-enhanced btn-filter-submit">
                    <i class="bi bi-search"></i>
                    <span>Filter</span>
                </button>
                <a href="{{ route('transaction.index') }}" class="btn-filter-enhanced btn-filter-reset">
                    <i class="bi bi-arrow-clockwise"></i>
                    <span>Reset</span>
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Transactions Table -->
<div class="table-card-enhanced">
    <div style="overflow-x: auto;">
        <table class="table-enhanced">
            <thead>
                <tr>
                    <th><i class="bi bi-hash me-2"></i>Order Number</th>
                    <th><i class="bi bi-person me-2"></i>Customer</th>
                    <th><i class="bi bi-envelope me-2"></i>Email</th>
                    <th><i class="bi bi-cash-coin me-2"></i>Amount</th>
                    <th><i class="bi bi-credit-card me-2"></i>Payment</th>
                    <th><i class="bi bi-check-circle me-2"></i>Status</th>
                    <th><i class="bi bi-gear me-2"></i>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>
                            <div class="order-number-cell">
                                <div class="order-icon">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <span class="order-number">{{ $transaction->order->order_number ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $transaction->order->customer->name ?? 'N/A' }}</div>
                            <div style="font-size: 0.8rem; color: rgba(255, 255, 255, 0.5);">
                                <i class="bi bi-telephone"></i> {{ $transaction->order->customer->phone ?? '-' }}
                            </div>
                        </td>
                        <td>{{ $transaction->order->customer->email ?? '-' }}</td>
                        <td>
                            <span class="amount-enhanced">
                                <i class="bi bi-currency-dollar"></i>
                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            @if($transaction->payment_method === 'cash')
                                <span class="badge-enhanced badge-cash">
                                    <i class="bi bi-cash"></i> Cash
                                </span>
                            @elseif($transaction->payment_method === 'transfer')
                                <span class="badge-enhanced badge-transfer">
                                    <i class="bi bi-bank"></i> Transfer
                                </span>
                            @else
                                <span class="badge-enhanced badge-qris">
                                    <i class="bi bi-qr-code"></i> QRIS
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($transaction->status === 'confirmed')
                                <span class="badge-enhanced badge-confirmed">
                                    <i class="bi bi-check-circle-fill"></i> Confirmed
                                </span>
                            @elseif($transaction->status === 'pending')
                                <span class="badge-enhanced badge-pending">
                                    <i class="bi bi-clock-fill"></i> Pending
                                </span>
                            @else
                                <span class="badge-enhanced badge-rejected">
                                    <i class="bi bi-x-circle-fill"></i> Rejected
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons-group">
                                <a href="{{ route('transaction.show', $transaction) }}" class="btn-action-table btn-view">
                                    <i class="bi bi-eye"></i> View
                                </a>

                                @if($transaction->status === 'pending')
                                    <button type="button" onclick="openEditModal({{ $transaction->id }}, '{{ $transaction->payment_method }}', '{{ $transaction->status }}')" class="btn-action-table btn-edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                @endif

                                <form action="{{ route('transaction.destroy', $transaction) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus transaction ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-table btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state-enhanced">
                                <div class="empty-icon">
                                    <i class="bi bi-inbox"></i>
                                </div>
                                <h3>Tidak Ada Transaction</h3>
                                <p>Belum ada data transaction yang tersedia saat ini</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($transactions->hasPages())
        <div style="display: flex; justify-content: center; padding: 1.5rem; border-top: 1px solid rgba(34, 197, 94, 0.1);">
            {{ $transactions->links() }}
        </div>
    @endif
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-enhanced">
            <div class="modal-header modal-header-enhanced">
                <h5 class="modal-title modal-title-enhanced">
                    <i class="bi bi-pencil-square"></i>
                    Update Transaction
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: brightness(0) invert(1);"></button>
            </div>
            
            <form id="editForm" method="POST">
                @csrf
                
                <div class="modal-body modal-body-enhanced">
                    <div class="form-group-enhanced">
                        <label for="edit_payment_method" class="form-label-enhanced">
                            <i class="bi bi-credit-card"></i> Payment Method
                        </label>
                        <select name="payment_method" id="edit_payment_method" class="input-enhanced" required>
                            <option value="cash">💵 Cash (Tunai)</option>
                            <option value="transfer">🏦 Transfer Bank</option>
                            <option value="qris">📱 QRIS</option>
                        </select>
                    </div>

                    <div class="form-group-enhanced">
                        <label for="edit_status" class="form-label-enhanced">
                            <i class="bi bi-check-circle"></i> Payment Status
                        </label>
                        <select name="status" id="edit_status" class="input-enhanced" required>
                            <option value="pending">⏱️ Pending (Menunggu)</option>
                            <option value="confirmed">✅ Confirmed (Terkonfirmasi)</option>
                            <option value="rejected">❌ Rejected (Ditolak)</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer modal-footer-enhanced">
                    <button type="button" class="btn-filter-enhanced btn-filter-reset" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn-filter-enhanced btn-filter-submit">
                        <i class="bi bi-check-lg"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Add smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Enhanced table row animation on load
    const tableRows = document.querySelectorAll('.table-enhanced tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        setTimeout(() => {
            row.style.transition = 'all 0.5s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);
    });

    // Add loading state to buttons
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !this.hasAttribute('onsubmit')) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';
            }
        });
    });

    // Initialize tooltips if Bootstrap is loaded
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});

// Add ripple effect to buttons
document.querySelectorAll('.btn-filter-enhanced, .btn-action-table, .action-btn-enhanced').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.5)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s ease-out';
        ripple.style.pointerEvents = 'none';
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    });
});

// Add CSS for ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    /* Smooth transitions for all interactive elements */
    * {
        -webkit-tap-highlight-color: transparent;
    }
    
    /* Custom scrollbar for table */
    .table-card-enhanced::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-card-enhanced::-webkit-scrollbar-track {
        background: rgba(34, 197, 94, 0.1);
        border-radius: 4px;
    }
    
    .table-card-enhanced::-webkit-scrollbar-thumb {
        background: rgba(34, 197, 94, 0.3);
        border-radius: 4px;
    }
    
    .table-card-enhanced::-webkit-scrollbar-thumb:hover {
        background: rgba(34, 197, 94, 0.5);
    }
    
    /* Loading animation */
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .bi-hourglass-split {
        animation: spin 1s linear infinite;
    }
    
    /* Focus visible for accessibility */
    *:focus-visible {
        outline: 2px solid #16a34a;
        outline-offset: 2px;
    }
`;
document.head.appendChild(style);
</script>

@endsection