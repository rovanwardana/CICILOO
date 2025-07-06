<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index'); // Langsung ke index.blade.php
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');

Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
Route::post('/bills', [BillController::class, 'store'])->name('bills.store');

Route::get('/friends', fn() => 'Halaman Friends')->name('friends.index');
    
Route::get('/settings', fn() => 'Halaman Settings')->name('settings');
Route::get('/help', fn() => 'Halaman Help')->name('help');

Route::get('/profile', [UserController::class, 'edit'])->name('profile');
Route::post('/profile', [UserController::class, 'update'])->name('profile.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Autentikasi (hanya guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);


Route::get('/help', function () {
    return 'Halaman Help';
})->name('help');

Route::post('/logout', function () {
    \Illuminate\Support\Facades\Session::flush();
    return redirect('/');
})->name('logout');

// Tambahkan ini tanpa menghapus bagian sebelumnya
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

