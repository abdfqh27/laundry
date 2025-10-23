<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\LaundryTarget;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalRevenue = Transaction::where('status', 'confirmed')->sum('amount');
        $pendingPayments = Order::where('payment_status', 'unpaid')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'pendingPayments'
        ));
    }

    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function transactions()
    {
        $transactions = Transaction::with('order', 'confirmedBy')->paginate(15);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function services()
    {
        return view('admin.services.index');
    }

    public function targets()
    {
        return view('admin.targets.index');
    }

    public function settings()
    {
        return view('admin.settings.index');
    }
}