<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class FriendsController extends Controller
{
    public function index()
    {
        $friends = collect([
            (object)[
                'id' => 1,
                'name' => 'Rovan Wardana',
                'balance' => 100000,
                'last_transaction_date' => Carbon::now()->subDays(2),
            ],
        ]);

        return view('friends', compact('friends'));
    }
}