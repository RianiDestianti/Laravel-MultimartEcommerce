<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Auth::user()->wishlists()->with('product')->get();
        return view('products.wishlist', compact('wishlists'));
    }

    public function store(Request $request)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);

        return back()->with('success', 'Produk ditambahkan ke wishlist!');
    }

    public function destroy($id)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $id)->delete();
        return back()->with('success', 'Produk dihapus dari wishlist!');
    }
}
