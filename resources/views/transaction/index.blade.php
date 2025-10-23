@extends('layouts.app')

@section('content')
<div style="
    margin-left: 250px;
    padding: 2rem;
    min-height: calc(100vh - 80px);
    background: linear-gradient(135deg, #0a1f0a 0%, #162d16 100%);
">
    <!-- Header -->
    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    ">
        <h1 style="
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin: 0;
        ">All Transactions</h1>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('transaction.pending') }}" style="
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                text-decoration: none;
                font-weight: 600;
                box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
                transition: all 0.3s;
            " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(245, 158, 11, 0.4)'" 
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(245, 158, 11, 0.3)'">
                <i class="bi bi-clock-history"></i> Pending Transactions
            </a>
            <a href="{{ route('transaction.statistics') }}" style="
                background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                text-decoration: none;
                font-weight: 600;
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
                transition: all 0.3s;
            " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(34, 197, 94, 0.4)'" 
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(34, 197, 94, 0.3)'">
                <i class="bi bi-bar-chart-fill"></i> Statistics
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div style="
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        ">
            <i class="bi bi-check-circle-fill" style="font-size: 1.25rem;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div style="
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        ">
            <i class="bi bi-exclamation-circle-fill" style="font-size: 1.25rem;"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Table Container -->
    <div style="
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    ">
        <table style="
            width: 100%;
            border-collapse: collapse;
        ">
            <thead style="
                background: rgba(34, 197, 94, 0.1);
                border-bottom: 1px solid rgba(34, 197, 94, 0.2);
            ">
                <tr>
                    <th style="padding: 1rem; text-align: left; color: #22c55e; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.05em;">ID</th>
                    <th style="padding: 1rem; text-align: left; color: #22c55e; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.05em;">Order ID</th>
                    <th style="padding: 1rem; text-align: left; color: #22c55e; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.05em;">Amount</th>
                    <th style="padding: 1rem; text-align: left; color: #22c55e; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.05em;">Payment Method</th>
                    <th style="padding: 1rem; text-align: left; color: #22c55e; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.05em;">Status</th>
                    <th style="padding: 1rem; text-align: left; color: #22c55e; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.05em;">Created At</th>
                    <th style="padding: 1rem; text-align: left; color: #22c55e; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.05em;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr style="
                        border-bottom: 1px solid rgba(34, 197, 94, 0.1);
                        transition: background 0.3s;
                    " onmouseover="this.style.background='rgba(34, 197, 94, 0.05)'" 
                       onmouseout="this.style.background='transparent'">
                        <td style="padding: 1rem; color: rgba(255, 255, 255, 0.9);">{{ $transaction->id }}</td>
                        <td style="padding: 1rem; color: rgba(255, 255, 255, 0.9);">{{ $transaction->order_id }}</td>
                        <td style="padding: 1rem; color: #22c55e; font-weight: 600;">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                        <td style="padding: 1rem;">
                            <span style="
                                display: inline-block;
                                padding: 0.25rem 0.75rem;
                                border-radius: 0.375rem;
                                font-size: 0.75rem;
                                font-weight: 600;
                                text-transform: uppercase;
                                @if($transaction->payment_method === 'cash')
                                    background: rgba(34, 197, 94, 0.15);
                                    color: #22c55e;
                                    border: 1px solid rgba(34, 197, 94, 0.3);
                                @elseif($transaction->payment_method === 'transfer')
                                    background: rgba(59, 130, 246, 0.15);
                                    color: #3b82f6;
                                    border: 1px solid rgba(59, 130, 246, 0.3);
                                @else
                                    background: rgba(168, 85, 247, 0.15);
                                    color: #a855f7;
                                    border: 1px solid rgba(168, 85, 247, 0.3);
                                @endif
                            ">{{ strtoupper($transaction->payment_method) }}</span>
                        </td>
                        <td style="padding: 1rem;">
                            <span style="
                                display: inline-block;
                                padding: 0.25rem 0.75rem;
                                border-radius: 0.375rem;
                                font-size: 0.75rem;
                                font-weight: 600;
                                text-transform: uppercase;
                                @if($transaction->status === 'confirmed')
                                    background: rgba(34, 197, 94, 0.15);
                                    color: #22c55e;
                                    border: 1px solid rgba(34, 197, 94, 0.3);
                                @elseif($transaction->status === 'pending')
                                    background: rgba(245, 158, 11, 0.15);
                                    color: #f59e0b;
                                    border: 1px solid rgba(245, 158, 11, 0.3);
                                @else
                                    background: rgba(239, 68, 68, 0.15);
                                    color: #ef4444;
                                    border: 1px solid rgba(239, 68, 68, 0.3);
                                @endif
                            ">{{ strtoupper($transaction->status) }}</span>
                        </td>
                        <td style="padding: 1rem; color: rgba(255, 255, 255, 0.7); font-size: 0.875rem;">
                            {{ $transaction->created_at->format('d M Y H:i') }}
                        </td>
                        <td style="padding: 1rem;">
                            <div style="display: flex; gap: 0.75rem;">
                                <a href="{{ route('transaction.show', $transaction) }}" style="
                                    color: #3b82f6;
                                    text-decoration: none;
                                    font-weight: 500;
                                    transition: color 0.3s;
                                " onmouseover="this.style.color='#60a5fa'" 
                                   onmouseout="this.style.color='#3b82f6'">View</a>
                                @if($transaction->status === 'pending')
                                    <a href="{{ route('transaction.edit', $transaction) }}" style="
                                        color: #f59e0b;
                                        text-decoration: none;
                                        font-weight: 500;
                                        transition: color 0.3s;
                                    " onmouseover="this.style.color='#fbbf24'" 
                                       onmouseout="this.style.color='#f59e0b'">Edit</a>
                                @endif
                                <form action="{{ route('transaction.destroy', $transaction) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="
                                        background: none;
                                        border: none;
                                        color: #ef4444;
                                        cursor: pointer;
                                        font-weight: 500;
                                        padding: 0;
                                        transition: color 0.3s;
                                    " onmouseover="this.style.color='#f87171'" 
                                       onmouseout="this.style.color='#ef4444'">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 3rem; text-align: center;">
                            <div style="color: rgba(255, 255, 255, 0.5);">
                                <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
                                <p style="font-size: 1.125rem; margin: 0;">No transactions found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 1.5rem;">
        {{ $transactions->links() }}
    </div>
</div>
@endsection