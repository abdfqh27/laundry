<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        // Pastikan order milik customer yang login
        if ($order->customer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah order sudah dibayar
        if ($order->payment_status === 'paid') {
            return redirect()->route('customer.orders.show', $order)
                ->with('info', 'Order ini sudah dibayar');
        }

        return view('customer.payment.show', compact('order'));
    }
}