<?php

namespace App\Http\Controllers;
use session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    // Tampilkan halaman register


    
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    // Proses login
// Proses login
// Proses login


public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user) {
        // Cek apakah user sedang diblokir
        if ($user->is_blocked && $user->blocked_until) {
            $blockedUntil = Carbon::parse($user->blocked_until);
            if (now()->lt($blockedUntil)) {
                return response()->view('auth.blocked', [
                    'blocked_until' => $blockedUntil->format('d M Y H:i'),
                    'message' => 'Akun Anda telah diblokir hingga ',
                ]);
            } else {
                // Blokiran selesai, unblok otomatis
                $user->update(['is_blocked' => false, 'blocked_until' => null]);
            }
        }
    }

    // Baru cek login setelah lolos blokir
    if (Auth::attempt($credentials, $request->has('remember'))) {
        $request->session()->regenerate();
        return redirect()->route('products.index');
    }

    return back()->withErrors(['email' => 'Email atau password salah!']);
}



// Menampilkan profil pengguna
public function profile()
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    return view('products.akun', compact('user'));
}


// Logout
public function logout()
{
    // Hapus semua session
    session()->flush();
    
    // Logout user dari sistem
    Auth::logout();

    return redirect()->route('login')->with('success', 'Logout berhasil!');
}


}

