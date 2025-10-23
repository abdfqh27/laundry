<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class KaryawanController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'diproses')->count();
        $completedOrders = Order::where('status', 'selesai')->count();

        return view('karyawan.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'completedOrders'
        ));
    }

    public function orders()
    {
        $orders = Order::with('customer', 'items')->paginate(15);
        return view('karyawan.orders.index', compact('orders'));
    }

    public function customers()
    {
        $customers = User::where('role', 'customer')->paginate(15);
        return view('karyawan.customers.index', compact('customers'));
    }

    public function transactions()
    {
        $transactions = Order::with('customer', 'transactions')->paginate(15);
        return view('karyawan.transactions.index', compact('transactions'));
    }

    public function reports()
    {
        return view('karyawan.reports.index');
    }
}