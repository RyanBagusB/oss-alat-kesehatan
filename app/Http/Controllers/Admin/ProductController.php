<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', [
            'title' => 'Daftar Produk',
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', [
            'title' => 'Tambah Produk',
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:2048',
        ], [
            'name.required'        => 'Nama produk wajib diisi.',
            'name.string'          => 'Nama produk harus berupa teks.',
            'name.max'             => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'description.string'   => 'Deskripsi harus berupa teks.',
            'stock.required'       => 'Stok produk wajib diisi.',
            'stock.integer'        => 'Stok produk harus berupa angka bulat.',
            'stock.min'            => 'Stok produk tidak boleh bernilai negatif.',
            'price.required'       => 'Harga produk wajib diisi.',
            'price.numeric'        => 'Harga produk harus berupa angka.',
            'price.min'            => 'Harga produk tidak boleh kurang dari 0.',
            'image.image'          => 'File yang diunggah harus berupa gambar.',
            'image.max'            => 'Ukuran gambar maksimal adalah 2 MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'id'          => (string) Str::uuid(),
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'stock'       => $request->stock,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', [
            'title' => 'Edit Produk',
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:2048',
        ], [
            'name.required'        => 'Nama produk wajib diisi.',
            'name.string'          => 'Nama produk harus berupa teks.',
            'name.max'             => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'description.string'   => 'Deskripsi harus berupa teks.',
            'stock.required'       => 'Stok produk wajib diisi.',
            'stock.integer'        => 'Stok produk harus berupa angka bulat.',
            'stock.min'            => 'Stok produk tidak boleh bernilai negatif.',
            'price.required'       => 'Harga produk wajib diisi.',
            'price.numeric'        => 'Harga produk harus berupa angka.',
            'price.min'            => 'Harga produk tidak boleh kurang dari 0.',
            'image.image'          => 'File yang diunggah harus berupa gambar.',
            'image.max'            => 'Ukuran gambar maksimal adalah 2 MB.',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'stock'       => $request->stock,
            'price'       => $request->price,
            'image'       => $product->image,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
