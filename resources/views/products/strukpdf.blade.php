<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; border: 1px solid #000; }
        h2 { text-align: center; margin-bottom: 30px; }
        p { margin: 6px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Struk Pembayaran</h2>
        <p><strong>Nama:</strong> {{ $transaksi['nama_user'] }}</p>
        <p><strong>Produk:</strong> {{ $transaksi['nama_produk'] }}</p>
        <p><strong>Jumlah:</strong> {{ $transaksi['jumlah'] }}</p>
        <p><strong>Total Bayar:</strong> Rp {{ number_format($transaksi['total_harga'], 0, ',', '.') }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi['tanggal'] }}</p>
    </div>
</body>
</html>
