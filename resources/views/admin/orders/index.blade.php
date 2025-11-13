@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pesanan</h1>

        {{-- Filter Status --}}
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex items-center gap-3">
            <select name="status" onchange="this.form.submit()" 
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Order ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Buyer</th>
                    <th class="px-6 py-3 text-left font-semibold">Tanggal</th>
                    <th class="px-6 py-3 text-left font-semibold">Total</th>
                    <th class="px-6 py-3 text-center font-semibold">Status</th>
                    <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">#{{ $order->id }}</td>
                        <td class="px-6 py-4">{{ $order->buyer->name ?? '—' }}</td>
                        <td class="px-6 py-4">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                                @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                <i class="fa-solid fa-eye text-sm"></i> Detail
                            </a>
                            <a href="{{ route('admin.orders.invoice', $order->id) }}" 
                               class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition">
                                <i class="fa-solid fa-file-arrow-down text-sm"></i> Invoice
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>
                            <p>Tidak ada pesanan ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div>
        {{-- {{ $orders->links('vendor.pagination.tailwind') }} --}}
    </div>
</div>
@endsection
