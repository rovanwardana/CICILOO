<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class NotificationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $recentActivities = Transaction::where(function ($query) use ($userId) {
            $query->where('with', $userId)
                ->orWhereHas('bill', function ($query) use ($userId) {
                    $query->whereHas('participants', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    });
                });
        })
            ->with(['bill', 'bill.participants' => function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhere('payment_status', 'Paid');
            }])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $html = '';

        foreach ($recentActivities as $activity) {
            if ($activity->bill && $activity->bill->participants->where('user_id', $userId)->first()?->pivot->payment_status === 'Pending') {
                $name = $activity->bill->participants->where('user_id', $activity->with)->first()->name ?? 'Someone';
                $amount = number_format($activity->bill->participants->where('user_id', $userId)->first()->pivot->amount_to_pay, 2);
                $html .= "<li class='flex justify-between items-center p-2 hover:bg-gray-100 rounded'>
                        <span>💰 You owe {$name}</span>
                        <span class='font-semibold'>Rp {$amount}</span>
                      </li>";
            } elseif ($activity->bill && $activity->bill->participants->where('payment_status', 'Paid')->count() > 0) {
                $name = $activity->bill->participants->where('payment_status', 'Paid')->first()->name ?? 'Someone';
                $amount = number_format($activity->bill->participants->where('payment_status', 'Paid')->first()->pivot->amount_to_pay, 2);
                $html .= "<li class='flex justify-between items-center p-2 hover:bg-gray-100 rounded'>
                        <span>💸 {$name} paid you</span>
                        <span class='font-semibold'>Rp {$amount}</span>
                      </li>";
            } else {
                $html .= "<li class='flex justify-between items-center p-2 hover:bg-gray-100 rounded'>
                        <span>📋 New bill created: <strong>{$activity->transaction_name}</strong></span>
                      </li>";
            }
        }

        return response()->json([
            'html' => $html,
            'count' => $recentActivities->count(),
        ]);
    }
}
