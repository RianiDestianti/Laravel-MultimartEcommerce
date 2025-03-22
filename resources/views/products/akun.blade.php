@extends('layouts.layout')

@section('title', 'Akun Saya')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Profil Akun</h2>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali ke Produk</a>
        <a href="{{ route('wishlist.index') }}" class="btn btn-primary">Lihat Wishlist</a>

        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Form Ganti Password -->
    <div class="mt-4">
        <h3>Ganti Password</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('password.update.manual') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Password Lama:</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password Baru:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Konfirmasi Password Baru:</label>
                <input type="password" name="new_password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Ganti Password</button>
        </form>
    </div>
</div>
@endsection
