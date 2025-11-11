@extends('layouts.admin')

@section('content')
<div class="flex flex-col gap-6 bg-gray-50 min-h-screen">

    {{-- Header --}}
    <div class="flex items-end justify-between">
        <div class="flex flex-col gap-y-1.5">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Edit Produk
            </h2>

            {{-- Breadcrumbs --}}
            <nav class="text-sm sm:text-base text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center flex-wrap">
                    <li class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:underline">Beranda</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>

                    <li class="flex items-center">
                        <a href="{{ route('admin.products.index') }}" class="text-indigo-600 hover:underline">Produk</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>

                    <li class="flex items-center text-gray-600" aria-current="page">
                        Edit Produk
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.products.index') }}"
           class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 
                  text-white font-medium px-4 py-1.5 rounded-lg border-2 border-transparent 
                  transition-colors duration-200 focus:outline-none 
                  focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500">
            <i class="fa fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa fa-edit text-indigo-600"></i>
                Form Edit Produk
            </h3>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" id="productForm">
                @csrf
                @method('PUT')

                {{-- Nama Produk --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        required
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                        placeholder="Masukkan nama produk"
                    >
                </div>

                {{-- Stok --}}
                <div class="mt-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        min="0"
                        value="{{ old('stock', $product->stock) }}"
                        required
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                        placeholder="Masukkan jumlah stok produk"
                    >
                </div>

                {{-- Harga --}}
                <div class="mt-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input
                        id="price"
                        type="number"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        required
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                        placeholder="Contoh: 150000"
                    >
                </div>

                {{-- Kategori --}}
                <div class="mt-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select
                        id="category_id"
                        name="category_id"
                        required
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                    >
                        <option value="" disabled>Pilih kategori produk</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Gambar Produk --}}
                <div class="mt-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>

                    @if ($product->image)
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-20 h-20 overflow-hidden rounded-lg bg-gray-100">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                            <p class="text-sm text-gray-600 truncate">{{ basename($product->image) }}</p>
                        </div>
                    @endif

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="mt-1 w-full text-sm text-gray-700 file:mr-3 file:py-2.5 file:px-4 
                               file:rounded-lg file:border-0 file:text-sm file:font-medium
                               file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer"
                    >
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar. Maks 2MB.</p>
                </div>

                {{-- Deskripsi --}}
                <div class="mt-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                        placeholder="Tuliskan deskripsi produk...">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Tombol Simpan --}}
                <div class="mt-6">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-x-2 bg-indigo-600 text-white font-medium py-2 
                               rounded-lg hover:bg-indigo-700 transition">
                        <i class="fa fa-save"></i>
                        Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
