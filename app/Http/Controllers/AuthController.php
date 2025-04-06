<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
    // Validasi input email dan password
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Cari user berdasarkan email
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // **Cek apakah user ada dan diblokir**
        if ($user->is_blocked && $user->blocked_until && now()->lt(Carbon::parse($user->blocked_until))) {
            return response()->view('auth.blocked', [
                'blocked_until' => Carbon::parse($user->blocked_until)->format('d M Y H:i'),
                'message' => 'Akun Anda telah diblokir hingga '
            ]);
        }

        // Jika waktu blokir telah habis, buka blokir otomatis
        if ($user->is_blocked && $user->blocked_until && now()->gte(Carbon::parse($user->blocked_until))) {
            $user->update(['is_blocked' => false, 'blocked_until' => null]);
        }
    }

    // Jika login berhasil dan akun tidak diblokir
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Simpan data user ke dalam session
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
        ]);

        // Update waktu login terakhir
        $user->update(['last_login_at' => now()]);

        return redirect()->route('products.index')->with('success', 'Login berhasil!');
    }

    return back()->withErrors(['email' => 'Email atau password salah!']);
}

// Menampilkan profil pengguna
public function profile()
{
    if (!session()->has('user_id')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $user = User::find(session('user_id')); 
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

