
@extends('layouts.layout')

@section('title', 'Edit Produk')

@section('content')
<h1>Edit Produk</h1>
<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" required>
    </div>
    
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $product->harga }}" required>
    </div>
    
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" value="{{ $product->deskripsi }}" required>
    </div>
    
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $product->stok }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
