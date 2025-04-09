@extends('layouts.layout')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Riwayat Pesanan</h2>

    @if ($orders->isEmpty())
        <p class="text-center text-muted">Belum ada pesanan.</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->product->nama_produk }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if (auth()->user()->saldo >= $order->total_harga)
                            <form action="{{ route('orders.pay', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                            </form>
                            
                            <a href="{{ route('orders.struk.download', $order->id) }}" class="btn btn-secondary btn-sm mt-1">
                                Download Struk
                            </a>
                            
                            @else
                                <span class="badge bg-danger">Saldo Tidak Cukup</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
