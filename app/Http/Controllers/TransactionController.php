<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}