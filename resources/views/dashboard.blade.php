@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('title', 'Dashboard')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Section -->
    <div class="col-span-2 space-y-6">

        <!-- Groups & Bills Tabs -->
        <div class="bg-[#E3C39D] rounded-xl flex justify-center gap-30 py-4">
            <!-- Groups -->
            <div class="flex flex-col items-center cursor-pointer hover:opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-users-round-icon lucide-users-round">
                    <path d="M18 21a8 8 0 0 0-16 0" />
                    <circle cx="10" cy="8" r="5" />
                    <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                </svg>
                <span class="mt-1 font-medium text-gray-800">Groups</span>
            </div>

            <!-- Bills -->
            <div class="flex flex-col items-center cursor-pointer hover:opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-receipt-text-icon lucide-receipt-text">
                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                    <path d="M14 8H8" />
                    <path d="M16 12H8" />
                    <path d="M13 16H8" />
                </svg>
                <span class="mt-1 font-medium text-gray-800">Bills</span>
            </div>
        </div>

        <!-- You are owed -->
        <div class="bg-gradient-to-r from-white to-blue-100 p-6 rounded-xl shadow flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-green-600">You are owed</h2>
                <p class="text-3xl mt-2 text-green-600">Rp 500.000</p>
            </div>
            <img src="{{ asset('assets/image/owed.svg') }}" alt="You are owed" class="w-35 h-35">
        </div>

        <!-- You owe -->
        <div class="bg-gradient-to-r from-white to-blue-100 p-6 rounded-xl shadow flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-red-600">You owe</h2>
                <p class="text-3xl mt-2 text-red-600">Rp 45.000</p>
            </div>
            <img src="{{ asset('assets/image/owe.svg') }}" alt="You owe" class="w-24 h-24">
        </div>

        <!-- Dummy Chart -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Bill Split Visualization</h2>
            <div class="h-40 flex items-center justify-center text-gray-400">
                [ Chart Placeholder ]
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="col-span-1">
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
            <ul class="mt-4 space-y-4 text-gray-700">
                <li class="flex justify-between items-center" data-notify="true">
                    <span>💸 John paid you</span>
                    <span class="font-semibold">Rp 50.000</span> <br>
                </li> 
                <li class="flex justify-between items-center" data-notify="true">
                    <span>💰 You owe Emma</span>
                    <span class="font-semibold">Rp 20.000</span> <br>
                </li> 
                <!-- Item lain tanpa notifikasi -->
            </ul> <br>  
            <li class="flex justify-between items-center">
                <span>📋 New bill created: <bold>Lunch</bold></span> <br>
            </li> <br>
            <h2 class="text-lg font-semibold text-gray-700">Yesterday</h2>
            <li class="flex justify-between items-center" data-notify="true">
                <span>💸 John paid you</span>
                <span class="font-semibold">Rp 50.000</span> <br>
            </li> 
            </ul>
        </div>
    </div>
</div>
@endsection