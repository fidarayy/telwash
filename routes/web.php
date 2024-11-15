<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;  // Pastikan Anda menggunakan TransactionController
use App\Http\Controllers\PickupController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('admin.master_data.transaction.index');  // Mengarahkan ke halaman login
    // return view('customers.index');  // Mengarahkan ke halaman login
    // return view('customers.management');  // Mengarahkan ke halaman login
    return view('auth.login');  // Mengarahkan ke halaman login
});

 // Admin Route
 Route::prefix("admin")->name('admin.')->group(function () {

    // Master data route
    Route::prefix('master_data')->name('master_data.')->group(function () {

        // Transaction Route
        Route::controller(TransactionController::class)->prefix('/transaction')->name('transaction.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show', 'show')->name('show');
            Route::get('/{id}/edit', 'detail')->name('detail');
        });
    });
});


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Transactions (formerly Orders)
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', function () {
        return view('new-transaction'); // Mengarahkan ke 'resources/views/new-transaction.blade.php'
    })->name('transactions.create');

    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

    // Pickup
    Route::get('/pickup', [PickupController::class, 'index'])->name('pickup.index');

    // Vouchers
    Route::get('/vouchers', [VoucherController::class, 'index'])->name('vouchers.index');
    Route::get('/vouchers/create', [VoucherController::class, 'create'])->name('vouchers.create');
    Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
    Route::get('/vouchers/{id}/edit', [VoucherController::class, 'edit'])->name('vouchers.edit');
    Route::put('/vouchers/{id}', [VoucherController::class, 'update'])->name('vouchers.update');
    Route::delete('/vouchers/{id}', [VoucherController::class, 'destroy'])->name('vouchers.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth'])->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    });
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Route::get('/balance/topup', [BalanceController::class, 'topup'])->name('balance.topup');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    });
});


require __DIR__ . '/auth.php';
