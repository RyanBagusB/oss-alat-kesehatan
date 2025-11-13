{{-- resources/views/buyer/cart/index.blade.php --}}
@extends('layouts.buyer')

@section('content')
<div class="flex flex-col gap-6">

    {{-- Header --}}
    <div class="flex items-end justify-between">
        <div class="flex flex-col gap-y-1.5">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Keranjang Belanja
            </h2>
        </div>
    </div>

    {{-- Card / Table Container --}}
    <div class="bg-white rounded-2xl overflow-hidden shadow">

        {{-- Card Header --}}
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-cart-shopping text-indigo-600"></i>
                Daftar Produk di Keranjang
            </h3>
        </div>

        {{-- Card Body --}}
        <div class="p-4 overflow-x-auto">
            @if ($carts->isEmpty())
                <div class="py-20 flex flex-col items-center justify-center text-gray-600">
                    <i class="fa-solid fa-cart-arrow-down text-6xl text-indigo-400 mb-4"></i>
                    <p class="text-lg">Keranjangmu masih kosong.</p>
                    <a href="{{ route('buyer.products.index') }}" 
                       class="mt-6 px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition inline-flex items-center gap-2">
                        <i class="fa-solid fa-store"></i> Belanja Sekarang
                    </a>
                </div>
            @else
                <table class="min-w-full text-sm sm:text-base">
                    <thead class="bg-gray-50 text-gray-600 uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left font-bold tracking-wide">#</th>
                            <th class="px-4 py-3 text-left font-bold tracking-wide">Produk</th>
                            <th class="px-4 py-3 text-left font-bold tracking-wide">Harga</th>
                            <th class="px-4 py-3 text-left font-bold tracking-wide">Jumlah</th>
                            <th class="px-4 py-3 text-left font-bold tracking-wide">Subtotal</th>
                            <th class="px-4 py-3 text-right font-bold tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-800">
                        @foreach ($carts as $index => $cart)
                            <tr class="transition-colors hover:bg-indigo-50/50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 flex items-center gap-4">
                                    <img src="{{ $cart->product->image ? asset('storage/' . $cart->product->image) : 'https://via.placeholder.com/80' }}"
                                         alt="{{ $cart->product->name }}" 
                                         class="w-16 h-16 object-cover rounded-md border border-gray-200">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $cart->product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ Str::limit($cart->product->description, 40) }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    Rp{{ number_format($cart->product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('buyer.cart.update', $cart->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" 
                                               value="{{ $cart->quantity }}" min="1"
                                               class="w-20 border border-gray-300 rounded-md px-2 py-1 text-center focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <button type="submit" 
                                                class="px-2 text-indigo-600 hover:text-indigo-800 transition"
                                                title="Update jumlah">
                                            <i class="fa-solid fa-rotate-right"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 font-semibold text-gray-800">
                                    Rp{{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <form action="{{ route('buyer.cart.destroy', $cart->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Hapus produk">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Total dan Checkout --}}
                <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-6 border-t border-gray-200 gap-4">
                    <div class="text-center sm:text-left">
                        <p class="text-gray-700">Total Pembayaran:</p>
                        <p class="text-2xl font-semibold text-gray-800">Rp{{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('buyer.checkout.show') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
                        <i class="fa-solid fa-credit-card"></i> 
                        Lanjut ke Pembayaran
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
