<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');

Route::get('/bill', function () {
    return view('bill');
})->name('bill');

Route::get('/friends', function () {
    return 'Halaman Friends';
})->name('friends.index');

Route::get('/settings', function () {
    return 'Halaman Settings';
})->name('settings');

Route::get('/help', function () {
    return 'Halaman Help';
})->name('help');
