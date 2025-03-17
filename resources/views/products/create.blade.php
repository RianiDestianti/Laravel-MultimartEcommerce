@extends('layouts.layout')

@section('title', 'Tambah Produk')

@section('content')
<h1>Tambah Produk</h1>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
        <textarea name="deskripsi" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar Produk</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
    <label for="kategori" class="form-label">Kategori</label>
    <select name="kategori_id" id="kategori" class="form-control">

        <option value="">Pilih Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
        @endforeach
        <option value="new">Tambahkan Kategori Baru</option>
    </select>
</div>

<div class="mb-3" id="kategori_baru" style="display: none;">
    <label for="kategori_baru_input" class="form-label">Nama Kategori Baru</label>
    <input type="text" name="kategori_baru" id="kategori_baru_input" class="form-control">
</div>

<script>
    document.getElementById('kategori').addEventListener('change', function () {
        if (this.value === 'new') {
            document.getElementById('kategori_baru').style.display = 'block';
        } else {
            document.getElementById('kategori_baru').style.display = 'none';
        }
    });
</script>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection
