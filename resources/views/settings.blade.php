@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Settings')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold text-gray-800">Settings</h1>
</div>

<div class="space-y-6">
    <!-- General Settings -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center space-x-2">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m0 14v1m8-8h1M4 12H3m15.36 6.36l-.71-.71M6.34 6.34l-.71-.71m12.02 0l-.71.71M6.34 17.66l-.71.71"></path>
            </svg>
            <span>General Settings</span>
        </h2>

        <div class="space-y-4">
            @foreach ([['Profile settings', 'Edit Profile'], ['Change Password', 'Change'], ['Language', null]] as [$label, $button])
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-sm text-gray-700">{{ $label }}</p>
                        <p class="text-sm text-gray-500">
                            @if ($label === 'Profile settings') Update your personal informations
                            @elseif ($label === 'Change Password') Update your account password
                            @elseif ($label === 'Language') Choose your preferred language
                            @endif
                        </p>
                    </div>
                    @if ($button)
                        <button class="text-sm px-4 py-1.5 border rounded-md text-gray-700 hover:bg-gray-100">{{ $button }}</button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Notification Settings -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center space-x-2">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5"></path>
            </svg>
            <span>Notification Settings</span>
        </h2>

        @foreach (['Email Notification', 'Push Notification', 'Payment Reminder'] as $item)
        <div class="flex justify-between items-center mb-2">
            <div>
                <p class="text-sm font-medium text-gray-700">{{ $item }}</p>
                <p class="text-sm text-gray-500">
                    @if ($item === 'Email Notification') Receive updates and alerts via email
                    @elseif ($item === 'Push Notification') Receive notifications on your device
                    @elseif ($item === 'Payment Reminder') Get reminded about upcoming payments
                    @endif
                </p>
            </div>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer" checked>
                <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-blue-500 rounded-full peer peer-checked:bg-blue-600 transition"></div>
            </label>
        </div>
        @endforeach
    </div>

    <!-- Privacy & Security -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center space-x-2">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 1.105-.895 2-2 2s-2-.895-2-2 2-4 2-4 2 2.895 2 4zM12 19c0 1.105-.895 2-2 2s-2-.895-2-2 2-4 2-4 2 2.895 2 4z" />
            </svg>
            <span>Privacy & Security</span>
        </h2>

        @foreach ([['Blocked Users', 'Manage'], ['Two-Factor Authentication', null], ['Visibility Settings', 'Manage']] as [$label, $button])
        <div class="flex justify-between items-center mb-2">
            <div>
                <p class="text-sm font-medium text-gray-700">{{ $label }}</p>
                <p class="text-sm text-gray-500">
                    @if ($label === 'Blocked Users') Connect with Google, Apple, etc
                    @elseif ($label === 'Two-Factor Authentication') Add an extra layer of security
                    @elseif ($label === 'Visibility Settings') Control who can see your information
                    @endif
                </p>
            </div>
            @if ($label === 'Two-Factor Authentication')
                <div class="flex items-center space-x-2">
                    <span class="text-xs text-blue-600 border border-blue-600 px-2 rounded-full">Recommended</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600 transition"></div>
                    </label>
                </div>
            @elseif ($button)
                <button class="text-sm px-4 py-1.5 border rounded-md text-gray-700 hover:bg-gray-100">{{ $button }}</button>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Account Management -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center space-x-2">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A1.5 1.5 0 016 17h12a1.5 1.5 0 01.879.296l1.5 1.2A1.5 1.5 0 0120 21H4a1.5 1.5 0 01-1.379-2.504l1.5-1.2z"></path>
            </svg>
            <span>Account Management</span>
        </h2>

        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-700">Linked Accounts</p>
                    <p class="text-sm text-gray-500">Update your personal informations</p>
                </div>
                <button class="text-sm px-4 py-1.5 border rounded-md text-gray-700 hover:bg-gray-100">Manage</button>
            </div>

            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-700">Delete Account</p>
                    <p class="text-sm text-gray-500">Permanently remove your account and data</p>
                </div>
                <button class="text-sm px-4 py-1.5 border border-red-500 text-red-600 rounded-md hover:bg-red-50">Delete</button>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle switch handler
    function toggleSwitch(element) {
        element.classList.toggle('bg-blue-600');
    }

    // Delete confirmation
    function confirmDelete() {
        if (confirm("Are you sure you want to delete your account?")) {
            alert("Account deleted (simulasi)");
        }
    }
</script>
@endpush
