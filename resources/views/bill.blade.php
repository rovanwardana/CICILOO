@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('title', 'New Bill')

@section('content')
<div class="bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">New Bill</h1>

    <!-- Tabs: Split Bill / Group Bill -->
    <div class="flex space-x-6 border-b mb-6">
        <button class="px-4 py-2 font-medium text-blue-600 border-b-2 border-blue-600">Split Bill</button>
        <button class="px-4 py-2 font-medium text-gray-500 hover:text-blue-600">Group Bill</button>
    </div>

    <!-- Split Bill Section -->
    <form>
        <!-- Form Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" class="mt-1 w-full rounded border-gray-300" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" class="mt-1 w-full rounded border-gray-300" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Bill Type</label>
                <select class="mt-1 w-full rounded border-gray-300">
                    <option>Select bill type</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Customer</label>
                <select class="mt-1 w-full rounded border-gray-300">
                    <option>Select customer</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Bill Number</label>
                <input type="text" placeholder="Enter bill number" class="mt-1 w-full rounded border-gray-300" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Split Method</label>
                <select class="mt-1 w-full rounded border-gray-300">
                    <option>Equal</option>
                    <option>Custom</option>
                </select>
            </div>
        </div>

        <!-- Items Table -->
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Item Name</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Unit Price</th>
                        <th class="px-4 py-2 border">Total</th>
                        <th class="px-4 py-2 border">Assigned To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 border">Enter item name</td>
                        <td class="px-4 py-2 border">0</td>
                        <td class="px-4 py-2 border">Rp. 0</td>
                        <td class="px-4 py-2 border">Rp. 0</td>
                        <td class="px-4 py-2 border">Select Person</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Notes -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea class="w-full rounded border-gray-300" placeholder="Add additional notes here"></textarea>
        </div>

        <!-- Participants & Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="font-semibold mb-2">Split Participants</h2>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-gray-200 px-3 py-1 rounded-full">Person 1 ✕</span>
                    <span class="bg-gray-200 px-3 py-1 rounded-full">Person 2 ✕</span>
                    <button type="button" class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">+ Add Person</button>
                </div>
            </div>
            <div>
                <h2 class="font-semibold mb-2">Split Summary</h2>
                <div class="bg-gray-50 p-4 rounded border">
                    <p>Person 1: Rp. 0</p>
                    <p>Person 2: Rp. 0</p>
                </div>
            </div>
        </div>

        <!-- Bill Summary -->
        <div class="text-right mb-6">
            <p>Subtotal: <strong>Rp. 0</strong></p>
            <p>Discount: <strong>Rp. 0</strong></p>
            <p>Tax 10%: <strong>Rp. 0</strong></p>
            <p class="text-lg font-semibold">Total: Rp. 0</p>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4">
            <button type="button" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save Bill</button>
        </div>
    </form>

    <!-- Group Bill Placeholder Section (Hidden by default, show with tab switch logic) -->
    <div class="hidden" id="group-bill-section">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Group Bill</h2>
        <p class="text-sm text-gray-600 mb-4">
            Group Bill adalah fitur untuk mencatat dan membagi banyak tagihan dalam satu grup tetap, seperti "Grup Liburan Bali", agar lebih mudah mengelola tagihan tanpa memilih ulang anggota setiap kali.
        </p>
        
        <!-- Example Structure -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Select Group</label>
            <select class="mt-1 w-full rounded border-gray-300">
                <option>Pilih grup</option>
                <option>Liburan Bali</option>
                <option>Kos Bareng</option>
            </select>
        </div>

        <!-- Bills List Placeholder -->
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
