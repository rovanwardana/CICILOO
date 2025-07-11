@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Privacy Policy')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-semibold text-gray-800">Privacy Policy – Ciciloo</h1>
    <p class="text-gray-600">Last Updated: July 11, 2025</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-md space-y-6">
    <div>
        <p class="text-gray-600">Ciciloo values your privacy. This policy explains how we collect, use, and protect your personal data.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">1. Information We Collect</h2>
        <ul class="list-disc list-inside text-gray-600 space-y-1">
            <li>Name, email, password (for account)</li>
            <li>Bill and transaction details</li>
            <li>Optional profile info (like photo)</li>
        </ul>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">2. How We Use Your Data</h2>
        <ul class="list-disc list-inside text-gray-600 space-y-1">
            <li>To manage user accounts and split bills</li>
            <li>To improve app experience</li>
            <li>To notify users about activity or changes</li>
        </ul>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">3. Data Sharing</h2>
        <p class="text-gray-600">We do not share your data with third parties, unless required by law.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">4. Data Security</h2>
        <p class="text-gray-600">We use reasonable security measures to protect your information.</p>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">5. Your Rights</h2>
        <p class="text-gray-600">You can request to update or delete your data at any time.</p>
    </div>
</div>
@endsection