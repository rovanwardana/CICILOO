<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all(); // Ambil semua transaksi dari database
        return view('transaction', compact('transactions'));
    }

    public function store(Request $request)
    {
        Transaction::create([
            'transaction_name' => $request->input('transaction_name'),
            'with' => $request->input('with'),
            'date' => $request->input('date'),
            'status' => $request->input('status', 'Pending'),
        ]);
        return redirect()->route('transaction.index')->with('success', 'Transaction added successfully.');
    }

    public function updateParticipantStatus(Request $request)
    {
        $request->validate([
            'bill_user_id' => 'required|exists:bill_user,id',
            'status' => 'required|in:Pending,Paid',
        ]);

        $billUser = \App\Models\BillUser::find($request->bill_user_id);
        $billUser->payment_status = $request->status;
        $billUser->save();

        // Cek apakah semua peserta sudah Paid → update transaksi
        $bill = $billUser->bill;
        $allPaid = $bill->participants()->wherePivot('payment_status', '!=', 'Paid')->count() === 0;

        if ($allPaid) {
            $transaction = \App\Models\Transaction::where('bill_id', $bill->id)->first();
            $transaction->status = 'Paid';
            $transaction->save();
        }

        return response()->json(['success' => true]);
    }
}
