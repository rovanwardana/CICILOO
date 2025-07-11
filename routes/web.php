<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TncController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\CookiesController;

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
    Route::get('/notifications', [NotificationController::class, 'index']);

    // Bill routes
    Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
    Route::post('/bills', [BillController::class, 'store'])->name('bills.store');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

    // Friends routes
    Route::get('/friends', [FriendsController::class, 'index'])->name('friends.index')->middleware('auth');
    Route::post('/friends/add', [FriendsController::class, 'addFriend'])->name('friends.add')->middleware('auth');
    Route::post('/friends/accept/{friendId}', [FriendsController::class, 'acceptFriend'])->name('friends.accept')->middleware('auth');
    Route::post('/friends/remove/{friendId}', [FriendsController::class, 'removeFriend'])->name('friends.remove')->middleware('auth');
    Route::post('/friends/search', [FriendsController::class, 'searchFriends'])->name('friends.search')->middleware('auth');
    
    // Settings routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    // Help routes
    Route::get('/help', [HelpController::class, 'index'])->name('help');
    Route::get('/help/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/help/tnc', [TncController::class, 'index'])->name('tnc');
    Route::get('/help/privacy', [PrivacyController::class, 'index'])->name('privacy');
    Route::get('/help/cookies', [CookiesController::class, 'index'])->name('cookies');

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
