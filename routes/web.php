<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/transaction', function () {
    return 'Halaman Transaction';
})->name('transaction.index');

Route::get('/bill/create', function () {
    return 'Halaman Create Bill';
})->name('bill.create');

Route::get('/friends', function () {
    return 'Halaman Friends';
})->name('friends.index');

Route::get('/settings', function () {
    return 'Halaman Settings';
})->name('settings');

Route::get('/help', function () {
    return 'Halaman Help';
})->name('help');
