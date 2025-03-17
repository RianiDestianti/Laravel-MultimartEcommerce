<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function reply(Request $request)
    {
        $userMessage = strtolower($request->input('message'));

        if (str_contains($userMessage, 'stok')) {
            return $this->checkStock($userMessage);
        } elseif (str_contains($userMessage, 'harga')) {
            return $this->checkPrice($userMessage);
        }

        return response()->json(['reply' => 'Maaf, saya tidak mengerti pertanyaan Anda.']);
    }

    private function checkStock($message)
{
    $productName = preg_replace('/(stok|berapa|\?)/', '', $message);
    $productName = trim($productName);

    Log::info("Mencari stok untuk: '" . $productName . "'");

    $product = Product::where('nama_produk', 'LIKE', "%$productName%")->first();

    if ($product) {
        Log::info("Produk ditemukan: " . json_encode($product));
        return response()->json(['reply' => "Stok {$product->nama_produk} tersisa {$product->stok}"]);
    }

    Log::error("Produk tidak ditemukan: '" . $productName . "'");
    return response()->json(['reply' => 'Produk tidak ditemukan.']);
}

private function checkPrice($message)
{
    $productName = preg_replace('/(harga|berapa|\?)/', '', $message);
    $productName = trim($productName);

    Log::info("Mencari harga untuk: '" . $productName . "'");

    $product = Product::where('nama_produk', 'LIKE', "%$productName%")->first();

    if ($product) {
        Log::info("Produk ditemukan: " . json_encode($product));
        return response()->json(['reply' => "Harga {$product->nama_produk} adalah Rp " . number_format($product->harga, 0, ',', '.')]);
    }

    Log::error("Produk tidak ditemukan: '" . $productName . "'");
    return response()->json(['reply' => 'Produk tidak ditemukan.']);
}

}
