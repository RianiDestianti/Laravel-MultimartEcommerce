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
                        {{-- <th>Status</th>
                        <th>Tanggal</th> --}}
                    </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
<tr>
    <td>{{ $order->product->nama_produk }}</td>
    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
    <td>
        @if ($order->status == 'pending')
            <form action="{{ route('orders.pay', $order->id) }}" method="POST">
                @csrf
                <input type="number" name="nominal_bayar" class="form-control" min="1" required>
                <button type="submit" class="btn btn-primary btn-sm mt-2">Bayar</button>
            </form>
        @else
            <span class="badge bg-success">Sudah Dibayar</span>
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
