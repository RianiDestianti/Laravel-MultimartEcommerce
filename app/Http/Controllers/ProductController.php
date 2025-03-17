<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_produk', 'like', "%$search%");
        }

        $products = $query->paginate(5)->appends(['search' => $request->search]);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'deskripsi' => 'required|string',
        'stok' => 'required|integer',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'kategori_id' => 'nullable|exists:categories,id',
        'kategori_baru' => 'nullable|string|max:255'
    ]);

    // Cek jika user memilih kategori baru
    if ($request->kategori_baru) {
        $kategori = Category::create(['nama_kategori' => $request->kategori_baru]);
        $kategori_id = $kategori->id;
    } else {
        $kategori_id = $request->kategori_id;
    }

    // Simpan gambar jika ada
    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('public/gambar_produk');
    }

    // Simpan produk
    Product::create([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
        'stok' => $request->stok,
        'gambar' => $gambarPath,
        'kategori_id' => $kategori_id,
    ]);

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori' => 'nullable|exists:categories,id',
            'kategori_baru' => 'nullable|string|unique:categories,nama_kategori'
        ]);

        $product = Product::findOrFail($id);

        // Cek jika ada kategori baru
        if ($request->kategori === 'new' && $request->kategori_baru) {
            $kategori = Category::create(['nama_kategori' => $request->kategori_baru]);
            $kategori_id = $kategori->id;
        } else {
            $kategori_id = $request->kategori;
        }

        // Jika ada gambar baru, simpan dan hapus yang lama
        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                \Storage::disk('public')->delete($product->gambar);
            }
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
            $product->gambar = $gambarPath;
        }

        // Update produk
        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'category_id' => $kategori_id,
        ]);

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

        if ($product->gambar) {
            \Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}