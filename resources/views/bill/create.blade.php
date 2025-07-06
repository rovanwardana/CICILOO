@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('title', 'New Bill')

@section('content')
<div class="bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">New Bill</h1>

    <!-- Tabs: Split Bill / Group Bill -->
    <div class="flex space-x-6 border-b mb-6">
        <button id="split-bill-tab" class="px-4 py-2 font-medium text-blue-600 border-b-2 border-blue-600">Split Bill</button>
        <button id="group-bill-tab" class="px-4 py-2 font-medium text-gray-500 hover:text-blue-600">Group Bill</button>
    </div>

    <!-- Split Bill Section -->
    <div id="split-bill-content">
        <!-- Bill Sheet Tabs -->
        <div class="flex items-center space-x-2 mb-4">
            <button id="bill-1" class="px-4 py-2 bg-white border-b-2 border-blue-600 text-blue-600 font-medium">Bill 1</button>
            <button id="bill-2" class="px-4 py-2 bg-white border-b-2 border-transparent text-gray-500 hover:text-blue-600">Bill 2</button>
            <button id="add-bill-tab" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </button>
        </div>

        <form id="new-bill-form" action="{{ route('bills.store') }}" method="POST">
            @csrf
            
            <!-- Date -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" value="{{ date('Y-m-d') }}" />
            </div>

            <!-- 2x2 Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Bill Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bill Type</label>
                    <select name="bill_type" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
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

                <!-- Participants -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Participants</label>
                    <div class="relative">
                        <input type="text" id="participant-input" placeholder="Add participant by email or username" 
                               class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500 pr-10">
                        <button type="button" id="add-participant" class="absolute right-2 top-2 text-blue-600 hover:text-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Participants List -->
                    <div id="participants-list" class="mt-2 flex flex-wrap gap-2">
                        <!-- Participants will be added here dynamically -->
                    </div>
                </div>

                <!-- Bill Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bill Name</label>
                    <input type="text" name="bill_name" id="bill-name" placeholder="Enter bill name" 
                           class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>

                <!-- Due Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <input type="date" name="due_date" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>
            </div>

            <!-- Split Method -->
            <div class="flex justify-end mb-4">
                <div class="w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Split Method</label>
                    <select name="split_method" id="split-method" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="equal">Equal</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
            </div>

            <!-- Items Table -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-800 mb-3">Items</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b">Item Name</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b">Quantity</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b">Unit Price</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b">Total</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b" id="assigned-to-header">Assigned To</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody id="items-table-body">
                            <tr class="item-row">
                                <td class="px-4 py-3 border-b">
                                    <input type="text" name="items[0][name]" placeholder="Enter item name" 
                                           class="w-full border-0 focus:ring-0 p-0" />
                                </td>
                                <td class="px-4 py-3 border-b">
                                    <input type="number" name="items[0][quantity]" value="1" min="1" 
                                           class="w-full border-0 focus:ring-0 p-0 quantity-input" />
                                </td>
                                <td class="px-4 py-3 border-b">
                                    <div class="flex items-center">
                                        <span class="text-gray-500 mr-1">Rp.</span>
                                        <input type="number" name="items[0][unit_price]" value="0" min="0" step="0.01" 
                                               class="w-full border-0 focus:ring-0 p-0 unit-price-input" />
                                    </div>
                                </td>
                                <td class="px-4 py-3 border-b">
                                    <span class="text-gray-500">Rp.</span>
                                    <span class="item-total">0</span>
                                </td>
                                <td class="px-4 py-3 border-b assigned-to-cell">
                                    <select name="items[0][assigned_to]" class="w-full border-0 focus:ring-0 p-0 assigned-to-select" style="display: none;">
                                        <option value="">Select Person</option>
                                    </select>
                                    <span class="equal-split-text">Auto Split</span>
                                </td>
                                <td class="px-4 py-3 border-b">
                                    <button type="button" class="text-red-600 hover:text-red-700 remove-item">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" id="add-item" class="mt-3 px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                    + Add Item
                </button>
            </div>

            <!-- Bill Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Left: Additional Charges -->
                <div>
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Additional Charges</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-gray-700">Tax (%)</label>
                            <div class="flex items-center space-x-2">
                                <input type="number" name="tax_percentage" id="tax-percentage" value="0" min="0" max="100" step="0.1" 
                                       class="w-20 rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                                <span class="text-sm text-gray-500">%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-gray-700">Discount</label>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">Rp.</span>
                                <input type="number" name="discount" id="discount" value="0" min="0" step="0.01" 
                                       class="w-24 rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Bill Total -->
                <div>
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
            </div>

            <!-- Notes -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                <textarea name="notes" rows="3" placeholder="Add additional notes here..." 
                          class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>

            <!-- Split Summary -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-800 mb-3">Split Summary</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div id="split-summary">
                        <p class="text-sm text-gray-600">Add participants to see split breakdown</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4">
                <button type="button" class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save Bill
                </button>
            </div>
        </form>
    </div>

    <!-- Group Bill Section (Hidden by default) -->
    <div id="group-bill-content" class="hidden">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Group Bill</h2>
        <p class="text-sm text-gray-600 mb-4">
            Group Bill adalah fitur untuk mencatat dan membagi banyak tagihan dalam satu grup tetap, seperti "Grup Liburan Bali", agar lebih mudah mengelola tagihan tanpa memilih ulang anggota setiap kali.
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
            <button class="mt-4 px-4 py-2 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200">+ Add New Bill</button>
        </div>
    </div>
</div>
@endsection