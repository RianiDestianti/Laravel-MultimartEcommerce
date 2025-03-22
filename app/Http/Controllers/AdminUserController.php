<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Blokir atau buka blokir akun
    public function toggleBlock($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Status akun berhasil diubah.');
    }

    // Lihat riwayat aktivitas user
    public function activityLog($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::where('user_id', $id)->get();
        $wishlist = Wishlist::where('user_id', $id)->get();
        return view('admin.users.activity', compact('user', 'orders', 'wishlist'));
    }
}
