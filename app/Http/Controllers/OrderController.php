<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


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

public function pay(Request $request, Order $order)
{
    $request->validate([
        'nominal_bayar' => 'required|numeric|min:1',
    ]);

    if ($request->nominal_bayar > $order->total_harga) {
        return redirect()->back()->with('error', 'Kamu kelebihan membayar!');
    } elseif ($request->nominal_bayar < $order->total_harga) {
        return redirect()->back()->with('error', 'Nominal kurang dari total harga!');
    }

    $order->update([
        'nominal_bayar' => $request->nominal_bayar,
        'status' => 'paid',
    ]);

    return redirect()->route('products.riwayat')->with('success', 'Pembayaran berhasil!');
}


}
