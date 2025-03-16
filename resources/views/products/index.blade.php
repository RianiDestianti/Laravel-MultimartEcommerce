@extends('layouts.layout')

@section('title', 'Daftar Produk')

@section('content')



<div class="container mt-4">
    <h1 class="mb-4 text-center">Daftar Produk</h1>

    <!-- Tombol Tambah Produk -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">+ Tambah Produk</a>
    </div>

    <!-- Tabel Produk -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>{{ $product->nama_produk }}</td>
                    <td>Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>{{ $product->deskripsi }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                    <td>
                        @if ($product->gambar)
                            <img src="{{ Storage::url($product->gambar) }}" width="100" alt="Gambar Produk">
                        @else
                            <p>Tidak ada gambar</p>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Produk tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
