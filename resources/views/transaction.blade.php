@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('title', 'Transaction')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Transaction</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-4 text-gray-600">Transaction Name</th>
                        <th class="py-2 px-4 text-gray-600">Date</th>
                        <th class="py-2 px-4 text-gray-600">Status</th>
                        <th class="py-2 px-4 text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="border-b hover:bg-gray-50" data-transaction-id="{{ $transaction->id }}">
                            <td class="py-2 px-4">{{ $transaction->transaction_name }}</td>
                            <td class="py-2 px-4">{{ $transaction->date }}</td>
                            <td class="py-2 px-4">
                                <span
                                    class="text-xs font-medium px-2 py-1 rounded
                                    {{ $transaction->status === 'Pending'
                                        ? 'bg-red-100 text-red-700'
                                        : ($transaction->status === 'Partially'
                                            ? 'bg-yellow-100 text-yellow-700'
                                            : 'bg-green-100 text-green-700') }}">
                                    {{ $transaction->status }}
                                </span>
                            </td>
                            <td class="py-2 px-4">
                                <button class="text-blue-600 hover:text-blue-800 view-details"
                                    data-id="{{ $transaction->id }}">View Details</button>
                            </td>
                        </tr>
                        <tr class="detail-row hidden" id="detail-{{ $transaction->id }}">
                            <td colspan="4" class="p-4 bg-gray-50">
                                @php
                                    $withUser = $transaction->with ? \App\Models\User::find($transaction->with) : null;
                                    $participants = $transaction->bill ? $transaction->bill->participants ?? [] : [];
                                    $participantItems =
                                        $transaction->bill && $transaction->bill->participantItems
                                            ? $transaction->bill->participantItems->groupBy('bill_user_id')
                                            : collect();
                                    $splitMethod = $transaction->bill->split_method ?? 'equal';
                                @endphp
                                <div class="space-y-4">
                                    <h3 class="text-lg font-semibold text-gray-800">Detail Transaksi</h3>
                                    <div>
                                        <p><strong>Pembuat:</strong>
                                            @if ($withUser)
                                                <img src="https://via.placeholder.com/24" alt="User"
                                                    class="rounded-full inline-block mr-2" />
                                                {{ $withUser->name }}
                                            @else
                                                Tidak Ada
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p><strong>Peserta dan Pembayaran:</strong></p>
                                        @if ($participants)
                                            <form class="status-form" data-transaction-id="{{ $transaction->id }}">
                                                @csrf
                                                @foreach ($participants as $participant)
                                                    @php
                                                        $billUserId = $participant->pivot->id;
                                                        $userItems = $participantItems->get($billUserId, collect());
                                                        $amountToPay = $participant->pivot->amount_to_pay ?? 0;
                                                    @endphp
                                                    <div
                                                        class="ml-4 mt-2 border border-gray-200 p-3 rounded-lg bg-white shadow-sm">
                                                        <p class="font-semibold text-gray-700">{{ $participant->name }}:</p>
                                                        @if ($splitMethod === 'custom' && $userItems->isNotEmpty())
                                                            <ul class="list-disc pl-5 text-sm text-gray-600">
                                                                @foreach ($userItems as $item)
                                                                    <li>
                                                                        {{ $item->item->name ?? 'Item Tidak Diketahui' }} -
                                                                        Jumlah: {{ $item->qty }} -
                                                                        Harga: Rp.
                                                                        {{ number_format(($item->item->price ?? 0) * $item->qty, 2) }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                        <p class="text-sm mt-1 text-gray-700">Jumlah yang harus dibayar:
                                                            <strong>Rp. {{ number_format($amountToPay, 2) }}</strong>
                                                        </p>
                                                        <div class="mt-2 flex items-center gap-2">
                                                            <label class="text-sm text-gray-600">Status:</label>
                                                            <select
                                                                class="border border-gray-300 rounded px-2 py-1 text-sm status-select"
                                                                name="statuses[{{ $billUserId }}]">
                                                                <option value="Pending"
                                                                    {{ $participant->pivot->payment_status === 'Pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="Paid"
                                                                    {{ $participant->pivot->payment_status === 'Paid' ? 'selected' : '' }}>
                                                                    Paid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="mt-4 flex gap-2">
                                                    <button type="button"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 save-statuses"
                                                        data-transaction-id="{{ $transaction->id }}">Simpan</button>
                                                    <button type="button"
                                                        class="text-red-600 hover:text-red-800 delete-transaction"
                                                        data-id="{{ $transaction->id }}">Delete</button>
                                                </div>
                                            </form>
                                        @else
                                            <p>Tidak ada peserta.</p>
                                        @endif
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
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle detail row
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', () => {
                    const transactionId = button.getAttribute('data-id');
                    const detailRow = document.getElementById(`detail-${transactionId}`);
                    detailRow.classList.toggle('hidden');
                });
            });

            // Delete transaction
            document.querySelectorAll('.delete-transaction').forEach(button => {
                button.addEventListener('click', () => {
                    const transactionId = button.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this transaction?')) {
                        fetch(`/transaction/${transactionId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Gagal menghapus transaksi.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus transaksi.');
                        });
                    }
                });
            });

            // Save statuses
            document.querySelectorAll('.save-statuses').forEach(button => {
                button.addEventListener('click', () => {
                    const form = button.closest('.status-form');
                    const transactionId = button.getAttribute('data-transaction-id');
                    const formData = new FormData(form);
                    const statuses = {};

                    // Collect statuses from form
                    formData.forEach((value, key) => {
                        const match = key.match(/^statuses\[(\d+)\]$/);
                        if (match) {
                            const billUserId = match[1];
                            statuses[billUserId] = value;
                        }
                    });

                    fetch('/transaction/update-statuses', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            transaction_id: transactionId,
                            statuses: statuses,
                        }),
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Gagal menyimpan status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menyimpan status.');
                    });
                });
            });
        });
    </script>
@endsection