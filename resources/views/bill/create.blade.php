@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('title', 'New Bill')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">New Bill</h1>

        <!-- Tabs: Split Bill / Group Bill -->
        {{-- <div class="flex space-x-6 border-b mb-6">
            <button id="split-bill-tab" class="px-4 py-2 font-medium text-blue-600 border-b-2 border-blue-600">Split
                Bill</button>
            <button id="group-bill-tab" class="px-4 py-2 font-medium text-gray-500 hover:text-blue-600">Group Bill</button>
        </div> --}}

        <!-- Split Bill Section -->
        <div id="split-bill-content">
            <form id="new-bill-form" action="{{ route('bills.store') }}" method="POST">
                @csrf

                <!-- Bill Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="date"
                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            value="{{ date('Y-m-d') }}" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                        <input type="date" name="due_date"
                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bill Name</label>
                        <input type="text" name="bill_name" id="bill-name" placeholder="Enter bill name"
                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bill Type</label>
                        <select name="bill_type"
                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Select bill type</option>
                            <option value="food">Food & Beverages</option>
                            <option value="transport">Transportation</option>
                            <option value="accommodation">Accommodation</option>
                            <option value="entertainment">Entertainment</option>
                            <option value="shopping">Shopping</option>
                            <option value="utilities">Utilities</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Items Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Items</h3>
                    <div id="items-list" class="space-y-4">
                        <div class="item-row bg-gray-50 p-4 rounded-lg flex flex-col gap-4">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                                    <input type="text" name="items[0][name]" placeholder="Enter item name"
                                        class="w-full rounded border-gray-300 focus:ring-blue-500" required />
                                </div>
                                <div class="w-24">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                    <input type="number" name="items[0][qty]" value="1" min="1"
                                        class="w-full rounded border-gray-300 focus:ring-blue-500 quantity-input"
                                        required />
                                </div>
                                <div class="w-32">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
                                    <div class="flex items-center">
                                        <span class="text-gray-500 mr-2">Rp.</span>
                                        <input type="number" name="items[0][price]" value="0" min="0"
                                            step="0.01"
                                            class="w-full rounded border-gray-300 focus:ring-blue-500 unit-price-input"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium">Total: Rp. <span class="item-total">0</span></span>
                                <button type="button" class="text-red-600 hover:text-red-700 remove-item">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-item"
                        class="mt-4 px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">+ Add Item</button>
                </div>

                <!-- Split Method -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Split Method</label>
                    <select name="split_method" id="split-method"
                        class="w-48 rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="equal">Equal</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>

                <!-- Participants Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Participants</h3>
                    <div id="participants-list" class="space-y-4">
                        <!-- Participant rows will be added here -->
                    </div>
                    <button type="button" id="add-participant"
                        class="mt-4 px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">+ Add
                        Participant</button>
                    <div id="participant-items" class="space-y-4 mt-4 hidden"></div>
                </div>

                <!-- Additional Charges -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Additional Charges</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tax (%)</label>
                            <div class="flex items-center">
                                <input type="number" name="tax_percentage" id="tax-percentage" value="0"
                                    min="0" max="100" step="0.1"
                                    class="w-24 rounded border-gray-300 focus:ring-blue-500" />
                                <span class="ml-2 text-gray-500">%</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Discount</label>
                            <div class="flex items-center">
                                <span class="text-gray-500 mr-2">Rp.</span>
                                <input type="number" name="discount" id="discount" value="0" min="0"
                                    step="0.01" class="w-32 rounded border-gray-300 focus:ring-blue-500" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bill Total -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Bill Total</h3>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm">Subtotal:</span>
                            <span class="text-sm font-medium">Rp. <span id="subtotal">0</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm">Discount:</span>
                            <span class="text-sm font-medium">Rp. <span id="discount-amount">0</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm">Tax:</span>
                            <span class="text-sm font-medium">Rp. <span id="tax-amount">0</span></span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between">
                            <span class="text-base font-semibold">Total:</span>
                            <span class="text-base font-semibold">Rp. <span id="total-amount">0</span></span>
                        </div>
                    </div>
                </div>

                <!-- Split Summary -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Split Summary</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <ul id="split-summary" class="list-disc pl-5 text-sm text-gray-700 space-y-2"></ul>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                    <textarea name="notes" rows="3" placeholder="Add additional notes here..."
                        class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="button"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save
                        Bill</button>
                </div>
            </form>
        </div>

        {{-- <!-- Group Bill Section (Unchanged) -->
        <div id="group-bill-content" class="hidden">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Group Bill</h2>
            <p class="text-sm text-gray-600 mb-4">
                Group Bill adalah fitur untuk mencatat dan membagi banyak tagihan dalam satu grup tetap, seperti "Grup
                Liburan Bali", agar lebih mudah mengelola tagihan tanpa memilih ulang anggota setiap kali.
            </p>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Select Group</label>
                <select class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option>Pilih grup</option>
                    <option>Liburan Bali</option>
                    <option>Kos Bareng</option>
                </select>
            </div>
            <div class="bg-gray-50 border rounded p-4">
                <p class="font-medium mb-2">Bills in this Group:</p>
                <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                    <li>Makanan hari pertama – Rp. 120.000</li>
                    <li>Villa 2 malam – Rp. 1.500.000</li>
                    <li>Sewa motor – Rp. 300.000</li>
                </ul>
                <button class="mt-4 px-4 py-2 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200">+ Add New
                    Bill</button>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
    <script>
        window.allUsers = {!! json_encode($users) !!};
        let itemsData = [];
        let participantCount = 0;

        document.addEventListener('DOMContentLoaded', () => {
            let itemCount = 1;
            const splitMethodSelect = document.getElementById('split-method');
            const participantItemsContainer = document.getElementById('participant-items');

            // Add Item
            document.getElementById('add-item').addEventListener('click', () => {
                const itemsList = document.getElementById('items-list');
                const newItem = document.createElement('div');
                newItem.className = 'item-row bg-gray-50 p-4 rounded-lg flex flex-col gap-4';
                newItem.innerHTML = `
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                            <input type="text" name="items[${itemCount}][name]" placeholder="Enter item name" class="w-full rounded border-gray-300 focus:ring-blue-500" required />
                        </div>
                        <div class="w-24">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                            <input type="number" name="items[${itemCount}][qty]" value="1" min="1" class="w-full rounded border-gray-300 focus:ring-blue-500 quantity-input" required />
                        </div>
                        <div class="w-32">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
                            <div class="flex items-center">
                                <span class="text-gray-500 mr-2">Rp.</span>
                                <input type="number" name="items[${itemCount}][price]" value="0" min="0" step="0.01" class="w-full rounded border-gray-300 focus:ring-blue-500 unit-price-input" required />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium">Total: Rp. <span class="item-total">0</span></span>
                        <button type="button" class="text-red-600 hover:text-red-700 remove-item">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                `;
                itemsList.appendChild(newItem);

                // Add event listeners
                const qtyInput = newItem.querySelector('.quantity-input');
                const priceInput = newItem.querySelector('.unit-price-input');
                const removeBtn = newItem.querySelector('.remove-item');

                [qtyInput, priceInput].forEach(input => input.addEventListener('input', calculateTotals));
                removeBtn.addEventListener('click', () => {
                    newItem.remove();
                    calculateTotals();
                    updateParticipantItems();
                });

                itemCount++;
                calculateTotals();
            });

            // Add Participant
            document.getElementById('add-participant').addEventListener('click', () => {
                const participantsList = document.getElementById('participants-list');
                const newParticipant = document.createElement('div');
                newParticipant.className =
                    'participant-row bg-gray-50 p-4 rounded-lg flex flex-col sm:flex-row sm:items-center gap-4';
                newParticipant.innerHTML = `
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Participant</label>
                        <select name="participants[${participantCount}][id]" class="w-full rounded border-gray-300 focus:ring-blue-500 participant-select" required>
                            <option value="">Select participant</option>
                            ${window.allUsers.map(user => `<option value="${user.id}">${user.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="w-12">
                        <button type="button" class="text-red-600 hover:text-red-700 remove-participant mt-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                `;
                participantsList.appendChild(newParticipant);

                // Add event listeners
                newParticipant.querySelector('.participant-select').addEventListener('change',
                    updateParticipantItems);
                newParticipant.querySelector('.remove-participant').addEventListener('click', () => {
                    newParticipant.remove();
                    updateParticipantItems();
                });

                participantCount++;
                updateParticipantItems();
            });

            // Calculate Totals
            // Calculate Totals
            function calculateTotals() {
                itemsData = [];
                let subtotal = 0;

                document.querySelectorAll('.item-row').forEach((row, index) => {
                    const name = row.querySelector(`input[name="items[${index}][name]"]`).value;
                    const qty = parseFloat(row.querySelector(`input[name="items[${index}][qty]"]`).value ||
                        0);
                    const price = parseFloat(row.querySelector(`input[name="items[${index}][price]"]`)
                        .value || 0);
                    const total = qty * price;

                    row.querySelector('.item-total').textContent = total.toLocaleString('id-ID');
                    itemsData.push({
                        name,
                        qty,
                        price,
                        total
                    });
                    subtotal += total;
                });

                const discount = parseFloat(document.getElementById('discount').value || 0);
                const taxPercentage = parseFloat(document.getElementById('tax-percentage').value || 0);
                const taxAmount = ((subtotal - discount) * taxPercentage) / 100;
                const totalAmount = subtotal - discount + taxAmount;

                document.getElementById('subtotal').textContent = subtotal.toLocaleString('id-ID');
                document.getElementById('discount-amount').textContent = discount.toLocaleString('id-ID');
                document.getElementById('tax-amount').textContent = taxAmount.toLocaleString('id-ID');
                document.getElementById('total-amount').textContent = totalAmount.toLocaleString('id-ID');

                // Panggil updateSplitSummary langsung untuk memastikan sinkronisasi
                updateSplitSummary();
            }

            // Update Participant Items
            function updateParticipantItems() {
                const splitMethod = document.getElementById('split-method').value;
                const participantItemsContainer = document.getElementById('participant-items');
                participantItemsContainer.classList.toggle('hidden', splitMethod === 'equal');

                if (splitMethod === 'equal') {
                    updateSplitSummary();
                    return;
                }

                participantItemsContainer.innerHTML = '';
                const selectedParticipants = Array.from(document.querySelectorAll('.participant-select')).map(
                    select => {
                        const id = select.value;
                        const user = window.allUsers.find(u => u.id.toString() === id);
                        return {
                            id,
                            name: user ? user.name : ''
                        };
                    }).filter(p => p.id);

                selectedParticipants.forEach((participant, pIndex) => {
                    const participantDiv = document.createElement('div');
                    participantDiv.className = 'bg-gray-50 p-4 rounded-lg mb-4';
                    let itemsHtml =
                        `<h4 class="text-sm font-medium text-gray-800 mb-2">${participant.name}</h4>`;
                    itemsHtml += '<div class="space-y-2">';

                    itemsData.forEach((item, index) => {
                        // Ambil nilai qty sebelumnya jika ada, atau gunakan 0 sebagai default
                        const prevQtyInput = document.querySelector(
                            `input[name="participants[${pIndex}][items][${index}][qty]"]`);
                        const prevQty = prevQtyInput ? parseFloat(prevQtyInput.value || 0) : 0;
                        itemsHtml += `
                <div class="flex items-center justify-between">
                    <label class="text-sm text-gray-700">${item.name} (Rp. ${item.total.toLocaleString('id-ID')})</label>
                    <input type="number" name="participants[${pIndex}][items][${index}][qty]" value="${prevQty}" min="0" max="${item.qty}" step="1" class="w-20 rounded border-gray-300 focus:ring-blue-500 participant-item-qty" data-item-index="${index}" />
                </div>
            `;
                    });

                    itemsHtml += '</div>';
                    participantDiv.innerHTML = itemsHtml;
                    participantItemsContainer.appendChild(participantDiv);
                });

                // Tambahkan event listener untuk input qty baru
                document.querySelectorAll('.participant-item-qty').forEach(input => {
                    input.addEventListener('input', updateSplitSummary);
                });

                updateSplitSummary();
            }

            // Update Split Summary
            function updateSplitSummary() {
                const splitSummary = document.getElementById('split-summary');
                splitSummary.innerHTML = '';
                const splitMethod = document.getElementById('split-method').value;
                const selectedParticipants = Array.from(document.querySelectorAll('.participant-select')).map(
                    select => {
                        const id = select.value;
                        const user = window.allUsers.find(u => u.id.toString() === id);
                        return {
                            id,
                            name: user ? user.name : ''
                        };
                    }).filter(p => p.id);

                const subtotal = itemsData.reduce((sum, item) => sum + item.total, 0);
                const discount = parseFloat(document.getElementById('discount').value || 0);
                const taxPercentage = parseFloat(document.getElementById('tax-percentage').value || 0);
                const taxAmount = ((subtotal - discount) * taxPercentage) / 100;
                const totalAmount = subtotal - discount + taxAmount;

                if (splitMethod === 'equal') {
                    const perPerson = selectedParticipants.length > 0 ? totalAmount / selectedParticipants.length :
                        0;
                    selectedParticipants.forEach(participant => {
                        const li = document.createElement('li');
                        li.textContent =
                            `${participant.name}: Rp. ${perPerson.toLocaleString('id-ID')} (Equal Split)`;
                        splitSummary.appendChild(li);
                    });
                } else {
                    const participantTotals = {};

                    selectedParticipants.forEach((participant, pIndex) => {
                        participantTotals[participant.id] = {
                            name: participant.name,
                            total: 0,
                            items: []
                        };
                        itemsData.forEach((item, index) => {
                            const qtyInput = document.querySelector(
                                `input[name="participants[${pIndex}][items][${index}][qty]"]`);
                            const qty = qtyInput ? parseFloat(qtyInput.value || 0) : 0;
                            if (qty > 0) {
                                const itemTotal = (item.price * qty);
                                participantTotals[participant.id].total += itemTotal;
                                participantTotals[participant.id].items.push(
                                    `${qty} x ${item.name} (Rp. ${itemTotal.toLocaleString('id-ID')})`
                                );
                            }
                        });
                    });

                    Object.values(participantTotals).forEach(participant => {
                        const li = document.createElement('li');
                        const taxShare = participant.total > 0 ? (participant.total / subtotal) *
                            taxAmount : 0;
                        const discountShare = participant.total > 0 ? (participant.total / subtotal) *
                            discount : 0;
                        const finalTotal = participant.total - discountShare + taxShare;
                        li.innerHTML = `
                ${participant.name}: Rp. ${finalTotal.toLocaleString('id-ID')}
                <ul class="list-circle pl-6 mt-1">
                    ${participant.items.map(item => `<li>${item}</li>`).join('')}
                </ul>
            `;
                        splitSummary.appendChild(li);
                    });
                }
            }

            // Event Listeners
            ['discount', 'tax-percentage'].forEach(id => {
                document.getElementById(id).addEventListener('input', calculateTotals);
            });

            splitMethodSelect.addEventListener('change', updateParticipantItems);
            calculateTotals();
        });
    </script>
@endpush
