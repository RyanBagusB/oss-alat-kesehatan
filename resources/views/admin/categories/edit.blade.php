@extends('layouts.admin')

@section('content')
<div class="flex flex-col gap-6 bg-gray-50 min-h-screen">

    {{-- Header --}}
    <div class="flex items-end justify-between">
        <div class="flex flex-col gap-y-1.5">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Edit Kategori
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
                        <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 hover:underline">Kategori</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>

                    <li class="flex items-center text-gray-600" aria-current="page">
                        Edit Kategori
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.categories.index') }}"
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
                Form Edit Kategori
            </h3>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" id="categoryEditForm">
                @csrf
                @method('PUT')

                {{-- Nama Kategori --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        required
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                        placeholder="Masukkan nama kategori"
                    >
                </div>

                {{-- Deskripsi Kategori --}}
                <div class="mt-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                        placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                </div>


                {{-- Tombol Submit --}}
                <div class="mt-6">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-x-2 bg-indigo-600 text-white font-medium py-2 
                               rounded-lg hover:bg-indigo-700 transition">
                        <i class="fa fa-save"></i>
                        Perbarui Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
