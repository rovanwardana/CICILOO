@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('title', 'Dashboard')

@section('content')
<div class="flex justify-end mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- You are owed -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-bold text-green-600">You are owed</h2>
        <p class="text-3xl mt-2">Rp 500.000</p>
    </div>

    <!-- You owe -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-bold text-red-600">You owe</h2>
        <p class="text-3xl mt-2">Rp 45.000</p>
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-white p-6 mt-6 rounded shadow">
    <h2 class="text-lg font-semibold">Recent Activity</h2>
    <ul class="mt-4 space-y-2 text-gray-700">
        <li>💸 John paid you - Rp 50.000</li>
        <li>💰 You owe Emma - Rp 20.000</li>
        <li>📋 New bill created: Lunch</li>
    </ul>
</div>
@endsection
