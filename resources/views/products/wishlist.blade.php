@extends('layouts.layout')

@section('title', 'Wishlist Produk')

@section('content')
<div class="container mt-5">
    <h2>Wishlist Anda</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wishlists as $wishlist)
            <tr>
                <td>{{ $wishlist->product->nama_produk }}</td>
                <td>Rp {{ number_format($wishlist->product->harga, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('wishlist.destroy', $wishlist->product_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
