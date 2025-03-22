@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h3>Halo, Admin!</h3>
    <p>Silakan kelola produk dan pengguna di bawah ini.</p>

    <h4>Manajemen Produk</h4>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
    <a href="{{ route('products.index') }}" class="btn btn-warning">Edit Produk</a>
    <a href="{{ route('products.index') }}" class="btn btn-danger">Hapus Produk</a>

    <h4>Manajemen Pengguna</h4>
    <a href="{{ route('admin.users.index') }}" class="btn btn-info">Lihat Pengguna</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Blokir Pengguna</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Hapus Pengguna</a>

    <h4>Keluar</h4>
    <button class="btn btn-danger" onclick="logout()">Logout</button>
</div>

<script>
    function logout() {
        alert('Anda telah logout');
        window.location.href = "{{ route('login') }}";
    }
</script>
@endsection
