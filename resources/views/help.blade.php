@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Help & Support')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Help & Support</h1>
</div>

<div class="bg-gray-100 min-h-screen py-4 px-6 rounded-xl shadow-sm space-y-6">

    <!-- Bagian 1: Get Support -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Get Support</h2>
        <div class="space-y-4">
            <!-- Item 1: Frequently Asked Questions -->
            <div class="flex justify-between items-center p-4 border rounded-md">
                <div>
                    <h3 class="font-medium text-gray-700">Frequently Asked Questions</h3>
                    <p class="text-sm text-gray-500">Get answers to common questions</p>
                </div>
                <a href="{{ route('faq') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">View FAQ</a>
            </div>
            <!-- Item 2 -->
            <div class="flex justify-between items-center p-4 border rounded-md">
                <div>
                    <h3 class="font-medium text-gray-700">Contact Support</h3>
                    <p class="text-sm text-gray-500">Get help from our support team</p>
                </div>
                <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">Contact</button>
            </div>
            <!-- Item 3 -->
            <div class="flex justify-between items-center p-4 border rounded-md">
                <div>
                    <h3 class="font-medium text-gray-700">Live Chat</h3>
                    <p class="text-sm text-gray-500">Chat with our support agents in real-time</p>
                </div>
                <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">Start Chat</button>
            </div>
        </div>
    </div>

    <!-- Bagian 2: Legal Information -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Legal Information</h2>
        <div class="space-y-4">
            <!-- Legal Item 1 -->
            <div class="flex justify-between items-center p-4 border rounded-md">
                <div>
                    <h3 class="font-medium text-gray-700">Terms & Conditions</h3>
                    <p class="text-sm text-gray-500">Read our terms of service</p>
                </div>
                <a href="{{ route('tnc') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">View</a>
            </div>
            <!-- Legal Item 2 -->
            <div class="flex justify-between items-center p-4 border rounded-md">
                <div>
                    <h3 class="font-medium text-gray-700">Privacy Policy</h3>
                    <p class="text-sm text-gray-500">Information on how we use your data</p>
                </div>
                <a href="{{ route('privacy') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">View</a>
            </div>
            <!-- Legal Item 3 -->
            <div class="flex justify-between items-center p-4 border rounded-md">
                <div>
                    <h3 class="font-medium text-gray-700">Cookies Policy</h3>
                    <p class="text-sm text-gray-500">Learn about our use of cookies</p>
                </div>
                <a href="{{ route('cookies') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">View</a>
            </div>
        </div>
    </div>

</div>
@endsection