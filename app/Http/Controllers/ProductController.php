<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
    
        $products = Product::when($search, function ($query, $search) {
            return $query->where('nama_produk', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%");
        })->get();
    
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
        ]);
        
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required',
        'harga' => 'required|numeric',
        'deskripsi' => 'required',
        'stok' => 'required|integer',
    ]);

    $product = Product::findOrFail($id);
    $product->update($request->all());

    return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan!');
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
}

}
