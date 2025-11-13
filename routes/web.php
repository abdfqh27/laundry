<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Karyawan\KaryawanController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routing untuk Laundry App
| - Landing Page (Public)
| - Auth Routes (Public)
| - Protected Routes (Require Login)
|
*/

// ============================================================================
// PUBLIC ROUTES - TANPA LOGIN (MENGGUNAKAN LAYOUT: GUEST)
// ============================================================================

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('index');

// ============================================================================
// AUTH ROUTES - PUBLIC (MENGGUNAKAN LAYOUT: GUEST)
// ============================================================================

// Login Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Register Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================================================
// PROTECTED ROUTES - MEMERLUKAN LOGIN
// ============================================================================

Route::middleware(['auth'])->group(function () {
    
    // Dashboard Redirect
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ========================================================================
    // ADMIN ROUTES - ROLE: ADMINISTRATOR
    // ========================================================================
    
    Route::middleware(['role:administrator'])->prefix('admin')->name('admin.')->group(function () {
        
        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Basic Admin Pages
        Route::get('/targets', [AdminController::class, 'targets'])->name('targets');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        
        // User Management Routes (LENGKAP DENGAN MIDDLEWARE)
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::patch('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        });

        // Services Management
        Route::get('/services', [ServiceController::class, 'index'])->name('services');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
        Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
        Route::patch('/services/{id}/toggle', [ServiceController::class, 'toggleStatus'])->name('services.toggle');
    });

    // ========================================================================
    // KARYAWAN ROUTES - ROLE: KARYAWAN
    // ========================================================================
    
    Route::middleware(['role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/dashboard', [KaryawanController::class, 'dashboard'])->name('dashboard');
        Route::get('/orders', [KaryawanController::class, 'orders'])->name('orders');
        Route::get('/customers', [KaryawanController::class, 'customers'])->name('customers');
        Route::get('/reports', [KaryawanController::class, 'reports'])->name('reports');
    });

    // ========================================================================
    // TRANSACTION ROUTES - ROLE: ADMINISTRATOR & KARYAWAN
    // ========================================================================
    
    Route::middleware(['role:administrator,karyawan'])->prefix('transaction')->name('transaction.')->group(function () {
        // ============================================================
        // ROUTES KHUSUS (Harus di atas route parameter {transaction})
        // ============================================================
        
        // Transaction Statistics
        Route::get('/statistics', [TransactionController::class, 'statistics'])->name('statistics');
        
        // Transaction Pending List
        Route::get('/pending', [TransactionController::class, 'pending'])->name('pending');
        
        // Transaction by Order
        Route::get('/order/{order}', [TransactionController::class, 'byOrder'])->name('byOrder');
        
        // Transaction Create with Order ID
        Route::get('/create/{orderId}', [TransactionController::class, 'create'])->name('create');
        
        // ============================================================
        // MAIN TRANSACTION ROUTES
        // ============================================================
        
        // Transaction Index (List All)
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        
        // Transaction Store (Create New)
        Route::post('/', [TransactionController::class, 'store'])->name('store');
        
        // Transaction Show (Detail)
        Route::get('/{transaction}', [TransactionController::class, 'show'])->name('show');
        
        // Transaction Edit Form
        Route::get('/{transaction}/edit', [TransactionController::class, 'edit'])->name('edit');
        
        // Transaction Update
        Route::put('/{transaction}', [TransactionController::class, 'update'])->name('update');
        
        // Transaction Delete
        Route::delete('/{transaction}', [TransactionController::class, 'destroy'])->name('destroy');
        
        // ============================================================
        // PAYMENT STATUS MANAGEMENT ROUTES
        // ============================================================
        
        // Update Payment Status & Method
        Route::post('/{transaction}/update-status', [TransactionController::class, 'updatePaymentStatus'])->name('update-status');
        
        // Quick Confirm Payment
        Route::post('/{transaction}/quick-confirm', [TransactionController::class, 'quickConfirm'])->name('quick-confirm');
        
        // Quick Reject Payment
        Route::post('/{transaction}/quick-reject', [TransactionController::class, 'quickReject'])->name('quick-reject');
        
        // ============================================================
        // ORDER STATUS MANAGEMENT ROUTE
        // ============================================================
        
        // Update Order Status dari Transaction Page
        Route::post('/{transaction}/update-order-status', [TransactionController::class, 'updateOrderStatus'])->name('update-order-status');
        
        // ============================================================
        // LEGACY ROUTES (Masih bisa dipakai untuk kompatibilitas)
        // ============================================================
        
        // Transaction Confirm (Legacy)
        Route::patch('/{transaction}/confirm', [TransactionController::class, 'confirm'])->name('confirm');
        
        // Transaction Reject (Legacy)
        Route::patch('/{transaction}/reject', [TransactionController::class, 'reject'])->name('reject');
    });

    // ========================================================================
    // REPORT ROUTES - ROLE: ADMINISTRATOR & KARYAWAN
    // ========================================================================
    
    Route::middleware(['role:administrator,karyawan'])->prefix('report')->name('report.')->group(function () {
        
        // ============================================================
        // REPORT DASHBOARD
        // ============================================================
        
        // Report Index / Dashboard
        Route::get('/', [ReportController::class, 'index'])->name('index');
        
        // ============================================================
        // TRANSACTIONS REPORT
        // ============================================================
        
        // View Transactions Report
        Route::get('/transactions', [ReportController::class, 'transactions'])->name('transactions');
        
        // Export Transactions to PDF
        Route::get('/transactions/pdf', [ReportController::class, 'exportTransactionsPdf'])->name('transactions.pdf');
        
        // Export Transactions to Excel
        Route::get('/transactions/excel', [ReportController::class, 'exportTransactionsExcel'])->name('transactions.excel');
        
        // ============================================================
        // ORDERS REPORT
        // ============================================================
        
        // View Orders Report
        Route::get('/orders', [ReportController::class, 'orders'])->name('orders');
        
        // Export Orders to PDF
        Route::get('/orders/pdf', [ReportController::class, 'exportOrdersPdf'])->name('orders.pdf');
        
        // Export Orders to Excel
        Route::get('/orders/excel', [ReportController::class, 'exportOrdersExcel'])->name('orders.excel');
        
        // ============================================================
        // REVENUE REPORT
        // ============================================================
        
        // View Revenue Report
        Route::get('/revenue', [ReportController::class, 'revenue'])->name('revenue');
        
        // Export Revenue to PDF
        Route::get('/revenue/pdf', [ReportController::class, 'exportRevenuePdf'])->name('revenue.pdf');
        
        // Export Revenue to Excel
        Route::get('/revenue/excel', [ReportController::class, 'exportRevenueExcel'])->name('revenue.excel');
        
        // ============================================================
        // CUSTOMERS REPORT
        // ============================================================
        
        // View Customers Report
        Route::get('/customers', [ReportController::class, 'customers'])->name('customers');
        
        // Export Customers to Excel
        Route::get('/customers/excel', [ReportController::class, 'exportCustomersExcel'])->name('customers.excel');
        
        // ============================================================
        // SERVICES REPORT
        // ============================================================
        
        // View Services Report
        Route::get('/services', [ReportController::class, 'services'])->name('services');
    });

    // ========================================================================
    // CUSTOMER ROUTES - ROLE: CUSTOMER
    // ========================================================================
    
    Route::middleware(['role:customer'])->prefix('customer')->name('customer.')->group(function () {
        // Customer Dashboard
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        
        // Customer Notifications
        Route::get('/notifications', [CustomerController::class, 'notifications'])->name('notifications');
        
        // ====================================================================
        // ORDER MANAGEMENT ROUTES
        // ====================================================================
        
        Route::prefix('orders')->name('orders.')->group(function () {
            // Order Index (List All Orders)
            Route::get('/', [OrderController::class, 'index'])->name('index');
            
            // Order Create Form
            Route::get('/create', [OrderController::class, 'create'])->name('create');
            
            // Order Store (Create New Order)
            Route::post('/', [OrderController::class, 'store'])->name('store');
            
            // ================================================================
            // ROUTES KHUSUS (Harus di atas route parameter {order})
            // ================================================================
            
            // Payment Page (Halaman Pembayaran)
            // Harus di atas /{order} agar tidak dianggap sebagai parameter
            Route::get('/{order}/payment', [OrderController::class, 'payment'])->name('payment');
            
            // ================================================================
            // ORDER DETAIL & MANAGEMENT
            // ================================================================
            
            // Order Show (Detail Order)
            Route::get('/{order}', [OrderController::class, 'show'])->name('show');
            
            // Order Edit Form
            Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
            
            // Order Update
            Route::put('/{order}', [OrderController::class, 'update'])->name('update');
            
            // Order Delete
            Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
            
            // Order Cancel (Customer Cancel Order)
            Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
        });
    });
});

// ============================================================================
// FALLBACK - PAGE TIDAK DITEMUKAN
// ============================================================================

// Optional: 404 Handling
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});