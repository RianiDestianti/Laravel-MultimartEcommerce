@extends('layouts.layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mt-5">
    <!-- Page Header with Gradient Underline -->
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
                                @if ($product->gambar)
                                    <img src="{{ Storage::url($product->gambar) }}" class="img-thumbnail" width="80" alt="Gambar Produk">
                                @else
                                    <span class="badge bg-secondary">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="align-middle">
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
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
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