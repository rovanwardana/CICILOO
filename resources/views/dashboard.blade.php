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
        {{-- <div class="bg-[#E3C39D] rounded-xl p-4">
            <div class="flex justify-center gap-10 mb-4">
                <div class="flex flex-col items-center cursor-pointer hover:opacity-80" onclick="showTab('groups')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-users-round">
                        <path d="M18 21a8 8 0 0 0-16 0" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                    </svg>
                    <span class="mt-1 font-medium text-gray-800">Groups</span>
                </div>
                <div class="flex flex-col items-center cursor-pointer hover:opacity-80" onclick="showTab('bills')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-receipt-text">
                        <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                        <path d="M14 8H8" />
                        <path d="M16 12H8" />
                        <path d="M13 16H8" />
                    </svg>
                    <span class="mt-1 font-medium text-gray-800">Bills</span>
                </div>
            </div>
            <div id="groups" class="tab-content hidden">
                <p class="text-gray-600">No groups available. Create a group to collaborate with friends!</p>
            </div>
            <div id="bills" class="tab-content">
                <ul class="space-y-2">
                    @php
                        $bills = \App\Models\Bill::where('customer_id', Auth::id())
                            ->orWhereHas('participants', function ($query) {
                                $query->where('user_id', Auth::id());
                            })
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp
                    @forelse ($bills as $bill)
                        <li class="flex justify-between items-center">
                            <span>{{ $bill->bill_number }}: {{ $bill->bill_type }}</span>
                            <span>Rp {{ number_format($bill->total_amount, 2) }}</span>
                        </li>
                    @empty
                        <li class="text-gray-600">No bills available.</li>
                    @endforelse
                </ul>
            </div>
        </div> --}}

        <!-- You are owed -->
        <div class="bg-gradient-to-r from-white to-blue-100 p-6 rounded-xl shadow flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-green-600">You are owed</h2>
                <p class="text-3xl mt-2 text-green-600">Rp {{ number_format($youAreOwed, 2) }}</p>
            </div>
            <img src="{{ asset('assets/image/owed.svg') }}" alt="You are owed" class="w-40 h-40">
        </div>

        <!-- You owe -->
        <div class="bg-gradient-to-r from-white to-blue-100 p-6 rounded-xl shadow flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-red-600">You owe</h2>
                <p class="text-3xl mt-2 text-red-600">Rp {{ number_format($youOwe, 2) }}</p>
            </div>
            <img src="{{ asset('assets/image/owe.svg') }}" alt="You owe" class="w-40 h-40">
        </div>

        <!-- Bill Split Visualization -->
        {{-- <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Bill Split Visualization</h2>
            @if (!empty($chartData['labels']))
                ```chartjs
                {
                    "type": "pie",
                    "data": {
                        "labels": {{ json_encode($chartData['labels']) }},
                        "datasets": [{
                            "data": {{ json_encode($chartData['amounts']) }},
                            "backgroundColor": {{ json_encode($chartData['colors']) }},
                            "borderColor": "#ffffff",
                            "borderWidth": 2
                        }]
                    },
                    "options": {
                        "responsive": true,
                        "plugins": {
                            "legend": {
                                "position": "top",
                                "labels": {
                                    "font": {
                                        "size": 14
                                    }
                                }
                            },
                            "title": {
                                "display": true,
                                "text": "Latest Bill Distribution",
                                "font": {
                                    "size": 16
                                }
                            }
                        }
                    }
                }
                ```
            @else
                <div class="h-40 flex items-center justify-center text-gray-400">
                    No bill data available for visualization.
                </div>
            @endif
        </div> --}}
    </div>

    <!-- Right Section -->
    <div class="col-span-1">
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
            <ul class="mt-4 space-y-4 text-gray-700">
                @php
                    $today = now()->startOfDay();
                    $yesterday = now()->subDay()->startOfDay();
                    $groupedActivities = $recentActivities->groupBy(function ($activity) use ($today, $yesterday) {
                        $createdAt = $activity->created_at;
                        if ($createdAt->isToday()) return 'Today';
                        if ($createdAt->isYesterday()) return 'Yesterday';
                        return $createdAt->format('d M Y');
                    });
                @endphp

                @foreach ($groupedActivities as $date => $activities)
                    <h2 class="text-lg font-semibold text-gray-700 mt-4">{{ $date }}</h2>
                    @foreach ($activities as $activity)
                        <li class="flex justify-between items-center" data-notify="true">
                            @if ($activity->bill && $activity->bill->participants->where('user_id', Auth::id())->first()?->pivot->payment_status === 'Pending')
                                <span>💰 You owe {{ $activity->bill->participants->where('user_id', $activity->with)->first()->name ?? 'Someone' }}</span>
                                <span class="font-semibold">Rp {{ number_format($activity->bill->participants->where('user_id', Auth::id())->first()->pivot->amount_to_pay, 2) }}</span>
                            @elseif ($activity->bill && $activity->bill->participants->where('payment_status', 'Paid')->count() > 0)
                                <span>💸 {{ $activity->bill->participants->where('payment_status', 'Paid')->first()->name ?? 'Someone' }} paid you</span>
                                <span class="font-semibold">Rp {{ number_format($activity->bill->participants->where('payment_status', 'Paid')->first()->pivot->amount_to_pay, 2) }}</span>
                            @else
                                <span>📋 New bill created: <strong>{{ $activity->transaction_name }}</strong></span>
                            @endif
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
        document.getElementById(tabId).classList.remove('hidden');
    }
    // Tampilkan tab Bills secara default
    document.getElementById('bills').classList.remove('hidden');
</script>
@endpush
@endsection