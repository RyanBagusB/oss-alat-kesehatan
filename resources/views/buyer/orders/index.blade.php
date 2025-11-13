@extends('layouts.buyer')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">

    <h1 class="text-2xl font-bold text-gray-800 border-b pb-4">Daftar Pesananmu</h1>

    {{-- Jika belum ada pesanan --}}
    @if ($orders->isEmpty())
        <div class="text-center py-20 bg-white rounded-lg shadow-sm border border-gray-100">
            <i class="fa-solid fa-box-open text-gray-400 text-6xl mb-4"></i>
            <p class="text-gray-600 text-lg">Kamu belum memiliki pesanan.</p>
            <a href="{{ route('buyer.products.index') }}" 
               class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
               Belanja Sekarang
            </a>
        </div>
    @else
        {{-- Daftar Pesanan --}}
        <div class="grid gap-6">
            @foreach ($orders as $order)
                <div class="bg-white shadow-sm border border-gray-100 rounded-xl p-6 hover:shadow-md transition">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 border-b pb-4">
                        <div>
                            <h2 class="font-semibold text-gray-800">Order ID: {{ $order->id }}</h2>
                            <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="px-3 py-1 text-sm rounded-full font-medium 
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                            @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="mt-4 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                        <p class="text-gray-700">Total: 
                            <span class="font-semibold text-gray-900">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </p>
                        <div class="flex flex-wrap gap-2">
                            {{-- Tombol Lihat Detail --}}
                            <a href="{{ route('buyer.orders.show', $order->id) }}" 
                               class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                <i class="fa-solid fa-eye"></i> Lihat Detail
                            </a>

                            {{-- Tombol Unduh Invoice --}}
                            <a href="#" target="_blank"
                               class="inline-flex items-center gap-2 px-5 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition border border-gray-300">
                                <i class="fa-solid fa-file-pdf text-red-500"></i> Unduh PDF
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
