<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $totalOrders = Order::where('customer_id', $user->id)->count();
        $pendingOrders = Order::where('customer_id', $user->id)
            ->where('status', 'pending')->count();
        $recentOrders = Order::where('customer_id', $user->id)
            ->latest()->take(5)->get();

        return view('customer.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'recentOrders'
        ));
    }

    public function createOrder()
    {
        return view('customer.orders.create');
    }

    public function myOrders()
    {
        $orders = Order::where('customer_id', auth()->id())->paginate(15);
        return view('customer.orders.index', compact('orders'));
    }

    public function notifications()
    {
        return view('customer.notifications.index');
    }
}