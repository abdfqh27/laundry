<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions
     */
    public function index()
    {
        $transactions = Transaction::with(['order.customer', 'confirmedBy'])
            ->latest()
            ->paginate(15);

        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction
     */
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        return view('transaction.create', compact('order'));
    }

    /**
     * Store a newly created transaction
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,qris',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle payment proof upload
        if ($request->hasFile('payment_proof')) {
            $validated['payment_proof'] = $request->file('payment_proof')
                ->store('payment-proofs', 'public');
        }

        // Status default adalah pending
        $validated['status'] = 'pending';

        // Jika cash, langsung confirmed
        if ($validated['payment_method'] === 'cash') {
            $validated['status'] = 'confirmed';
            $validated['confirmed_by'] = Auth::id();
            $validated['confirmed_at'] = now();
            
            // Update payment status order jadi paid
            $order = Order::findOrFail($validated['order_id']);
            $order->update(['payment_status' => 'paid']);
        }

        $transaction = Transaction::create($validated);

        return redirect()->route('transaction.show', $transaction)
            ->with('success', 'Transaction created successfully');
    }

    /**
     * Display the specified transaction
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['order.customer', 'order.karyawan', 'confirmedBy']);
        
        // Load semua karyawan untuk dropdown update status
        $karyawans = User::where('role', 'karyawan')
            ->orWhere('role', 'admin')
            ->orderBy('name')
            ->get();
        
        return view('transaction.show', compact('transaction', 'karyawans'));
    }

    /**
     * Show the form for editing
     */
    public function edit(Transaction $transaction)
    {
        // Hanya pending transaction yang bisa diedit
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Only pending transactions can be edited');
        }

        return view('transaction.edit', compact('transaction'));
    }

    /**
     * Show pending transactions for confirmation
     */
    public function pending()
    {
        $transactions = Transaction::with(['order.customer'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('transaction.pending', compact('transactions'));
    }

    /**
     * Update payment status and method (Admin/Karyawan)
     */
    public function updatePaymentStatus(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,transfer,qris',
            'status' => 'required|in:pending,confirmed,rejected',
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        // Update payment method dan status
        $transaction->update([
            'payment_method' => $validated['payment_method'],
            'status' => $validated['status'],
        ]);

        // Jika status confirmed, update payment_status order dan catat siapa yang confirm
        if ($validated['status'] === 'confirmed') {
            $transaction->update([
                'confirmed_by' => Auth::id(),
                'confirmed_at' => now(),
            ]);
            
            $transaction->order->update([
                'payment_status' => 'paid',
            ]);

            return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
        }

        // Jika status rejected
        if ($validated['status'] === 'rejected') {
            $transaction->update([
                'confirmed_by' => Auth::id(),
                'confirmed_at' => now(),
                'rejection_reason' => $validated['rejection_reason'] ?? null,
            ]);

            return back()->with('success', 'Pembayaran ditolak');
        }

        return back()->with('success', 'Transaction berhasil diupdate');
    }

    /**
     * Update order status from transaction page
     * UPDATED: Gunakan Order constants dan lebih robust
     */
    public function updateOrderStatus(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'order_status' => 'required|in:pending,processing,completed,picked_up,cancelled',
            'karyawan_id' => 'nullable|exists:users,id',
            'notes' => 'nullable|string|max:500',
        ]);

        $order = $transaction->order;
        
        // Prepare data untuk update
        $updateData = [
            'status' => $validated['order_status'],
        ];

        // Jika status completed, set completed_at
        if ($validated['order_status'] === Order::STATUS_COMPLETED) {
            $updateData['completed_at'] = now();
        }

        // Jika status picked_up, pastikan completed_at terisi
        if ($validated['order_status'] === Order::STATUS_PICKED_UP) {
            if (empty($order->completed_at)) {
                $updateData['completed_at'] = now();
            }
        }

        // Jika ada karyawan_id, update karyawan yang handle
        if (!empty($validated['karyawan_id'])) {
            $updateData['karyawan_id'] = $validated['karyawan_id'];
        }

        // Update order
        $order->update($updateData);

        // Jika ada notes, append ke notes order
        if (!empty($validated['notes'])) {
            $currentNotes = $order->notes;
            $timestamp = now()->format('Y-m-d H:i:s');
            $userName = Auth::user()->name;
            
            $newNotes = $currentNotes 
                ? $currentNotes . "\n\n[{$timestamp}] {$userName}: " . $validated['notes']
                : "[{$timestamp}] {$userName}: " . $validated['notes'];
            
            $order->update(['notes' => $newNotes]);
        }

        // Get status label dari Order model
        $statusLabels = Order::getStatuses();
        $statusText = $statusLabels[$validated['order_status']] ?? $validated['order_status'];

        return back()->with('success', "Status order berhasil diupdate menjadi: {$statusText}");
    }

    /**
     * Quick confirm transaction
     */
    public function quickConfirm(Transaction $transaction)
    {
        if ($transaction->status === 'confirmed') {
            return back()->with('error', 'Transaction sudah dikonfirmasi');
        }

        $transaction->update([
            'status' => 'confirmed',
            'confirmed_by' => Auth::id(),
            'confirmed_at' => now(),
        ]);

        $transaction->order->update([
            'payment_status' => 'paid',
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    /**
     * Quick reject transaction
     */
    public function quickReject(Transaction $transaction)
    {
        if ($transaction->status === 'rejected') {
            return back()->with('error', 'Transaction sudah ditolak');
        }

        $transaction->update([
            'status' => 'rejected',
            'confirmed_by' => Auth::id(),
            'confirmed_at' => now(),
        ]);

        return back()->with('success', 'Pembayaran ditolak');
    }

    /**
     * Confirm a transaction
     */
    public function confirm(Transaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction cannot be confirmed');
        }

        $transaction->update([
            'status' => 'confirmed',
            'confirmed_by' => Auth::id(),
            'confirmed_at' => now(),
        ]);

        // Update payment status order
        $transaction->order->update([
            'payment_status' => 'paid',
        ]);

        return back()->with('success', 'Transaction confirmed successfully');
    }

    /**
     * Reject a transaction
     */
    public function reject(Request $request, Transaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction cannot be rejected');
        }

        $validated = $request->validate([
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        $transaction->update([
            'status' => 'rejected',
            'confirmed_by' => Auth::id(),
            'confirmed_at' => now(),
            'rejection_reason' => $validated['rejection_reason'] ?? null,
        ]);

        return back()->with('success', 'Transaction rejected');
    }

    /**
     * Update the specified transaction
     */
    public function update(Request $request, Transaction $transaction)
    {
        // Hanya pending transaction yang bisa diupdate
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Only pending transactions can be updated');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,qris',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle new payment proof upload
        if ($request->hasFile('payment_proof')) {
            // Delete old proof if exists
            if ($transaction->payment_proof) {
                Storage::disk('public')->delete($transaction->payment_proof);
            }
            
            $validated['payment_proof'] = $request->file('payment_proof')
                ->store('payment-proofs', 'public');
        }

        $transaction->update($validated);

        return redirect()->route('transaction.show', $transaction)
            ->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified transaction
     */
    public function destroy(Transaction $transaction)
    {
        // Hapus payment proof jika ada
        if ($transaction->payment_proof) {
            Storage::disk('public')->delete($transaction->payment_proof);
        }

        $transaction->delete();

        return redirect()->route('transaction.index')
            ->with('success', 'Transaction deleted successfully');
    }

    /**
     * Get transactions by order
     */
    public function byOrder(Order $order)
    {
        $transactions = $order->transactions()
            ->with('confirmedBy')
            ->latest()
            ->get();

        return view('transaction.by-order', compact('order', 'transactions'));
    }

    /**
     * Get transaction statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => Transaction::count(),
            'pending' => Transaction::where('status', 'pending')->count(),
            'confirmed' => Transaction::where('status', 'confirmed')->count(),
            'rejected' => Transaction::where('status', 'rejected')->count(),
            'total_amount' => Transaction::where('status', 'confirmed')->sum('amount'),
            'today_confirmed' => Transaction::where('status', 'confirmed')
                ->whereDate('confirmed_at', today())
                ->count(),
            'today_amount' => Transaction::where('status', 'confirmed')
                ->whereDate('confirmed_at', today())
                ->sum('amount'),
        ];

        return view('transaction.statistics', compact('stats'));
    }

    /**
     * Get transactions report by date range
     * NEW METHOD
     */
    public function report(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:pending,confirmed,rejected',
            'payment_method' => 'nullable|in:cash,transfer,qris',
        ]);

        $query = Transaction::with(['order.customer', 'confirmedBy']);

        // Filter by date range
        if (!empty($validated['start_date'])) {
            $query->whereDate('created_at', '>=', $validated['start_date']);
        }

        if (!empty($validated['end_date'])) {
            $query->whereDate('created_at', '<=', $validated['end_date']);
        }

        // Filter by status
        if (!empty($validated['status'])) {
            $query->where('status', $validated['status']);
        }

        // Filter by payment method
        if (!empty($validated['payment_method'])) {
            $query->where('payment_method', $validated['payment_method']);
        }

        $transactions = $query->latest()->paginate(15);

        // Calculate summary
        $summary = [
            'total_transactions' => $query->count(),
            'total_amount' => $query->where('status', 'confirmed')->sum('amount'),
            'cash_amount' => $query->where('status', 'confirmed')->where('payment_method', 'cash')->sum('amount'),
            'transfer_amount' => $query->where('status', 'confirmed')->where('payment_method', 'transfer')->sum('amount'),
            'qris_amount' => $query->where('status', 'confirmed')->where('payment_method', 'qris')->sum('amount'),
        ];

        return view('transaction.report', compact('transactions', 'summary'));
    }
}