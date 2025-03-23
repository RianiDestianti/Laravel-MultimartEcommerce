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
            // Arahkan ke halaman blokir jika akun masih diblokir
            return response()->view('auth.blocked', [
                'blocked_until' => Carbon::parse($user->blocked_until)->format('d M Y H:i'),
                'message' => 'Akun Anda telah diblokir hingga '
            ]);
        }

        // Jika waktu blokir telah habis, buka blokir otomatis
        if ($user->is_blocked && $user->blocked_until && now()->gte(Carbon::parse($user->blocked_until))) {
            // Reset status blokir
            $user->update(['is_blocked' => false, 'blocked_until' => null]);
        }
    }

    // Jika login berhasil dan akun tidak diblokir
    if (Auth::attempt($credentials)) {
        // Update waktu login terakhir
        Auth::user()->update(['last_login_at' => now()]);
        return redirect()->route('products.index')->with('success', 'Login berhasil!');
    }

    // Jika login gagal, kembalikan dengan error
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
protected function attemptLogin(Request $request)
{
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user) {
        // Cek apakah pengguna diblokir
        if ($user->is_blocked && now()->lessThan($user->blocked_until)) {
            // Jika masih dalam masa blokir, tolak login
            return false;
        }
    }

    return $this->guard()->attempt(
        $this->credentials($request),
        $request->filled('remember')
    );
}


}

