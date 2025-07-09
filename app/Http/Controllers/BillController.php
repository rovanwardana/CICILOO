<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

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
            'bill_name' => 'required|string|max:255',
            'split_method' => 'required|in:equal,custom',
            'notes' => 'nullable|string',
            'tax_percentage' => 'nullable|numeric|min:0|max:100',
            'discount' => 'nullable|numeric|min:0',

            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string|max:255',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.assigned_to' => 'nullable|exists:users,id',

            'participants' => 'required|array|min:1',
            'participants.*.id' => 'required|exists:users,id',
            'participants.*.items' => 'nullable|array',
            'participants.*.items.*.qty' => 'nullable|integer|min:0',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $billNumber = 'BILL-' . strtoupper(Str::random(6));

        $subtotal = array_sum(array_map(fn($item) => $item['qty'] * $item['price'], $validated['items']));
        $discount = $validated['discount'] ?? 0;
        $taxPercentage = $validated['tax_percentage'] ?? 0;
        $taxAmount = ($subtotal - $discount) * ($taxPercentage / 100);
        $total = $subtotal - $discount + $taxAmount;

        $bill = Bill::create([
            'date' => $validated['date'],
            'due_date' => $validated['due_date'],
            'bill_type' => $validated['bill_type'],
            'bill_number' => $billNumber,
            'customer_id' => Auth::id(),
            'split_method' => $validated['split_method'],
            'notes' => $validated['notes'] ?? null,
            'total_amount' => $total,
        ]);

        // Simpan items
        $items = [];
        foreach ($validated['items'] as $itemData) {
            $item = $bill->items()->create([
                'name' => $itemData['name'],
                'qty' => $itemData['qty'],
                'price' => $itemData['price'],
                'assigned_to' => $itemData['assigned_to'] ?? null,
            ]);
            $items[] = $item;
        }

        // Simpan peserta ke bill_user
        $participantIds = array_column($validated['participants'], 'id');
        $bill->participants()->attach($participantIds);

        // Simpan detail item per peserta ke bill_participant_items
        foreach ($validated['participants'] as $index => $participant) {
            $participantId = $participant['id'];
            $billUser = $bill->participants()->where('user_id', $participantId)->first();
            if ($billUser) {
                $billUserId = $billUser->pivot->id; // Menggunakan id dari bill_user
                foreach ($participant['items'] ?? [] as $itemIndex => $itemData) {
                    $qty = $itemData['qty'] ?? 0;
                    if ($qty > 0) {
                        $item = $items[$itemIndex] ?? null; // Mengambil item berdasarkan indeks
                        if ($item) {
                            $item->participants()->attach($participantId, ['qty' => $qty]);
                        } else {
                            \Log::error("Item not found for index: $itemIndex");
                        }
                    }
                }
            } else {
                \Log::error("BillUser not found for participant ID: $participantId");
            }
        }

        $participantNames = User::whereIn('id', $participantIds)->pluck('name')->toArray();
        Transaction::create([
            'transaction_name' => $validated['bill_name'],
            'with' => implode(', ', $participantNames),
            'date' => $validated['date'],
            'status' => 'unpaid',
            'bill_id' => $bill->id,
        ]);

        return redirect()->route('transaction.index')->with('success', 'Bill berhasil disimpan.');
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
