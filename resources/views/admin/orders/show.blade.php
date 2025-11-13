@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan</h1>
        <a href="{{ route('admin.orders.index') }}" 
           class="text-indigo-600 hover:underline flex items-center gap-1">
           <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Informasi Pesanan --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-3">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-800">Order ID: {{ $order->id }}</h2>
            <span class="px-3 py-1 rounded-full text-sm font-medium
                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                @else bg-green-100 text-green-800 @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <p class="text-gray-600">Tanggal Pesanan: <span class="font-medium text-gray-800">{{ $order->created_at->format('d M Y, H:i') }}</span></p>
        <p class="text-gray-600">Metode Pembayaran: <span class="font-medium text-gray-800">{{ ucfirst($order->payment_method) }}</span></p>
        <p class="text-gray-600">Alamat Pengiriman: <span class="font-medium text-gray-800">{{ $order->shipping_address }}</span></p>

        @if ($order->paid_at)
            <p class="text-gray-600">Dibayar Pada: <span class="font-medium text-gray-800">{{ $order->paid_at->format('d M Y, H:i') }}</span></p>
        @endif
    </div>

    {{-- Daftar Item --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Produk Dipesan</h2>

        @foreach ($order->items as $item)
            <div class="flex items-center justify-between py-4 border-b last:border-none">
                <div class="flex items-center gap-4">
                    <img src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}" 
                         alt="{{ $item->product->name }}" 
                         class="w-16 h-16 rounded-lg object-cover border">
                    <div>
                        <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                    </div>
                </div>
                <p class="font-semibold text-gray-800">
                    Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </p>
            </div>
        @endforeach

        <div class="text-right pt-4 border-t">
            <p class="text-lg font-bold text-gray-800">
                Total: Rp{{ number_format($order->total_amount, 0, ',', '.') }}
            </p>
        </div>
    </div>

    {{-- Update Status --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Ubah Status Pesanan</h2>

        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="flex flex-col sm:flex-row items-center gap-4">
            @csrf
            @method('PATCH')

            <select name="status" required
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>

            <button type="submit" 
                class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <i class="fa-solid fa-rotate-right"></i> Perbarui Status
            </button>

            <a href="{{ route('admin.orders.invoice', $order->id) }}" 
               class="px-5 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition flex items-center gap-2">
                <i class="fa-solid fa-file-arrow-down"></i> Unduh Invoice
            </a>
        </form>
    </div>

</div>
@endsection
