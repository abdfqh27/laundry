<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\LaundryService;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Admin Dashboard - Statistik Lengkap
     */
    public function dashboard()
    {
        try {
            // === OVERVIEW STATISTICS ===
            $overview = [
                'total_revenue' => $this->getTotalRevenue(),
                'total_orders' => Order::count(),
                'active_orders' => Order::whereIn('status', ['pending', 'processing'])->count(),
                'completed_orders' => Order::where('status', 'completed')->count(),
                'total_customers' => User::where('role', 'customer')->count(),
                'pending_payments' => Transaction::where('status', 'pending')->count(),
            ];

            // === REVENUE STATISTICS ===
            $revenue = [
                'today' => $this->getRevenue('today'),
                'this_week' => $this->getRevenue('week'),
                'this_month' => $this->getRevenue('month'),
                'this_year' => $this->getRevenue('year'),
            ];

            // === ORDER STATISTICS BY STATUS ===
            $orderStats = Order::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get()
                ->keyBy('status');

            // === PAYMENT STATISTICS ===
            $paymentStats = [
                'cash' => Transaction::where('status', 'confirmed')
                    ->where('payment_method', 'cash')
                    ->sum('amount'),
                'transfer' => Transaction::where('status', 'confirmed')
                    ->where('payment_method', 'transfer')
                    ->sum('amount'),
                'qris' => Transaction::where('status', 'confirmed')
                    ->where('payment_method', 'qris')
                    ->sum('amount'),
            ];

            // === RECENT ORDERS (10 terbaru) ===
            $recentOrders = Order::with(['customer', 'karyawan'])
                ->latest()
                ->take(10)
                ->get();

            // === PENDING TRANSACTIONS ===
            $pendingTransactions = Transaction::with(['order.customer'])
                ->where('status', 'pending')
                ->latest()
                ->take(5)
                ->get();

            // === TOP SERVICES (Layanan terpopuler) ===
            $topServices = OrderItem::select('service_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(subtotal) as total_revenue'))
                ->with('service')
                ->groupBy('service_id')
                ->orderByDesc('total_quantity')
                ->take(5)
                ->get();

            // === TOP CUSTOMERS (Customer dengan total transaksi terbanyak) ===
            $topCustomers = Order::select('customer_id', DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_amount) as total_spent'))
                ->with('customer')
                ->where('payment_status', 'paid')
                ->groupBy('customer_id')
                ->orderByDesc('total_spent')
                ->take(5)
                ->get();

            // === MONTHLY REVENUE CHART (12 bulan terakhir) ===
            $monthlyRevenue = $this->getMonthlyRevenue(12);

            // === DAILY ORDERS CHART (7 hari terakhir) ===
            $dailyOrders = $this->getDailyOrders(7);

            // === USER STATISTICS ===
            $userStats = [
                'total_users' => User::count(),
                'administrators' => User::where('role', 'administrator')->count(),
                'karyawan' => User::where('role', 'karyawan')->count(),
                'customers' => User::where('role', 'customer')->count(),
                'active_users' => User::where('is_active', 1)->count(),
                'inactive_users' => User::where('is_active', 0)->count(),
            ];

            // === ORDER COMPLETION RATE ===
            $totalOrders = Order::count();
            $completedOrders = Order::where('status', 'completed')->count();
            $completionRate = $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100, 2) : 0;

            // === AVERAGE ORDER VALUE ===
            $averageOrderValue = Order::where('payment_status', 'paid')->avg('total_amount') ?? 0;

            return view('admin.dashboard', compact(
                'overview',
                'revenue',
                'orderStats',
                'paymentStats',
                'recentOrders',
                'pendingTransactions',
                'topServices',
                'topCustomers',
                'monthlyRevenue',
                'dailyOrders',
                'userStats',
                'completionRate',
                'averageOrderValue'
            ));
        } catch (\Exception $e) {
            // Jika ada error, kembalikan view dengan data default
            return view('admin.dashboard', [
                'overview' => [
                    'total_revenue' => 0,
                    'total_orders' => 0,
                    'active_orders' => 0,
                    'completed_orders' => 0,
                    'total_customers' => 0,
                    'pending_payments' => 0,
                ],
                'revenue' => [
                    'today' => 0,
                    'this_week' => 0,
                    'this_month' => 0,
                    'this_year' => 0,
                ],
                'orderStats' => collect(),
                'paymentStats' => [
                    'cash' => 0,
                    'transfer' => 0,
                    'qris' => 0,
                ],
                'recentOrders' => collect(),
                'pendingTransactions' => collect(),
                'topServices' => collect(),
                'topCustomers' => collect(),
                'monthlyRevenue' => collect(),
                'dailyOrders' => collect(),
                'userStats' => [
                    'total_users' => 0,
                    'administrators' => 0,
                    'karyawan' => 0,
                    'customers' => 0,
                    'active_users' => 0,
                    'inactive_users' => 0,
                ],
                'completionRate' => 0,
                'averageOrderValue' => 0,
            ])->with('error', 'Error loading dashboard: ' . $e->getMessage());
        }
    }

    /**
     * Targets Page
     */
    public function targets()
    {
        return view('admin.targets');
    }

    /**
     * Settings Page
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Get total revenue (confirmed transactions only)
     */
    private function getTotalRevenue()
    {
        return Transaction::where('status', 'confirmed')->sum('amount') ?? 0;
    }

    /**
     * Get revenue by period
     */
    private function getRevenue($period)
    {
        $query = Transaction::where('status', 'confirmed');

        switch ($period) {
            case 'today':
                $query->whereDate('confirmed_at', today());
                break;
            case 'week':
                $query->whereBetween('confirmed_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('confirmed_at', now()->month)
                      ->whereYear('confirmed_at', now()->year);
                break;
            case 'year':
                $query->whereYear('confirmed_at', now()->year);
                break;
        }

        return $query->sum('amount') ?? 0;
    }

    /**
     * Get monthly revenue for the last N months
     */
    private function getMonthlyRevenue($months = 12)
    {
        $startDate = now()->subMonths($months)->startOfMonth();
        
        return Transaction::where('status', 'confirmed')
            ->where('confirmed_at', '>=', $startDate)
            ->selectRaw('DATE_FORMAT(confirmed_at, "%Y-%m") as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->month => $item->total];
            });
    }

    /**
     * Get daily orders for the last N days
     */
    private function getDailyOrders($days = 7)
    {
        $startDate = now()->subDays($days)->startOfDay();
        
        return Order::where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->date => $item->total];
            });
    }

    /**
     * Get statistics for API/Ajax requests
     */
    public function getStats(Request $request)
    {
        $type = $request->input('type', 'overview');

        switch ($type) {
            case 'overview':
                return response()->json([
                    'total_revenue' => $this->getTotalRevenue(),
                    'today_revenue' => $this->getRevenue('today'),
                    'total_orders' => Order::count(),
                    'pending_orders' => Order::where('status', 'pending')->count(),
                ]);

            case 'revenue':
                return response()->json([
                    'today' => $this->getRevenue('today'),
                    'week' => $this->getRevenue('week'),
                    'month' => $this->getRevenue('month'),
                    'year' => $this->getRevenue('year'),
                ]);

            case 'orders':
                return response()->json(
                    Order::select('status', DB::raw('count(*) as total'))
                        ->groupBy('status')
                        ->get()
                );

            case 'monthly_chart':
                $months = $request->input('months', 12);
                return response()->json($this->getMonthlyRevenue($months));

            case 'daily_chart':
                $days = $request->input('days', 7);
                return response()->json($this->getDailyOrders($days));

            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }
    }
}