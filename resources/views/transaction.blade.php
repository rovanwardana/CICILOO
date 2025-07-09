@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Transaction')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold text-gray-800">Transaction</h1>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <!-- Transaction Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2 px-4 text-gray-600 cursor-pointer">Transaction Name</th>
                    <th class="py-2 px-4 text-gray-600 cursor-pointer">With</th>
                    <th class="py-2 px-4 text-gray-600 cursor-pointer">Date</th>
                    <th class="py-2 px-4 text-gray-600 cursor-pointer">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $transaction->transaction_name }}</td>
                        <td class="py-2 px-4 flex items-center space-x-2">
                            @php $users = explode(',', $transaction->with); @endphp
                            @foreach ($users as $user)
                                <img src="https://via.placeholder.com/24" alt="User" class="rounded-full" />
                            @endforeach
                        </td>
                        <td class="py-2 px-4">{{ $transaction->date }}</td>
                        <td class="py-2 px-4">
                            <div class="relative">
                                <button id="status-btn-{{ $transaction->id }}" class="inline-flex items-center justify-between w-32 bg-white border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-50 focus:outline-none" onclick="toggleStatusDropdown({{ $transaction->id }})">
                                    <span class="flex items-center">
                                        <span class="w-2 h-2 {{ $transaction->status === 'Pending' ? 'bg-red-300' : ($transaction->status === 'Partially' ? 'bg-yellow-300' : 'bg-green-300') }} rounded-full mr-2"></span>
                                        {{ $transaction->status }}
                                    </span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div id="status-dropdown-{{ $transaction->id }}" class="hidden absolute z-10 mt-1 w-32 bg-white border border-gray-300 rounded-md shadow-lg">
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="updateStatus({{ $transaction->id }}, 'Pending')"> 
                                        <span class="w-2 h-2 bg-red-300 rounded-full mr-2"></span> Pending
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="updateStatus({{ $transaction->id }}, 'Partially')"> 
                                        <span class="w-2 h-2 bg-yellow-300 rounded-full mr-2"></span> Partially
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="updateStatus({{ $transaction->id }}, 'Paid')"> 
                                        <span class="w-2 h-2 bg-green-300 rounded-full mr-2"></span> Paid
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleStatusDropdown(id) {
        const dropdown = document.getElementById(`status-dropdown-${id}`);
        dropdown.classList.toggle('hidden');
    }

    function updateStatus(id, status) {
        const button = document.getElementById(`status-btn-${id}`);
        button.innerHTML = `
            <span class="flex items-center">
                <span class="w-2 h-2 ${status === 'Pending' ? 'bg-red-300' : (status === 'Partially' ? 'bg-yellow-300' : 'bg-green-300')} rounded-full mr-2"></span>
                ${status}
            </span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        `;
        // Logika untuk update ke server (sementara hanya frontend)
        // Tambahkan AJAX di sini jika ingin simpan ke database
    }

    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('[id^="status-dropdown-"]');
        dropdowns.forEach(dropdown => {
            if (!dropdown.classList.contains('hidden') && !event.target.closest(`#status-btn-${dropdown.id.split('-')[2]}`)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
@endsection