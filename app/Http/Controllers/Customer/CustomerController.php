<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\LaundryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Customer Dashboard dengan statistik lengkap
     */
    public function dashboard()
    {
        $user = auth()->user();
        $customerId = $user->id;

        // ========== STATISTIK UTAMA ==========
        $stats = [
            // Total semua order
            'total_orders' => Order::where('customer_id', $customerId)->count(),
            
            // Order berdasarkan status
            'pending_orders' => Order::where('customer_id', $customerId)
                ->where('status', 'pending')
                ->count(),
            
            'processing_orders' => Order::where('customer_id', $customerId)
                ->where('status', 'processing')
                ->count(),
            
            'completed_orders' => Order::where('customer_id', $customerId)
                ->where('status', 'completed')
                ->count(),
            
            // PERBAIKAN BARIS 40-44: HAPUS whereNull('picked_up_at')
            'ready_pickup' => Order::where('customer_id', $customerId)
                ->where('status', 'completed')
                ->where('payment_status', 'paid')
                ->count(), // <-- BARIS INI YANG DIPERBAIKI
            
            // Total pengeluaran (order yang sudah confirmed payment)
            'total_spent' => Transaction::whereHas('order', function($q) use ($customerId) {
                    $q->where('customer_id', $customerId);
                })
                ->where('status', 'confirmed')
                ->sum('amount'),
            
            // Order bulan ini
            'this_month_orders' => Order::where('customer_id', $customerId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            
            // Pengeluaran bulan ini
            'this_month_spent' => Transaction::whereHas('order', function($q) use ($customerId) {
                    $q->where('customer_id', $customerId);
                })
                ->where('status', 'confirmed')
                ->whereMonth('confirmed_at', Carbon::now()->month)
                ->whereYear('confirmed_at', Carbon::now()->year)
                ->sum('amount'),
        ];

        // ========== ORDER TERBARU (5 order terakhir) ==========
        $recentOrders = Order::where('customer_id', $customerId)
            ->with(['items.service', 'transaction'])
            ->latest()
            ->take(5)
            ->get();

        // ========== ORDER YANG PERLU PERHATIAN ==========
        // Order yang menunggu pembayaran
        $unpaidOrders = Order::where('customer_id', $customerId)
            ->where('payment_status', 'unpaid')
            ->where('status', '!=', 'cancelled')
            ->with(['items.service'])
            ->latest()
            ->take(3)
            ->get();

        // Order yang siap diambil - HAPUS whereNull('picked_up_at')
        $readyOrders = Order::where('customer_id', $customerId)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->with(['items.service'])
            ->latest()
            ->take(3)
            ->get();

        // Order yang sedang diproses
        $processingOrders = Order::where('customer_id', $customerId)
            ->where('status', 'processing')
            ->with(['items.service', 'karyawan'])
            ->latest()
            ->take(3)
            ->get();

        // ========== LAYANAN FAVORIT ==========
        // Hitung layanan yang paling sering digunakan
        $favoriteServices = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('laundry_services', 'order_items.service_id', '=', 'laundry_services.id')
            ->where('orders.customer_id', $customerId)
            ->select(
                'laundry_services.id',
                'laundry_services.name',
                'laundry_services.description',
                'laundry_services.price',
                DB::raw('COUNT(order_items.id) as usage_count'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.subtotal) as total_spent')
            )
            ->groupBy('laundry_services.id', 'laundry_services.name', 'laundry_services.description', 'laundry_services.price')
            ->orderBy('usage_count', 'desc')
            ->take(5)
            ->get();

        // ========== GRAFIK PENGELUARAN 6 BULAN TERAKHIR ==========
        $monthlySpending = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->format('M Y');
            
            $amount = Transaction::whereHas('order', function($q) use ($customerId) {
                    $q->where('customer_id', $customerId);
                })
                ->where('status', 'confirmed')
                ->whereMonth('confirmed_at', $date->month)
                ->whereYear('confirmed_at', $date->year)
                ->sum('amount');
            
            $monthlySpending[] = [
                'month' => $month,
                'amount' => $amount,
            ];
        }

        // ========== AKTIVITAS TERAKHIR ==========
        // Gabungkan order dan transaction untuk timeline
        $recentActivities = Order::where('customer_id', $customerId)
            ->with(['transaction'])
            ->latest('updated_at')
            ->take(10)
            ->get()
            ->map(function($order) {
                return [
                    'type' => 'order',
                    'date' => $order->updated_at,
                    'title' => 'Order ' . $order->order_number,
                    'description' => 'Status: ' . self::getStatusLabel($order->status),
                    'status' => $order->status,
                    'payment_status' => $order->payment_status,
                    'url' => route('customer.orders.show', $order->id),
                ];
            });

        // ========== NOTIFIKASI / ALERTS ==========
        $notifications = [];
        
        // Alert untuk order yang belum dibayar lebih dari 1 hari
        $oldUnpaidOrders = Order::where('customer_id', $customerId)
            ->where('payment_status', 'unpaid')
            ->where('status', '!=', 'cancelled')
            ->where('created_at', '<', Carbon::now()->subDay())
            ->count();
        
        if ($oldUnpaidOrders > 0) {
            $notifications[] = [
                'type' => 'warning',
                'icon' => 'exclamation-triangle',
                'message' => "Anda memiliki {$oldUnpaidOrders} order yang belum dibayar",
                'action' => 'Lihat Order',
                'url' => route('customer.orders.index') . '?payment_status=unpaid',
            ];
        }

        // Alert untuk order yang siap diambil
        if ($stats['ready_pickup'] > 0) {
            $notifications[] = [
                'type' => 'success',
                'icon' => 'check-circle',
                'message' => "{$stats['ready_pickup']} order Anda sudah selesai dan siap diambil!",
                'action' => 'Lihat Detail',
                'url' => route('customer.orders.index') . '?status=completed',
            ];
        }

        // Alert untuk order yang sedang diproses
        if ($stats['processing_orders'] > 0) {
            $notifications[] = [
                'type' => 'info',
                'icon' => 'clock',
                'message' => "{$stats['processing_orders']} order Anda sedang dalam proses",
                'action' => 'Pantau Progress',
                'url' => route('customer.orders.index') . '?status=processing',
            ];
        }

        // ========== QUICK ACTIONS ==========
        $quickActions = [
            [
                'title' => 'Order Baru',
                'description' => 'Buat pesanan laundry baru',
                'icon' => 'plus-circle',
                'color' => 'primary',
                'url' => route('customer.orders.create'),
            ],
            [
                'title' => 'Riwayat Order',
                'description' => 'Lihat semua order Anda',
                'icon' => 'list',
                'color' => 'secondary',
                'url' => route('customer.orders.index'),
            ],
            [
                'title' => 'Order Aktif',
                'description' => 'Order yang sedang berjalan',
                'icon' => 'refresh',
                'color' => 'info',
                'url' => route('customer.orders.index') . '?status=processing',
            ],
        ];

        // ========== LAYANAN POPULER (untuk quick order) ==========
        $popularServices = LaundryService::where('is_active', 1)
            ->orderBy('name')
            ->take(6)
            ->get();

        return view('customer.dashboard', compact(
            'stats',
            'recentOrders',
            'unpaidOrders',
            'readyOrders',
            'processingOrders',
            'favoriteServices',
            'monthlySpending',
            'recentActivities',
            'notifications',
            'quickActions',
            'popularServices'
        ));
    }

    /**
     * Get status label dalam Bahasa Indonesia
     */
    private static function getStatusLabel($status)
    {
        $labels = [
            'pending' => 'Menunggu Konfirmasi',
            'processing' => 'Sedang Diproses',
            'completed' => 'Selesai',
            'picked_up' => 'Sudah Diambil',
            'cancelled' => 'Dibatalkan',
        ];

        return $labels[$status] ?? ucfirst($status);
    }

    /**
     * Customer Profile
     */
    public function profile()
    {
        $user = auth()->user();
        
        // Statistik customer
        $orderStats = [
            'total' => Order::where('customer_id', $user->id)->count(),
            'completed' => Order::where('customer_id', $user->id)
                ->where('status', 'completed')
                ->count(),
            'total_spent' => Transaction::whereHas('order', function($q) use ($user) {
                    $q->where('customer_id', $user->id);
                })
                ->where('status', 'confirmed')
                ->sum('amount'),
            'member_since' => $user->created_at->diffForHumans(),
        ];

        return view('customer.profile', compact('user', 'orderStats'));
    }

    /**
     * Customer Notifications Center
     */
    public function notifications()
    {
        $customerId = auth()->id();
        
        // Order yang butuh aksi - HAPUS whereNull('picked_up_at')
        $actionRequired = Order::where('customer_id', $customerId)
            ->where(function($q) {
                $q->where(function($query) {
                    // Unpaid dan bukan cancelled
                    $query->where('payment_status', 'unpaid')
                          ->where('status', '!=', 'cancelled');
                })
                ->orWhere(function($query) {
                    // Completed dan paid (siap diambil)
                    $query->where('status', 'completed')
                          ->where('payment_status', 'paid');
                });
            })
            ->with(['items.service'])
            ->latest()
            ->get();

        // Order updates (status berubah dalam 7 hari terakhir)
        $recentUpdates = Order::where('customer_id', $customerId)
            ->where('updated_at', '>=', Carbon::now()->subDays(7))
            ->with(['items.service'])
            ->latest('updated_at')
            ->get();

        return view('customer.notifications', compact('actionRequired', 'recentUpdates'));
    }

    /**
     * Customer Order History dengan filter
     */
    public function orderHistory(Request $request)
    {
        $query = Order::where('customer_id', auth()->id())
            ->with(['items.service', 'transaction']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Search by order number
        if ($request->has('search') && $request->search != '') {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('customer.orders.history', compact('orders'));
    }
}