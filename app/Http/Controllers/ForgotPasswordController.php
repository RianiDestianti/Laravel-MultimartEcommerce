<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ForgotPasswordController extends Controller
{
    public function formLupaPassword()
    {
        return view('auth.lupapassword');
    }

    public function cekEmail(Request $request)
    {
        // Validasi input email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan. Silakan coba lagi.');
        }

        // Menampilkan password yang terdaftar di database
        return view('auth.showpassword', ['password' => $user->password]);
    }
}
