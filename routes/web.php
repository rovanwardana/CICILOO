<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// Route untuk guest (tidak perlu login)
Route::get('/', function () {
    return view('index'); // Langsung ke index.blade.php
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

    // Transaction routes
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::post('/transaction/update-statuses', [BillController::class, 'updateStatuses'])->name('transaction.updateStatuses');
    Route::delete('/transaction/{id}', [BillController::class, 'destroy'])->name('transaction.destroy');

    //Notif
    Route::get('/notifications', [TransactionController::class, 'notifications'])->name('notification.index');

    // Bill routes
    Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
    Route::post('/bills', [BillController::class, 'store'])->name('bills.store');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

    // Other authenticated routes
    Route::get('/friends', fn() => 'Halaman Friends')->name('friends.index');
    Route::get('/settings', fn() => 'Halaman Settings')->name('settings');
    Route::get('/help', fn() => 'Halaman Help')->name('help');

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
