<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Menampilkan form input New Bill
     */
    public function create()
    {
        // Ambil semua user untuk dropdown Customer dan Split Participants
        $users = User::all();

        return view('bill.create', compact('users'));
    }

    /**
     * Menyimpan data bill baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date',
            'bill_type' => 'required|string|max:255',
            'customer_id' => 'required|exists:users,id',
            'bill_number' => 'required|string|unique:bills,bill_number',
            'split_method' => 'required|in:Equal,Custom',
            'notes' => 'nullable|string',

            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string|max:255',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.assigned_to' => 'nullable|exists:users,id',

            'participants' => 'required|array|min:1',
            'participants.*' => 'exists:users,id',
        ]);

        // Simpan bill utama
        $bill = Bill::create([
            'date' => $validated['date'],
            'due_date' => $validated['due_date'],
            'bill_type' => $validated['bill_type'],
            'customer_id' => $validated['customer_id'],
            'bill_number' => $validated['bill_number'],
            'split_method' => $validated['split_method'],
            'notes' => $validated['notes'] ?? null,
        ]);

        // Simpan setiap item
        foreach ($validated['items'] as $itemData) {
            $bill->items()->create([
                'name' => $itemData['name'],
                'qty' => $itemData['qty'],
                'price' => $itemData['price'],
                'assigned_to' => $itemData['assigned_to'] ?? null,
            ]);
        }

        // Hubungkan tagihan ini dengan para peserta
        $bill->participants()->attach($validated['participants']);

        return redirect()->route('bills.index')->with('success', 'Bill berhasil disimpan.');
    }

    /**
     * Menampilkan semua tagihan (optional)
     */
    public function index()
    {
        $bills = Bill::latest()->with(['customer', 'items'])->get();
        return view('bill.index', compact('bills'));
    }

    /**
     * Menampilkan detail satu tagihan (optional)
     */
    public function show($id)
    {
        $bill = Bill::with(['items', 'participants', 'customer'])->findOrFail($id);
        return view('bill.show', compact('bill'));
    }
}