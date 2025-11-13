<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(12);

        $categories = Category::all();

        return view('buyer.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('buyer.products.show', compact('product'));
    }
}
