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