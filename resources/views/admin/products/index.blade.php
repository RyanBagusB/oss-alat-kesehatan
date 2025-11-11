@extends('layouts.admin')

@section('content')
<div class="flex flex-col gap-6 bg-gray-50 min-h-screen">

    {{-- Header --}}
    <div class="flex items-end justify-between">
        <div class="flex flex-col gap-y-1.5">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Produk
            </h2>

            {{-- Breadcrumbs --}}
            <nav class="text-sm sm:text-base text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center flex-wrap">
                    <li class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:underline text-indigo-600">Beranda</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li class="flex items-center text-gray-600 capitalize" aria-current="page">
                        Produk
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Button Add Product --}}
        <a href="{{ route('admin.products.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 
                text-white font-medium px-4 py-1 rounded-lg border-2 border-transparent 
                transition-colors duration-200 focus:outline-none 
                focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500">
            <i class="fa fa-plus"></i>
            Tambah Produk
        </a>
    </div>

    {{-- Card / Table Container --}}
    <div class="bg-white rounded-2xl overflow-hidden">

        {{-- Card Header --}}
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa fa-box text-indigo-600"></i>
                Daftar Produk
            </h3>
        </div>

        {{-- Card Body / Table --}}
        <div class="p-4 overflow-x-auto">
            <table class="min-w-full text-sm sm:text-base">
                <thead class="bg-gray-50 text-gray-600 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Foto</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Produk</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Kategori</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Harga</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Stok</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Deskripsi</th>
                        <th class="px-4 py-3 text-center font-bold tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-800">
                    @forelse ($products as $product)
                        <tr class="transition-colors hover:bg-indigo-50/50">
                            {{-- Foto --}}
                            <td class="px-4 py-3">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-20 h-20 rounded-lg border border-gray-200 object-contain bg-white p-1" />
                                @else
                                    <div class="w-20 h-20 flex items-center justify-center bg-gray-100 text-gray-400 rounded-lg border border-gray-200">
                                        <i class="fa fa-image"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Nama --}}
                            <td class="px-4 py-3 font-medium">
                                {{ \Illuminate\Support\Str::limit($product->name, 10) }}
                            </td>

                            {{-- Kategori --}}
                            <td class="px-4 py-3">{{ $product->category->name ?? '-' }}</td>

                            {{-- Harga --}}
                            <td class="px-4 py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                            {{-- Stok --}}
                            <td class="px-4 py-3">{{ $product->stock }}</td>

                            {{-- Deskripsi (maks 80 karakter) --}}
                            <td class="px-4 py-3 text-gray-600">
                                {{ \Illuminate\Support\Str::limit($product->description, 10) }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-x-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-md text-sm font-medium shadow-sm transition-all duration-150">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </a>

                                    {{-- Tombol Delete --}}
                                    <button type="button"
                                        class="delete-btn inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-medium shadow-sm transition-all duration-150"
                                        data-id="{{ $product->id }}">
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                No products available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Delete --}}
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/25 hidden">
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
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Hapus produk ini?</h2>
                <p class="text-sm text-gray-600 mb-4">
                    Apakah kamu yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-end space-x-2">
                    <button type="button"
                        class="border border-gray-200 text-gray-800 bg-white hover:bg-gray-100 px-3 py-1.5 rounded-md"
                        id="cancelDelete">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Native JS --}}
<script>
    const modal = document.getElementById('deleteModal');
    const cancelBtn = document.getElementById('cancelDelete');
    const deleteForm = document.getElementById('deleteForm');
    const modalBox = document.getElementById('modalBox');
    const baseDeleteUrl = "{{ route('admin.products.destroy', ['product' => '__ID__']) }}".replace('__ID__', '');

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-id');
            deleteForm.action = baseDeleteUrl + productId;
            modal.classList.remove('hidden');
        });
    });

    cancelBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    modal.addEventListener('click', e => {
        if (!modalBox.contains(e.target)) modal.classList.add('hidden');
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') modal.classList.add('hidden');
    });
</script>
@endsection
