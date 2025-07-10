<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Menyimpan perubahan profil pengguna
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'country_code' => 'nullable|string|max:5',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data pengguna
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['country_code'] . ($validated['phone'] ? $validated['phone'] : '');

        // Proses unggah foto profil jika ada
        if ($request->hasFile('profile_picture')) {
            // Hapus foto profil lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            // Simpan foto profil baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}