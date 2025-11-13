@extends('layouts.buyer')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b pb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-receipt text-indigo-600"></i> Detail Pesanan
            </h1>
            <p class="text-sm text-gray-500 mt-1">Lihat informasi lengkap tentang pesananmu di bawah ini.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="#" target="_blank"
               class="inline-flex items-center gap-2 px-5 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition">
                <i class="fa-solid fa-file-pdf text-red-500"></i> Unduh PDF
            </a>
            <a href="{{ route('buyer.orders.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
               <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Informasi Umum --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 sm:p-8 space-y-4 hover:shadow-lg transition">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-gray-800 text-lg">Order ID: 
                    <span class="text-indigo-600 font-mono">{{ $order->id }}</span>
                </h2>
                <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <span class="px-4 py-1.5 rounded-full text-sm font-medium capitalize
                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                @else bg-green-100 text-green-800 @endif">
                {{ $order->status }}
            </span>
        </div>

        <div class="grid sm:grid-cols-3 gap-4 text-sm text-gray-700 mt-3">
            <div>
                <p class="font-medium text-gray-500">Metode Pembayaran</p>
                <p class="text-gray-800">{{ ucfirst($order->payment_method) }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-500">Alamat Pengiriman</p>
                <p class="text-gray-800">{{ $order->shipping_address }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-500">Status Pembayaran</p>
                <p class="text-gray-800">{{ ucfirst($order->payment_status ?? 'Belum Dibayar') }}</p>
            </div>
        </div>
    </div>

    {{-- Daftar Item --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 sm:p-8 space-y-6 hover:shadow-lg transition">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-3 flex items-center gap-2">
            <i class="fa-solid fa-box text-indigo-600"></i> Produk Dipesan
        </h2>

        <div class="divide-y divide-gray-100">
            @foreach ($order->items as $item)
                <div class="flex flex-col sm:flex-row items-center justify-between py-5 gap-4">
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <img src="{{ $item->product->image ?? 'https://via.placeholder.com/100' }}" 
                             alt="{{ $item->product->name }}" 
                             class="w-20 h-20 rounded-lg object-cover border">
                        <div>
                            <p class="font-medium text-gray-900 text-base">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            <p class="text-sm text-gray-500">Harga: Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-gray-800 text-right w-full sm:w-auto">
                        Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="text-right pt-5 border-t">
            <p class="text-lg font-bold text-gray-800">
                Total Pembayaran: 
                <span class="text-indigo-700">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </p>
        </div>
    </div>
</div>
@endsection
