<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Contoh fungsi untuk menampilkan daftar pengguna.
     */
    public function users()
    {
        $users = \App\Models\User::all();
        return view('admin.users', compact('users'));
    }
}
