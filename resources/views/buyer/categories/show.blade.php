@extends('layouts.buyer')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    {{-- Kategori --}}
    <div class="flex gap-2 border-b border-gray-200 flex-wrap">
        <a href="{{ route('buyer.products.index') }}" 
           class="px-2 py-4 {{ request()->routeIs('buyer.products.index') ? 'text-indigo-700 font-semibold' : 'text-gray-600 hover:text-indigo-600' }} transition">
            Semua Produk
        </a>

        @foreach($categories as $cat)
            <a href="{{ route('buyer.categories.show', $cat->id) }}"
               class="px-2 py-4 {{ isset($category) && $category->id === $cat->id ? 'text-indigo-700 font-semibold' : 'text-gray-600 hover:text-indigo-600' }} transition">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    {{-- Header Toko --}}
    <div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800">
            {{ $category->name }}
        </h1>
        <p class="mt-2 text-gray-600 max-w-2xl">
            {{ $category->description ?? 'Tidak ada deskripsi untuk kategori ini.' }}
        </p>
    </div>

    {{-- Daftar Produk --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="group flex flex-col p-5 rounded-2xl border border-gray-100 
                        bg-gradient-to-br from-gray-50 to-white shadow-sm hover:shadow-lg 
                        hover:-translate-y-1 transition-all duration-300">

                {{-- Gambar Produk --}}
                <a href="{{ route('buyer.products.show', $product->id) }}" class="block">
                    <div class="relative h-56 rounded-xl overflow-hidden flex items-center justify-center">
                        @if($product->image)
                            <img 
                                src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->name }}" 
                                class="object-cover h-full w-full transform group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            <span class="text-gray-400 text-sm">No Image</span>
                        @endif
                    </div>
                </a>

                {{-- Info Produk --}}
                <div class="my-4 space-y-2">
                    <h2 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors duration-200">
                        {{ $product->name }}
                    </h2>

                    <p class="text-sm text-gray-600 line-clamp-2">
                        {{ Str::limit($product->description, 60, '...') }}
                    </p>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-auto flex flex-col">
                    <div class="flex items-center justify-between my-3">
                        <p class="text-indigo-600 font-bold text-lg">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <span class="text-sm text-gray-500">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>

                    <div class="flex gap-3">
                        {{-- Tombol View --}}
                        <a href="{{ route('buyer.products.show', $product->id) }}" 
                           class="flex items-center justify-center gap-2 w-full px-4 py-2.5 
                                  text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg 
                                  hover:bg-indigo-100 transition">
                            <i class="fa-solid fa-eye"></i>
                            Detail
                        </a>

                        {{-- Tombol Add to Cart --}}
                        <form action="#" method="POST" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center justify-center gap-2 w-full px-4 py-2.5 
                                           text-sm font-medium text-white bg-indigo-600 rounded-lg 
                                           hover:bg-indigo-700 transition">
                                <i class="fa-solid fa-cart-plus"></i>
                                Tambah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">
                Belum ada produk tersedia di kategori ini.
            </p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection
