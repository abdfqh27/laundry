<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role === 'administrator') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'karyawan') {
            return redirect()->route('karyawan.dashboard');
        } else {
            return redirect()->route('customer.dashboard');
        }
    }
}