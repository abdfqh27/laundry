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
    
    Route::middleware(['role:administrator,karyawan'])->group(function () {
        // Transaction Statistics (harus di atas resource route)
        Route::get('/transaction/statistics', [TransactionController::class, 'statistics'])->name('transaction.statistics');
        
        // Transaction Pending (harus di atas resource route)
        Route::get('/transaction/pending', [TransactionController::class, 'pending'])->name('transaction.pending');
        
        // Transaction by Order
        Route::get('/transaction/order/{order}', [TransactionController::class, 'byOrder'])->name('transaction.byOrder');
        
        // Transaction Create with Order ID
        Route::get('/transaction/create/{orderId}', [TransactionController::class, 'create'])->name('transaction.create');
        
        // Transaction Confirm & Reject
        Route::patch('/transaction/{transaction}/confirm', [TransactionController::class, 'confirm'])->name('transaction.confirm');
        Route::patch('/transaction/{transaction}/reject', [TransactionController::class, 'reject'])->name('transaction.reject');
        
        // Transaction Resource Routes (CRUD)
        Route::resource('transaction', TransactionController::class)->except(['create']);
    });

    // ========================================================================
    // CUSTOMER ROUTES - ROLE: CUSTOMER
    // ========================================================================
    
    Route::middleware(['role:customer'])->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        
        // Order Management
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [CustomerController::class, 'myOrders'])->name('index');
            Route::get('/create', [CustomerController::class, 'createOrder'])->name('create');
            Route::post('/', [OrderController::class, 'store'])->name('store');
            Route::get('/{order}', [OrderController::class, 'show'])->name('show');
            Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
            Route::put('/{order}', [OrderController::class, 'update'])->name('update');
            Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
        });
        
        Route::get('/notifications', [CustomerController::class, 'notifications'])->name('notifications');
    });
});

// ============================================================================
// FALLBACK - PAGE TIDAK DITEMUKAN
// ============================================================================

// Optional: 404 Handling
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});