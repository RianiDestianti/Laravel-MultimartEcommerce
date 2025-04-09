@extends('layouts.layout')

@section('title', 'Daftar Produk')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

<div class="container mt-5">
    <!-- Page Header -->
    <div class="page-header text-center mb-4">
        <h2>Daftar Produk</h2>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <h2>🔥 Rekomendasi untuk Kamu</h2>
<div class="row">
    @foreach ($recommendedProducts as $product)
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama_produk }}</h5>
                    <p class="card-text">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('products.riwayat', $product->id) }}" class="btn btn-primary">Lihat Produk</a>
                </div>
            </div>
        </div>
    @endforeach
</div>


    <!-- Tombol Tambah Produk -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Tambah Produk
        </a>
    </div>


    <!-- Tabel Produk -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #3a1c71, #d76d77); color: white;">
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td class="align-middle">{{ $product->nama_produk }}</td>
                            <td class="align-middle product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="align-middle">{{ Str::limit($product->deskripsi, 50) }}</td>
                            <td class="align-middle">{{ $product->stok }}</td>
                            <td class="align-middle">
    {{ $product->category ? $product->category->nama_kategori : '-' }}
</td>

                            <td class="align-middle">
                                @if ($product->gambar)
                                    <img src="{{ asset('storage/uploads/' . $product->gambar)  }}" class="img-thumbnail" width="80" >
                                @else
                                    <span class="badge bg-secondary">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('wishlist.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-heart"></i> Wishlist
                                    </button>
                                </form>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning mb-1">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                                <form action="{{ route('orders.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="number" name="jumlah" value="1" min="1" class="form-control mb-2">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-shopping-cart"></i> Beli Sekarang
                                    </button>
                                </form>
                                <form action="{{ route('orders.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="number" name="jumlah" value="1" min="1" class="form-control mb-2">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-eye"></i> LIhat Produk
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-box-open fa-3x mb-3 text-muted"></i>
                                <p class="text-muted">Belum ada produk tersedia</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
