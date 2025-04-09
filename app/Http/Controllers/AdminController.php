<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon; // ✅ Impor Carbon dengan benar

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function blockUserPage()
    {
        $users = User::all();
        return view('admin.block_user', compact('users'));
    }

    // ✅ Fungsi untuk blokir/buka blokir pengguna
    public function toggleBlock(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        if ($user->is_blocked) {
            // Buka blokir
            $user->is_blocked = false;
            $user->blocked_until = null;
        } else {
            // Blokir pengguna
            $days = intval($request->input('blocked_until')); // ✅ Pastikan input berupa angka
            $user->is_blocked = true;
            $user->blocked_until = $days > 0 ? Carbon::now()->addDays($days) : null;
        }
    
        $user->save();
        return redirect()->back()->with('success', 'Status pengguna berhasil diperbarui.');
    }

    public function delete_user()
{
    $users = User::all(); // Ambil semua pengguna
    return view('admin.delete_user', compact('users')); // Tampilkan view dengan daftar pengguna
}

public function delete_user_action($id)
{
    $user = User::findOrFail($id); // Cari pengguna berdasarkan ID
    $user->delete(); // Hapus pengguna

    return redirect()->route('admin.delete_user')->with('success', 'Pengguna berhasil dihapus.');
}

}
