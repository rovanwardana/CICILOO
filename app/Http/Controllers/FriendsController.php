<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FriendsController extends Controller
{
    /**
     * Display a listing of the user's friends.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please log in first.');
            }

            $friends = $user->friends()->withPivot('created_at', 'status')->get();

            $friends = $friends->map(function ($friend) use ($user) {
                $balance = 0; // Placeholder, ganti dengan logika transaksi jika ada
                $lastTransactionDate = $friend->pivot->created_at ?? null;

                return (object) [
                    'id' => $friend->id,
                    'name' => $friend->name,
                    'balance' => $balance,
                    'last_transaction_date' => $lastTransactionDate,
                    'status' => $friend->pivot->status ?? 'accepted',
                ];
            });

            $suggestedFriends = $this->getSuggestedFriends();

            return view('friends', compact('friends', 'suggestedFriends'));
        } catch (\Exception $e) {
            Log::error('Error in FriendsController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    /**
     * Add a new friend for the authenticated user.
     */
    public function addFriend(Request $request)
    {
        try {
            $request->validate([
                'friend_id' => 'required|exists:users,id|different:' . Auth::id(),
            ]);

            $user = Auth::user();
            $friendId = $request->input('friend_id');

            $existing = $user->friends()->where('friend_id', $friendId)->first();
            if (!$existing) {
                $user->friends()->attach($friendId, ['created_at' => now(), 'status' => 'pending']);
                return response()->json(['success' => true, 'message' => 'Friend request sent']);
            } elseif ($existing->pivot->status === 'pending') {
                return response()->json(['success' => false, 'message' => 'Friend request already sent'], 400);
            } elseif ($existing->pivot->status === 'accepted') {
                return response()->json(['success' => false, 'message' => 'Already friends'], 400);
            }

            return response()->json(['success' => false, 'message' => 'An error occurred'], 400);
        } catch (\Exception $e) {
            Log::error('Error in FriendsController@addFriend: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.'], 500);
        }
    }

    /**
     * Get suggested friends for the authenticated user.
     */
    protected function getSuggestedFriends()
    {
        try {
            $user = Auth::user();
            $suggested = User::where('id', '!=', $user->id)
                ->whereDoesntHave('friends', function ($query) use ($user) {
                    $query->where(function ($q) use ($user) {
                        $q->where('friend_id', $user->id)
                            ->orWhere('user_id', $user->id);
                    });
                })
                ->limit(5)
                ->get();
            Log::info('Suggested friends:', $suggested->toArray());
            return $suggested;
        } catch (\Exception $e) {
            Log::error('Error in getSuggestedFriends: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Search users for adding as friends.
     */
    public function searchFriends(Request $request)
    {
        try {
            $query = $request->input('q');
            $user = Auth::user();

            $results = User::where('id', '!=', $user->id)
                ->whereDoesntHave('friends', function ($query) use ($user) {
                    $query->where(function ($q) use ($user) {
                        $q->where('friend_id', $user->id)->orWhere('user_id', $user->id);
                    });
                })
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%");
                })
                ->limit(5)
                ->get(['id', 'name']);

            return response()->json(['success' => true, 'data' => $results]);
        } catch (\Exception $e) {
            Log::error('Error in FriendsController@searchFriends: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.'], 500);
        }
    }
}
