@extends('layouts.buyer')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-credit-card text-indigo-600"></i>
            Checkout
        </h2>
        <a href="{{ route('buyer.cart.index') }}" class="text-sm text-indigo-600 hover:underline flex items-center gap-1">
            <i class="fa fa-arrow-left"></i> Kembali ke Keranjang
        </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('buyer.checkout.process') }}" method="POST" class="bg-white rounded-2xl shadow p-6 space-y-6">
        @csrf

        {{-- Alamat Pengiriman --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Pengiriman</label>
            <textarea name="shipping_address" rows="3" required
                class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('shipping_address', Auth::user()->buyer->address ?? '') }}</textarea>
        </div>

        {{-- Metode Pembayaran --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</label>
            <select name="payment_method" required
                class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="paypal">PayPal</option>
                <option value="stripe">Stripe</option>
                <option value="manual">Transfer Bank Manual</option>
            </select>
        </div>

        {{-- Ringkasan Pesanan --}}
        <div class="border-t pt-4 space-y-2">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa fa-box"></i> Ringkasan Pesanan
            </h3>
            <ul class="divide-y divide-gray-100 text-sm text-gray-700">
                @foreach($carts as $cart)
                    <li class="flex justify-between py-2">
                        <span>{{ $cart->product->name }} × {{ $cart->quantity }}</span>
                        <span>Rp{{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-between font-semibold text-gray-900 border-t pt-3">
                <span>Total</span>
                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
                <i class="fa-solid fa-paper-plane"></i>
                Buat Pesanan
            </button>
        </div>
    </form>
</div>
@endsection
