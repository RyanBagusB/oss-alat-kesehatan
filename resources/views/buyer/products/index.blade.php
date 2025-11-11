@extends('layouts.app')

@section('body')
@php
    use App\Models\Category;
    use App\Models\Product;

    $categories = Category::all();
    $products = Product::latest()->take(8)->get();
@endphp

<div class="bg-gray-50 min-h-screen">

    {{-- Hero Section --}}
    <div class="relative">
        <img src="{{ asset('images/hero.jpg') }}" alt="Hero" class="w-full h-[600px] object-cover">

        <div class="absolute inset-0 bg-black bg-opacity-25 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800">
                    Find Your Perfect Product with Confidence
                </h1>
                <p class="mt-4 text-gray-500 max-w-xl mx-auto">
                    Discover the best health tools and medical equipment. Trusted quality, clear details, no surprises.
                </p>
                <a href="#categories" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded">
                    Explore Categories
                </a>
            </div>

            {{-- Search Form --}}
            <div class="absolute top-1/2 right-10 transform -translate-y-1/2 bg-white shadow-xl rounded-lg p-6 w-80">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Find Products</h2>
                <form action="#" method="GET" class="space-y-4">
                    <div>
                        <select name="category" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="text" name="keyword" placeholder="Search products" class="w-full border border-gray-300 rounded px-3 py-2 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded">Search</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Categories Section --}}
    <section id="categories" class="py-16 text-center">
        <h2 class="text-indigo-600 font-semibold mb-2">Categories</h2>
        <h3 class="text-3xl font-bold text-gray-800 mb-6">Browse Products by Category</h3>

        <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-6 max-w-6xl mx-auto">
            @foreach($categories as $category)
                <a href="#" class="bg-white shadow-xl rounded-lg p-6 hover:shadow-2xl transition duration-200 flex flex-col items-center">
                    <div class="text-indigo-600 text-4xl mb-3">📦</div> {{-- Bisa diganti dengan icon kategori --}}
                    <h4 class="text-gray-800 font-semibold text-lg mb-1">{{ $category->name }}</h4>
                    <p class="text-gray-500 text-sm hover:text-indigo-600 hover:underline">View products</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Featured Products Section --}}
    <section id="products" class="py-16 text-center bg-gray-50">
        <h2 class="text-indigo-600 font-semibold mb-2">Featured Products</h2>
        <h3 class="text-3xl font-bold text-gray-800 mb-6">Latest Health Tools & Equipment</h3>

        <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-6 max-w-6xl mx-auto">
            @foreach($products as $product)
                <div class="bg-white shadow-xl rounded-lg p-4 hover:shadow-2xl transition duration-200 flex flex-col">
                    <img src="{{ $product->image ?? asset('images/placeholder.png') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded mb-4">
                    <h4 class="text-gray-800 font-semibold text-lg">{{ $product->name }}</h4>
                    <p class="text-gray-500 text-sm mb-2">{{ Str::limit($product->description, 50) }}</p>
                    <p class="text-gray-800 font-semibold mb-2">${{ number_format($product->price, 2) }}</p>
                    <a href="#" class="mt-auto inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                        View Details
                    </a>
                </div>
            @endforeach
        </div>
    </section>

</div>
@endsection
