<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
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
        $transactions = Transaction::with(['order', 'confirmedBy'])
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
        $transaction->load(['order', 'confirmedBy']);
        
        return view('transaction.show', compact('transaction'));
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
        $transactions = Transaction::with(['order'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('transaction.pending', compact('transactions'));
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

        $transaction->update([
            'status' => 'rejected',
            'confirmed_by' => Auth::id(),
            'confirmed_at' => now(),
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
        ];

        return view('transaction.statistics', compact('stats'));
    }
}