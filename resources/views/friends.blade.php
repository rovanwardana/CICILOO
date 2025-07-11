@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Friends')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold text-gray-800">Friends</h1>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <!-- Friends List Header -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
            <h2 class="text-lg font-medium text-gray-800">Friends List</h2>
        </div>
        <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add
        </button>
    </div>

    <!-- Friends List -->
    <div class="space-y-2">
        @forelse ($friends as $friend)
            <div class="flex items-center justify-between p-4 border-b border-gray-100 hover:bg-gray-50 rounded-lg">
                <!-- Friend Info -->
                <div class="flex items-center space-x-3">
                    <!-- Avatar -->
                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-medium text-sm">
                        @php
                            $nameParts = explode(' ', $friend->name);
                            $initials = strtoupper(substr($nameParts[0], 0, 1));
                            if (count($nameParts) > 1) {
                                $initials .= strtoupper(substr($nameParts[1], 0, 1));
                            }
                        @endphp
                        {{ $initials }}
                    </div>
                    
                    <!-- Friend Details -->
                    <div class="flex flex-col">
                        <h3 class="text-sm font-medium text-gray-900">{{ $friend->name }}</h3>
                        <p class="text-sm text-gray-500">
                            @if($friend->balance > 0)
                                I owe you Rp {{ number_format($friend->balance, 0, ',', '.') }}
                            @elseif($friend->balance < 0)
                                You owe me Rp {{ number_format(abs($friend->balance), 0, ',', '.') }}
                            @else
                                No pending balance
                            @endif
                            @if($friend->last_transaction_date)
                                • {{ $friend->last_transaction_date->format('M d, Y') }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-2">
                    <!-- Chat Button -->
                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-md focus:outline-none" title="Chat">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </button>
                    
                    <!-- Profile Button -->
                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-md focus:outline-none" title="Profile">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </button>
                    
                    <!-- More Options -->
                    <div class="relative">
                        <button id="more-btn-{{ $friend->id }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-md focus:outline-none" onclick="toggleMoreDropdown({{ $friend->id }})" title="More options">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="more-dropdown-{{ $friend->id }}" class="hidden absolute right-0 z-10 mt-1 w-48 bg-white border border-gray-300 rounded-md shadow-lg">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Details</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Send Reminder</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Friend</a>
                            <div class="border-t border-gray-100"></div>
                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Remove Friend</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No friends yet</h3>
                <p class="text-gray-500 mb-4">Add your first friend to start splitting bills together!</p>
                <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Friend
                </button>
            </div>
        @endforelse
    </div>
</div>

<script>
    function toggleMoreDropdown(id) {
        const dropdown = document.getElementById(`more-dropdown-${id}`);
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('[id^="more-dropdown-"]');
        dropdowns.forEach(dropdown => {
            if (!dropdown.classList.contains('hidden') && !event.target.closest(`#more-btn-${dropdown.id.split('-')[2]}`)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
@endsection