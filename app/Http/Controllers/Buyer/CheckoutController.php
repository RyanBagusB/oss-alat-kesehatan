<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $buyer = Auth::user()->buyer;
        $carts = Cart::with('product')->where('buyer_id', $buyer->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('buyer.cart.index')->with('info', 'Keranjangmu masih kosong.');
        }

        $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        return view('buyer.checkout.show', compact('carts', 'total'));
    }

    public function process(Request $request)
    {
        $buyer = Auth::user()->buyer;

        $validated = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $carts = Cart::with('product')->where('buyer_id', $buyer->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('buyer.cart.index')->with('info', 'Keranjang kosong.');
        }

        DB::transaction(function () use ($buyer, $carts, $validated) {
            $order = Order::create([
                'id' => Str::uuid(),
                'buyer_id' => $buyer->id,
                'total_amount' => $carts->sum(fn($cart) => $cart->product->price * $cart->quantity),
                'payment_method' => $validated['payment_method'],
                'shipping_address' => $validated['shipping_address'],
                'status' => 'pending',
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'id' => Str::uuid(),
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);
            }

            Cart::where('buyer_id', $buyer->id)->delete();
        });

        return redirect()->route('buyer.orders.index')->with('success', 'Pesanan berhasil dibuat, silakan lanjut ke pembayaran.');
    }
}
