<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- ini penting!


class SaldoController extends Controller
{
    public function form()
    {
        return view('saldo.form');
    }

    public function isi(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1000',
        ]);

        $user = Auth::user();
        $user->saldo += $request->nominal;
        $user->save();

        return redirect()->back()->with('success', 'Saldo berhasil ditambahkan!');
    }
}
