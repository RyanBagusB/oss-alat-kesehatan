<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
// use PDF; // pastikan kamu sudah install barryvdh/laravel-dompdf

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $orders = Order::when($status, fn($q) => $q->where('status', $status))
            ->with('buyer')
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders', 'status'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show($id)
    {
        $order = Order::with(['buyer', 'items.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mengubah status pesanan.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;

        if ($request->status === 'paid' && !$order->paid_at) {
            $order->paid_at = now();
        }

        $order->save();

        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
    }

    /**
     * Mengunduh invoice PDF.
     */
    public function downloadInvoice($id)
    {
        // $order = Order::with(['buyer', 'items.product'])->findOrFail($id);

        // $pdf = PDF::loadView('admin.orders.invoice', compact('order'))
        //     ->setPaper('a4', 'portrait');

        // $filename = 'invoice_order_' . $order->id . '.pdf';
        // return $pdf->download($filename);
    }
}
