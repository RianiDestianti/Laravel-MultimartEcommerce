@extends('layouts.layout')

@section('title', 'Edit Produk')

@section('content')
<h1>Edit Produk</h1>
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
        <textarea name="deskripsi" class="form-control" rows="3" required>{{ $product->deskripsi }}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $product->stok }}" required>
    </div>

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" class="form-control">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->kategori_id == $category->id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar Produk</label>
        <input type="file" name="gambar" class="form-control">
        @if($product->gambar)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk" width="150">
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
