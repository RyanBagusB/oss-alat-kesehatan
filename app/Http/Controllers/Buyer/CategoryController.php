<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $categories = Category::all();
        $products = $category->products()->latest()->paginate(12);

        return view('buyer.categories.show', compact('category', 'categories', 'products'));
    }
}
