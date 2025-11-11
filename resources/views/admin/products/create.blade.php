@extends('layouts.admin')

@section('content')
<div class="flex flex-col gap-6 bg-gray-50 min-h-screen">

    {{-- Header --}}
    <div class="flex items-end justify-between">
        <div class="flex flex-col gap-y-1.5">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Tambah Produk
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
                        Tambah Produk
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
                <i class="fa fa-plus-circle text-indigo-600"></i>
                Form Tambah Produk
            </h3>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="productForm">
                @csrf

                {{-- Nama Produk --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
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
                        <option value="" disabled selected>Pilih kategori produk</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Upload Gambar Produk --}}
                <div class="mt-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                    <div id="uploadArea"
                        class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 
                               text-center cursor-pointer hover:bg-gray-50 transition">
                        <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium text-indigo-600">Klik untuk pilih</span> atau seret ke sini
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Maks. 2MB)</p>
                        <input type="file" id="image" name="image" accept="image/*" class="hidden">
                    </div>

                    {{-- Preview --}}
                    <div id="previewContainer" class="hidden border border-gray-200 rounded-lg p-4 mt-3">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-md overflow-hidden bg-gray-100 flex-shrink-0">
                                <img id="previewImage" src="" alt="Preview" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p id="fileName" class="text-sm font-medium text-gray-900 truncate"></p>
                                <p class="text-xs text-gray-500">Upload selesai</p>
                            </div>
                            <button type="button" id="removeImage" class="text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4
                                          a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2">
                            <button type="button" id="changeImage" class="text-xs text-indigo-600 hover:underline">
                                Ganti gambar
                            </button>
                        </div>
                    </div>
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
                        placeholder="Tuliskan deskripsi produk..."></textarea>
                </div>

                {{-- Tombol Submit --}}
                <div class="mt-6">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-x-2 bg-indigo-600 text-white font-medium py-2 
                               rounded-lg hover:bg-indigo-700 transition">
                        <i class="fa fa-save"></i>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Notifikasi --}}
<div id="warnModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/25 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md" id="modalBox">
        <div class="flex items-start space-x-4 text-start">
            <div class="rounded-full flex items-center justify-center bg-red-100 text-red-500 p-2">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z">
                    </path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Kesalahan Upload</h2>
                <p id="errorText" class="text-sm text-gray-600 mb-4"></p>
                <div class="flex justify-end">
                    <button type="button"
                        class="border border-gray-200 text-gray-800 bg-white hover:bg-gray-100 px-3 py-1.5 rounded-md"
                        id="closeModal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('image');
    const uploadArea = document.getElementById('uploadArea');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const fileName = document.getElementById('fileName');
    const removeImage = document.getElementById('removeImage');
    const changeImage = document.getElementById('changeImage');
    const warnModal = document.getElementById('warnModal');
    const errorText = document.getElementById('errorText');
    const closeModal = document.getElementById('closeModal');

    uploadArea.addEventListener('click', () => fileInput.click());
    uploadArea.addEventListener('dragover', e => {
        e.preventDefault();
        uploadArea.classList.add('bg-gray-100');
    });
    uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('bg-gray-100'));
    uploadArea.addEventListener('drop', e => {
        e.preventDefault();
        uploadArea.classList.remove('bg-gray-100');
        handleFile(e.dataTransfer.files[0]);
    });
    fileInput.addEventListener('change', e => handleFile(e.target.files[0]));

    function handleFile(file) {
        if (!file) return;
        if (!file.type.startsWith('image/')) return showError('File harus berupa gambar.');
        if (file.size > 2 * 1024 * 1024) return showError('Ukuran file maksimal 2MB.');

        previewImage.src = URL.createObjectURL(file);
        fileName.textContent = file.name;
        previewContainer.classList.remove('hidden');
        uploadArea.classList.add('hidden');
    }

    function showError(message) {
        errorText.textContent = message;
        warnModal.classList.remove('hidden');
    }

    closeModal.addEventListener('click', () => warnModal.classList.add('hidden'));
    removeImage.addEventListener('click', () => {
        fileInput.value = '';
        previewContainer.classList.add('hidden');
        uploadArea.classList.remove('hidden');
    });
    changeImage.addEventListener('click', () => fileInput.click());
});
</script>
@endsection
