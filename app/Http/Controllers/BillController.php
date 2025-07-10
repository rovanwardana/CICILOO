<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\BillParticipantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{
    /**
     * Menampilkan form input New Bill
     */
    public function create()
    {
        $users = \App\Models\User::all();
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

        $items = [];
        foreach ($validated['items'] as $index => $itemData) {
            $item = $bill->items()->create([
                'name' => $itemData['name'],
                'qty' => $itemData['qty'],
                'price' => $itemData['price'],
                'assigned_to' => $itemData['assigned_to'] ?? null,
            ]);
            $items[$index] = $item;
        }

        $participantIds = array_column($validated['participants'], 'id');
        $bill->participants()->attach($participantIds, [
            'payment_status' => 'Pending',
            'amount_to_pay' => 0,
        ]);

        $participantsCount = count($participantIds);

        if ($validated['split_method'] === 'equal') {
            $amountPerParticipant = $total / $participantsCount;
            foreach ($participantIds as $participantId) {
                $bill->participants()->updateExistingPivot($participantId, [
                    'amount_to_pay' => $amountPerParticipant,
                ]);
            }
        } elseif ($validated['split_method'] === 'custom') {
            $participantTotals = [];

            foreach ($validated['participants'] as $pIndex => $participant) {
                $participantId = $participant['id'];
                $totalForParticipant = 0;

                if (isset($participant['items'])) {
                    foreach ($participant['items'] as $itemIndex => $itemData) {
                        $qty = $itemData['qty'] ?? 0;
                        if (isset($items[$itemIndex])) {
                            $itemTotal = $items[$itemIndex]->price * $qty;

                            $billUser = \App\Models\BillUser::where('bill_id', $bill->id)
                                ->where('user_id', $participantId)->first();

                            BillParticipantItem::create([
                                'bill_user_id' => $billUser->id,
                                'item_id' => $items[$itemIndex]->id,
                                'qty' => $qty,
                            ]);

                            $totalForParticipant += $itemTotal;
                        } else {
                            Log::error("Item not found for index: $itemIndex, pIndex: $pIndex");
                        }
                    }
                }

                $participantTotals[$participantId] = $totalForParticipant;
            }

            foreach ($participantTotals as $participantId => $totalForParticipant) {
                $proporsi = $subtotal > 0 ? ($totalForParticipant / $subtotal) : 0;
                $finalAmount = $totalForParticipant - ($discount * $proporsi) + ($taxAmount * $proporsi);

                $bill->participants()->updateExistingPivot($participantId, [
                    'amount_to_pay' => $finalAmount,
                ]);
            }
        }

        Transaction::create([
            'transaction_name' => $validated['bill_name'],
            'with' => Auth::id(),
            'date' => $validated['date'],
            'status' => 'Pending',
            'bill_id' => $bill->id,
        ]);

        return redirect()->route('transaction.index')->with('success', 'Bill berhasil disimpan.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'bill_user_id' => 'required|exists:bill_user,id',
            'status' => 'required|in:Pending,Paid',
        ]);

        $billUser = \App\Models\BillUser::find($request->bill_user_id);
        $billUser->payment_status = $request->status;
        $billUser->save();

        $bill = $billUser->bill;
        $transaction = Transaction::where('bill_id', $bill->id)->first();

        $statuses = $bill->participants()->pluck('bill_user.payment_status');
        if ($statuses->every(fn($status) => $status === 'Paid')) {
            $transaction->status = 'Completed';
        } elseif ($statuses->contains('Paid')) {
            $transaction->status = 'Partially';
        } else {
            $transaction->status = 'Pending';
        }

        $transaction->save();

        return response()->json(['success' => true]);
    }

    public function updateStatuses(Request $request)
    {
        try {
            $request->validate([
                'transaction_id' => 'required|exists:transactions,id',
                'statuses' => 'required|array',
                'statuses.*' => 'required|in:Pending,Paid',
            ]);

            $transaction = Transaction::findOrFail($request->transaction_id);
            $bill = $transaction->bill;

            foreach ($request->statuses as $billUserId => $status) {
                $billUser = \App\Models\BillUser::findOrFail($billUserId);
                $billUser->payment_status = $status;
                $billUser->save();
            }

            // Update transaction status based on participant statuses
            $statuses = $bill->participants()->pluck('bill_user.payment_status');
            if ($statuses->every(fn($status) => $status === 'Paid')) {
                $transaction->status = 'Completed';
            } elseif ($statuses->contains('Paid')) {
                $transaction->status = 'Partially';
            } else {
                $transaction->status = 'Pending';
            }

            $transaction->save();

            return response()->json(['success' => true, 'message' => 'Statuses updated successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to update statuses: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to update statuses'], 500);
        }
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $bill = $transaction->bill;
        if ($bill) {
            $bill->participants()->detach();
            $bill->items()->delete();
            $bill->delete();
        }
        $transaction->delete();

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $transactions = Transaction::where(function ($query) use ($userId) {
            $query->where('with', $userId)
                ->orWhereHas('bill', function ($query) use ($userId) {
                    $query->whereHas('participants', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    });
                });
        })->with([
            'bill',
            'bill.participants' => function ($query) {
                $query->withPivot('amount_to_pay', 'payment_status');
                Log::info('Loading participants with pivot data');
            },
            'bill.participantItems' => function ($query) {
                $query->with('item');
            },
            'bill.items'
        ])->get();

        return view('transaction.index', compact('transactions'));
    }

    public function show($id)
    {
        $bill = Bill::with(['items', 'participants', 'customer'])->findOrFail($id);
        return view('bill.show', compact('bill'));
    }
}
