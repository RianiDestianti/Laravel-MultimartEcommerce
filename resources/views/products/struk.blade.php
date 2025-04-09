@extends('layouts.layout')

@section('title', 'Struk Pembayaran')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-4">Struk Pembayaran</h3>
        <p><strong>Nama:</strong> {{ $transaksi['nama_user'] }}</p>
        <p><strong>Produk:</strong> {{ $transaksi['nama_produk'] }}</p>
        <p><strong>Jumlah:</strong> {{ $transaksi['jumlah'] }}</p>
        <p><strong>Total Bayar:</strong> Rp {{ number_format($transaksi['total_harga'], 0, ',', '.') }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi['tanggal'] }}</p>

        <div class="text-center mt-4">
            <a href="{{ route('products.riwayat') }}" class="btn btn-success">Kembali ke Riwayat</a>
        </div>
        
    </div>
</div>
@endsection
