<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use App\Exports\OrdersExport;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Halaman utama report
     */
    public function index()
    {
        // Summary statistics
        $stats = [
            'total_orders' => Order::count(),
            'total_transactions' => Transaction::count(),
            'total_revenue' => Transaction::where('status', 'confirmed')->sum('amount'),
            'pending_payments' => Transaction::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
        ];

        return view('report.index', compact('stats'));
    }

    /**
     * Laporan Transaksi
     */
    public function transactions(Request $request)
    {
        $query = Transaction::with(['order.customer', 'confirmedBy']);

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $transactions = $query->latest()->paginate(15);

        // Calculate summary
        $summary = [
            'total_count' => $query->count(),
            'total_amount' => (clone $query)->where('status', 'confirmed')->sum('amount'),
            'pending_count' => (clone $query)->where('status', 'pending')->count(),
            'confirmed_count' => (clone $query)->where('status', 'confirmed')->count(),
            'rejected_count' => (clone $query)->where('status', 'rejected')->count(),
            'cash_amount' => (clone $query)->where('status', 'confirmed')
                ->where('payment_method', 'cash')->sum('amount'),
            'transfer_amount' => (clone $query)->where('status', 'confirmed')
                ->where('payment_method', 'transfer')->sum('amount'),
            'qris_amount' => (clone $query)->where('status', 'confirmed')
                ->where('payment_method', 'qris')->sum('amount'),
        ];

        return view('report.transactions', compact('transactions', 'summary'));
    }

    /**
     * Laporan Orders
     */
    public function orders(Request $request)
    {
        $query = Order::with(['customer', 'karyawan', 'items.service']);

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by customer
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        // Filter by karyawan
        if ($request->filled('karyawan_id')) {
            $query->where('karyawan_id', $request->karyawan_id);
        }

        $orders = $query->latest()->paginate(15);

        // Calculate summary
        $summary = [
            'total_count' => $query->count(),
            'total_revenue' => (clone $query)->where('payment_status', 'paid')->sum('total_amount'),
            'pending_orders' => (clone $query)->where('status', 'pending')->count(),
            'processing_orders' => (clone $query)->where('status', 'processing')->count(),
            'completed_orders' => (clone $query)->where('status', 'completed')->count(),
            'picked_up_orders' => (clone $query)->where('status', 'picked_up')->count(),
            'cancelled_orders' => (clone $query)->where('status', 'cancelled')->count(),
            'unpaid_count' => (clone $query)->where('payment_status', 'unpaid')->count(),
            'paid_count' => (clone $query)->where('payment_status', 'paid')->count(),
        ];

        // Get customers and karyawan for filters
        $customers = User::where('role', 'customer')->orderBy('name')->get();
        $karyawans = User::whereIn('role', ['admin', 'karyawan'])->orderBy('name')->get();

        return view('report.orders', compact('orders', 'summary', 'customers', 'karyawans'));
    }

    /**
     * Laporan Pendapatan (Revenue Report)
     */
    public function revenue(Request $request)
    {
        // Default periode: bulan ini
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date) 
            : Carbon::now()->startOfMonth();
        
        $endDate = $request->filled('end_date') 
            ? Carbon::parse($request->end_date) 
            : Carbon::now()->endOfMonth();

        // Transaksi yang confirmed dalam periode
        $transactions = Transaction::with(['order.customer'])
            ->where('status', 'confirmed')
            ->whereDate('confirmed_at', '>=', $startDate)
            ->whereDate('confirmed_at', '<=', $endDate)
            ->get();

        // Group by date
        $dailyRevenue = $transactions->groupBy(function($item) {
            return Carbon::parse($item->confirmed_at)->format('Y-m-d');
        })->map(function($dayTransactions) {
            return [
                'total' => $dayTransactions->sum('amount'),
                'count' => $dayTransactions->count(),
                'cash' => $dayTransactions->where('payment_method', 'cash')->sum('amount'),
                'transfer' => $dayTransactions->where('payment_method', 'transfer')->sum('amount'),
                'qris' => $dayTransactions->where('payment_method', 'qris')->sum('amount'),
            ];
        });

        // Group by payment method
        $byPaymentMethod = [
            'cash' => $transactions->where('payment_method', 'cash')->sum('amount'),
            'transfer' => $transactions->where('payment_method', 'transfer')->sum('amount'),
            'qris' => $transactions->where('payment_method', 'qris')->sum('amount'),
        ];

        // Summary
        $summary = [
            'total_revenue' => $transactions->sum('amount'),
            'total_transactions' => $transactions->count(),
            'average_transaction' => $transactions->count() > 0 
                ? $transactions->sum('amount') / $transactions->count() 
                : 0,
            'by_payment_method' => $byPaymentMethod,
        ];

        return view('report.revenue', compact('dailyRevenue', 'summary', 'startDate', 'endDate'));
    }

    /**
     * Laporan per Customer
     */
    public function customers(Request $request)
    {
        $query = User::where('role', 'customer')
            ->withCount(['orders'])
            ->withSum(['orders as total_spent' => function($query) {
                $query->where('payment_status', 'paid');
            }], 'total_amount');

        // Filter by date range untuk orders
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->whereHas('orders', function($q) use ($request) {
                if ($request->filled('start_date')) {
                    $q->whereDate('created_at', '>=', $request->start_date);
                }
                if ($request->filled('end_date')) {
                    $q->whereDate('created_at', '<=', $request->end_date);
                }
            });
        }

        // Sort by total spent
        if ($request->filled('sort_by')) {
            if ($request->sort_by === 'total_spent') {
                $query->orderBy('total_spent', 'desc');
            } elseif ($request->sort_by === 'total_orders') {
                $query->orderBy('orders_count', 'desc');
            }
        } else {
            $query->orderBy('total_spent', 'desc');
        }

        $customers = $query->paginate(15);

        return view('report.customers', compact('customers'));
    }

    /**
     * Laporan Layanan Terpopuler
     */
    public function services(Request $request)
    {
        $query = \App\Models\OrderItem::with('service')
            ->selectRaw('service_id, SUM(quantity) as total_quantity, SUM(subtotal) as total_revenue, COUNT(*) as order_count');

        // Filter by date
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->whereHas('order', function($q) use ($request) {
                if ($request->filled('start_date')) {
                    $q->whereDate('created_at', '>=', $request->start_date);
                }
                if ($request->filled('end_date')) {
                    $q->whereDate('created_at', '<=', $request->end_date);
                }
            });
        }

        $services = $query->groupBy('service_id')
            ->orderBy('total_revenue', 'desc')
            ->get();

        return view('report.services', compact('services'));
    }

    // ==================== EXPORT PDF ====================

    /**
     * Export Transactions to PDF
     */
    public function exportTransactionsPdf(Request $request)
    {
        $query = Transaction::with(['order.customer', 'confirmedBy']);

        // Apply same filters as transactions method
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $transactions = $query->latest()->get();

        $summary = [
            'total_count' => $transactions->count(),
            'total_amount' => $transactions->where('status', 'confirmed')->sum('amount'),
            'cash_amount' => $transactions->where('status', 'confirmed')
                ->where('payment_method', 'cash')->sum('amount'),
            'transfer_amount' => $transactions->where('status', 'confirmed')
                ->where('payment_method', 'transfer')->sum('amount'),
            'qris_amount' => $transactions->where('status', 'confirmed')
                ->where('payment_method', 'qris')->sum('amount'),
        ];

        $pdf = Pdf::loadView('report.pdf.transactions', [
            'transactions' => $transactions,
            'summary' => $summary,
            'filters' => $request->all(),
        ]);

        $filename = 'laporan-transaksi-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Export Orders to PDF
     */
    public function exportOrdersPdf(Request $request)
    {
        $query = Order::with(['customer', 'karyawan', 'items.service', 'transaction']);

        // Apply filters
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->latest()->get();

        $summary = [
            'total_count' => $orders->count(),
            'total_revenue' => $orders->where('payment_status', 'paid')->sum('total_amount'),
            'completed_orders' => $orders->where('status', 'completed')->count(),
            'pending_orders' => $orders->where('status', 'pending')->count(),
        ];

        $pdf = Pdf::loadView('report.pdf.orders', [
            'orders' => $orders,
            'summary' => $summary,
            'filters' => $request->all(),
        ]);

        $filename = 'laporan-orders-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Export Revenue to PDF
     */
    public function exportRevenuePdf(Request $request)
    {
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date) 
            : Carbon::now()->startOfMonth();
        
        $endDate = $request->filled('end_date') 
            ? Carbon::parse($request->end_date) 
            : Carbon::now()->endOfMonth();

        $transactions = Transaction::with(['order.customer'])
            ->where('status', 'confirmed')
            ->whereDate('confirmed_at', '>=', $startDate)
            ->whereDate('confirmed_at', '<=', $endDate)
            ->get();

        $dailyRevenue = $transactions->groupBy(function($item) {
            return Carbon::parse($item->confirmed_at)->format('Y-m-d');
        })->map(function($dayTransactions) {
            return [
                'total' => $dayTransactions->sum('amount'),
                'count' => $dayTransactions->count(),
                'cash' => $dayTransactions->where('payment_method', 'cash')->sum('amount'),
                'transfer' => $dayTransactions->where('payment_method', 'transfer')->sum('amount'),
                'qris' => $dayTransactions->where('payment_method', 'qris')->sum('amount'),
            ];
        });

        $summary = [
            'total_revenue' => $transactions->sum('amount'),
            'total_transactions' => $transactions->count(),
            'average_transaction' => $transactions->count() > 0 
                ? $transactions->sum('amount') / $transactions->count() 
                : 0,
        ];

        $pdf = Pdf::loadView('report.pdf.revenue', [
            'dailyRevenue' => $dailyRevenue,
            'summary' => $summary,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);

        $filename = 'laporan-pendapatan-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }

    // ==================== EXPORT EXCEL ====================

    /**
     * Export Transactions to Excel
     */
    public function exportTransactionsExcel(Request $request)
    {
        $filename = 'laporan-transaksi-' . date('Y-m-d-His') . '.xlsx';
        
        return Excel::download(
            new TransactionsExport($request->all()), 
            $filename
        );
    }

    /**
     * Export Orders to Excel
     */
    public function exportOrdersExcel(Request $request)
    {
        $filename = 'laporan-orders-' . date('Y-m-d-His') . '.xlsx';
        
        return Excel::download(
            new OrdersExport($request->all()), 
            $filename
        );
    }

    /**
     * Export Revenue to Excel
     */
    public function exportRevenueExcel(Request $request)
    {
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date) 
            : Carbon::now()->startOfMonth();
        
        $endDate = $request->filled('end_date') 
            ? Carbon::parse($request->end_date) 
            : Carbon::now()->endOfMonth();

        $transactions = Transaction::with(['order.customer'])
            ->where('status', 'confirmed')
            ->whereDate('confirmed_at', '>=', $startDate)
            ->whereDate('confirmed_at', '<=', $endDate)
            ->get();

        $filename = 'laporan-pendapatan-' . date('Y-m-d-His') . '.xlsx';
        
        return Excel::download(
            new \App\Exports\RevenueExport($transactions, $startDate, $endDate), 
            $filename
        );
    }

    /**
     * Export Customers Report to Excel
     */
    public function exportCustomersExcel(Request $request)
    {
        $filename = 'laporan-pelanggan-' . date('Y-m-d-His') . '.xlsx';
        
        return Excel::download(
            new \App\Exports\CustomersExport($request->all()), 
            $filename
        );
    }
}