<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && $user->is_blocked) {
            if ($user->blocked_until && now()->lt($user->blocked_until)) {
                return back()->withErrors(['email' => 'Akun Anda diblokir hingga ' . $user->blocked_until]);
            } else {
                // Jika waktu blokir telah habis, buka blokir otomatis
                $user->update(['is_blocked' => false, 'blocked_until' => null]);
            }
        }
    
        if (Auth::attempt($credentials)) {
            Auth::user()->update(['last_login_at' => now()]);
            return redirect()->route('products.index')->with('success', 'Login berhasil!');
        }
    
        return back()->withErrors(['email' => 'Email atau password salah!']);
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

public function profile()
{
    $user = Auth::user(); // Ambil data user yang sedang login
    return view('products.akun', compact('user'));
}


}

