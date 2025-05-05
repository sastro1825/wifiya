<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\WarningController;
use App\Http\Controllers\WifiUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/wifi-users', [DashboardController::class, 'store'])->name('wifi-users.store');
    Route::get('/warnings/create', [WarningController::class, 'create'])->name('warnings.create');
    Route::post('/warnings', [WarningController::class, 'store'])->name('warnings.store');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/wifi-users', [WifiUserController::class, 'index'])->name('wifi-users.index');
    Route::get('/wifi-users/{user_id}/edit', [WifiUserController::class, 'edit'])->name('wifi-users.edit');
    Route::put('/wifi-users/{user_id}', [WifiUserController::class, 'update'])->name('wifi-users.update');
});

require __DIR__.'/auth.php';