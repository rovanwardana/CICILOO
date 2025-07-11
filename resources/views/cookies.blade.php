@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Cookies Policy')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-semibold text-gray-800">Cookies Policy – Ciciloo</h1>
    <p class="text-gray-600">Last Updated: July 11, 2025</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-md space-y-6">
    <div>
        <p class="text-gray-600">Ciciloo uses cookies to improve your experience on our site.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">1. What Are Cookies?</h2>
        <p class="text-gray-600">Cookies are small text files stored on your device to help websites remember you.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">2. Why We Use Cookies</h2>
        <ul class="list-disc list-inside text-gray-600 space-y-1">
            <li>To keep you logged in</li>
            <li>To save your preferences (like dark mode)</li>
            <li>To analyze how users use our site</li>
        </ul>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">3. Managing Cookies</h2>
        <p class="text-gray-600">You can manage or disable cookies through your browser settings. Please note that some features may not work properly without cookies.</p>
    </div>
</div>
@endsection