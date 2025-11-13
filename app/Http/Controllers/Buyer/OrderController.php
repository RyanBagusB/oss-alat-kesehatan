<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar pesanan milik pembeli yang sedang login.
     */
    public function index()
    {
        $buyer = Auth::user()->buyer;

        // Ambil semua pesanan milik pembeli, lengkap dengan item dan produk
        $orders = Order::with('items.product')
            ->where('buyer_id', $buyer->id)
            ->latest()
            ->get();

        return view('buyer.orders.index', compact('orders'));
    }

    /**
     * Tampilkan detail dari satu pesanan.
     */
    public function show($id)
    {
        $buyer = Auth::user()->buyer;

        $order = Order::with('items.product')
            ->where('buyer_id', $buyer->id)
            ->findOrFail($id);

        return view('buyer.orders.show', compact('order'));
    }
}
