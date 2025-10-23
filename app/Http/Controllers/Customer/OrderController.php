<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\LaundryService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.service_id' => 'required|exists:laundry_services,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'notes' => 'nullable|string',
            'pickup_date' => 'required|date',
        ]);

        $totalAmount = 0;
        foreach ($validated['items'] as $item) {
            $service = LaundryService::find($item['service_id']);
            $totalAmount += $service->price * $item['quantity'];
        }

        $order = Order::create([
            'customer_id' => auth()->id(),
            'order_number' => 'ORD-' . time(),
            'notes' => $validated['notes'] ?? null,
            'pickup_date' => $validated['pickup_date'],
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        foreach ($validated['items'] as $item) {
            $service = LaundryService::find($item['service_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $item['service_id'],
                'quantity' => $item['quantity'],
                'price' => $service->price,
                'subtotal' => $service->price * $item['quantity'],
            ]);
        }

        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', 'Order berhasil dibuat');
    }

    public function show(Order $order)
    {
        if ($order->customer_id !== auth()->id()) {
            abort(403);
        }

        return view('customer.orders.show', compact('order'));
    }
}