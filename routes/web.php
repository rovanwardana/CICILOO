<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Route untuk guest (tidak perlu login)
Route::get('/', function () {
    return view('index'); // Langsung ke index.blade.php
})->name('home');

// Route untuk guest (belum login) - redirect ke dashboard jika sudah login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    
    // Transaction routes
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    
    //Notif
    Route::get('/notifications', [TransactionController::class, 'notifications'])->name('notifications.index');

    // Bill routes
    Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
    Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
    
    // Profile routes
    Route::get('/profile', [UserController::class, 'edit'])->name('profile');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
    
    // Other authenticated routes
    Route::get('/friends', fn() => 'Halaman Friends')->name('friends.index');
    Route::get('/settings', fn() => 'Halaman Settings')->name('settings');
    Route::get('/help', fn() => 'Halaman Help')->name('help');
    
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});