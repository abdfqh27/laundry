<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\LaundryService;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display dashboard based on user role
     */
    public function index()
    {
        $user = auth()->user();

        switch ($user->role) {
            case 'administrator':
                return redirect()->route('admin.dashboard');
            case 'karyawan':
                return redirect()->route('karyawan.dashboard');
            case 'customer':
                return redirect()->route('customer.dashboard');
            default:
                abort(403, 'Unauthorized access');
        }
    }
}