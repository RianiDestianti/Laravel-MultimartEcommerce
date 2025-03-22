<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Cek apakah password lama benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama salah!');
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
