<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Bill;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Menghitung "You are owed" (jumlah yang harus diterima)
        $youAreOwed = Bill::where('customer_id', $userId)
            ->whereHas('participants', function ($query) {
                $query->where('payment_status', 'Pending');
            })
            ->with(['participants' => function ($query) {
                $query->where('payment_status', 'Pending');
            }])
            ->get()
            ->sum(function ($bill) {
                return $bill->participants->sum('pivot.amount_to_pay');
            });

        // Menghitung "You owe" (jumlah yang harus dibayar)
        $youOwe = Bill::whereHas('participants', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('payment_status', 'Pending');
        })
            ->with(['participants' => function ($query) use ($userId) {
                $query->where('user_id', $userId)->where('payment_status', 'Pending');
            }])
            ->get()
            ->sum(function ($bill) {
                return $bill->participants->where('id', Auth::id())->sum('pivot.amount_to_pay');
            });

        // Mengambil aktivitas terbaru
        $recentActivities = Transaction::where(function ($query) use ($userId) {
            $query->where('with', $userId)
                ->orWhereHas('bill', function ($query) use ($userId) {
                    $query->whereHas('participants', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    });
                });
        })
            ->with(['bill', 'bill.participants' => function ($query) use ($userId) {
                $query->where('user_id', $userId)->orWhere('payment_status', 'Paid');
            }])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data untuk grafik
        $latestBill = Bill::where('customer_id', $userId)
            ->orWhereHas('participants', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->first();

        $chartData = [
            'labels' => [],
            'amounts' => [],
            'colors' => [],
        ];

        if ($latestBill) {
            $participants = $latestBill->participants;
            foreach ($participants as $participant) {
                $chartData['labels'][] = $participant->name;
                $chartData['amounts'][] = $participant->pivot->amount_to_pay;
                $chartData['colors'][] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Warna acak
            }
        }

        return view('dashboard', compact('youAreOwed', 'youOwe', 'recentActivities', 'chartData'));
    }
}
