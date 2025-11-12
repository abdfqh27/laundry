<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\LaundryService;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())
            ->with(['items.service'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('customer.orders.index', compact('orders'));
    }

    public function create()
    {
        $services = LaundryService::where('is_active', 1)->get();
        
        return view('customer.orders.create', ['services' => $services]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:laundry_services,id',
            'items.*.quantity' => 'required|numeric|min:0.5',
            'notes' => 'nullable|string|max:1000',
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'nullable|date_format:H:i',
        ]);

        // Hitung total amount
        $totalAmount = 0;
        $adminFee = 5000; // Biaya admin

        foreach ($validated['items'] as $item) {
            $service = LaundryService::find($item['service_id']);
            if ($service) {
                $totalAmount += $service->price * $item['quantity'];
            }
        }

        // Tambahkan biaya admin
        $totalAmount += $adminFee;

        // Generate order number
        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

        // Gabungkan pickup date dan time jika ada
        $pickupDateTime = $validated['pickup_date'];
        if (!empty($validated['pickup_time'])) {
            $pickupDateTime .= ' ' . $validated['pickup_time'];
        }

        // Buat order
        $order = Order::create([
            'customer_id' => auth()->id(),
            'order_number' => $orderNumber,
            'notes' => $validated['notes'] ?? null,
            'pickup_date' => $pickupDateTime,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Buat order items
        foreach ($validated['items'] as $item) {
            $service = LaundryService::find($item['service_id']);
            if ($service) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'service_id' => $item['service_id'],
                    'quantity' => $item['quantity'],
                    'price' => $service->price,
                    'subtotal' => $service->price * $item['quantity'],
                ]);
            }
        }

        // ========== BUAT TRANSACTION OTOMATIS ==========
        Transaction::create([
            'order_id' => $order->id,
            'amount' => $totalAmount,
            'payment_method' => 'transfer', // default, bisa diubah admin
            'status' => 'pending',
            'payment_proof' => null,
        ]);
        // ===============================================

        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', 'Order berhasil dibuat! Nomor order: ' . $orderNumber);
    }

    public function show(Order $order)
    {
        // Pastikan customer hanya bisa melihat order miliknya
        if ($order->customer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Load relasi yang dibutuhkan - PERBAIKI INI
        // Gunakan with() untuk eager loading, bukan load()
        $order->load([
            'items.service', 
            'customer', 
            'karyawan',
            'transaction' // Pastikan relasi ini ada di Model Order
        ]);

        return view('customer.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        // Pastikan customer hanya bisa cancel order miliknya
        if ($order->customer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya order dengan status pending yang bisa dicancel
        if ($order->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Order dengan status ' . $order->status . ' tidak dapat dibatalkan');
        }

        $order->update([
            'status' => 'cancelled'
        ]);

        return redirect()->route('customer.orders.index')
            ->with('success', 'Order berhasil dibatalkan');
    }

    public function payment(Order $order)
    {
        // Pastikan customer hanya bisa melihat halaman pembayaran order miliknya
        if ($order->customer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya order yang belum dibayar yang bisa akses halaman pembayaran
        if ($order->payment_status === 'paid') {
            return redirect()->route('customer.orders.show', $order->id)
                ->with('info', 'Order ini sudah dibayar');
        }

        // Load relasi yang dibutuhkan
        $order->load(['items.service', 'customer', 'transaction']);

        // Data metode pembayaran
        $paymentMethods = [
            [
                'id' => 'transfer',
                'name' => 'Transfer Bank',
                'icon' => 'bank',
                'banks' => [
                    ['name' => 'BCA', 'account' => '1234567890', 'holder' => 'Hejo Laundry'],
                    ['name' => 'Mandiri', 'account' => '0987654321', 'holder' => 'Hejo Laundry'],
                    ['name' => 'BNI', 'account' => '5555666677', 'holder' => 'Hejo Laundry'],
                ]
            ],
            [
                'id' => 'qris',
                'name' => 'QRIS',
                'icon' => 'qr-code',
                'qr_image' => 'images/qris/qris-sample.jpg'
            ],
            [
                'id' => 'cash',
                'name' => 'Cash (Bayar di Tempat)',
                'icon' => 'cash-coin',
                'description' => 'Bayar langsung saat pengambilan/pengantaran laundry'
            ]
        ];

        // Nomor WhatsApp untuk konfirmasi
        $whatsappNumber = '6281234567890'; // Ganti dengan nomor Anda
        
        // Pesan WA otomatis dengan detail order
        $waMessage = "Halo Admin Hejo Laundry,\n\n";
        $waMessage .= "Saya ingin konfirmasi pembayaran:\n\n";
        $waMessage .= "📋 *Detail Order*\n";
        $waMessage .= "No. Order: *{$order->order_number}*\n";
        $waMessage .= "Nama: {$order->customer->name}\n";
        $waMessage .= "Total Bayar: *Rp " . number_format($order->total_amount, 0, ',', '.') . "*\n\n";
        $waMessage .= "💳 Metode Pembayaran: _[Sebutkan: Transfer BCA/Mandiri/BNI atau QRIS]_\n\n";
        $waMessage .= "Mohon dicek dan konfirmasi pembayaran saya.\n";
        $waMessage .= "Terima kasih! 🙏";
        
        $waLink = "https://wa.me/{$whatsappNumber}?text=" . urlencode($waMessage);

        return view('customer.orders.payment', compact('order', 'paymentMethods', 'whatsappNumber', 'waLink'));
    }
}