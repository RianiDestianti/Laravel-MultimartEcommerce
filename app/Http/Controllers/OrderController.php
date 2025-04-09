<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use PDF; // Tambahkan di atas (jika belum ada)

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('product')->get();
        return view('products.riwayat', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $total_harga = $product->harga * $request->jumlah;

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'status' => 'pending',
        ]);

        return redirect()->route('products.riwayat')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function riwayat()
    {
        $orders = Auth::user()->orders()->with('product')->get();
        return view('products.riwayat', compact('orders'));
    }

    public function pay(Request $request, $id)
{
    $request->validate([
        'nominal_bayar' => 'nullable|numeric|min:1', // bisa nullable karena kamu tidak pakai input nominal
    ]);

    $order = Order::findOrFail($id); // ambil order manual
    $user = Auth::user();

    if ($user->saldo < $order->total_harga) {
        return redirect()->back()->with('error', 'Saldo Anda tidak cukup untuk membayar pesanan ini!');
    }

    // Kurangi saldo
    $user->saldo -= $order->total_harga;
    $user->save();

    // Hapus order setelah dibayar
    $transaksi = [
        'nama_produk' => $order->product->nama_produk,
        'jumlah' => $order->jumlah,
        'total_harga' => $order->total_harga,
        'nama_user' => $user->name,
        'tanggal' => now()->format('d M Y H:i'),
    ];
    
    // Hapus order setelah dibayar
    $order->delete();
    
    // Tampilkan halaman struk pembayaran
    return view('products.struk', compact('transaksi'));
}


public function downloadStruk(Order $order)
{
    $user = Auth::user();

    if ($order->user_id !== $user->id) {
        abort(403); // Biar nggak bisa download struk orang lain
    }

    $transaksi = [
        'nama_produk' => $order->product->nama_produk,
        'jumlah' => $order->jumlah,
        'total_harga' => $order->total_harga,
        'nama_user' => $user->name,
        'tanggal' => now()->format('d M Y H:i'),
    ];

    $pdf = PDF::loadView('products.strukpdf', compact('transaksi'));
    return $pdf->download('struk_pembayaran_' . $order->id . '.pdf');
}

}
