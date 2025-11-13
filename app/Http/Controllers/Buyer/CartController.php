<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $buyer = Auth::user()->buyer;

        // Ambil semua item cart milik buyer
        $carts = Cart::with('product')
            ->where('buyer_id', $buyer->id)
            ->get();

        // Hitung total semua item
        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('buyer.cart.index', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $buyer = Auth::user()->buyer;

        $request->validate([
            'product_id' => 'required|uuid',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(
            [
                'buyer_id' => $buyer->id,
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => 0,
            ]
        );

        $cart->quantity += $request->quantity;
        $cart->save();

        return redirect()->route('buyer.cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
