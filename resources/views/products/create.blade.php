@extends('layouts.layout')

@section('title', 'Tambah Produk')

@section('content')
<h1>Tambah Produk</h1>
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah</button>
</form>

@endsection
