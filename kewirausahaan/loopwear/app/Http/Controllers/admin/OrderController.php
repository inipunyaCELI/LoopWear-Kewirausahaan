<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::with('user')->latest()->get();
        
        foreach ($orders as $order) {
            $order->syncMidtransStatus();
        }

        return view('admin.orders.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = \App\Models\Order::with(['user', 'orderItems'])->findOrFail($id);
        return view('admin.orders.detail', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update(['status_delivery' => $request->status_delivery]);
        return back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }

    public function show($id)
    {
        $order = \App\Models\Order::with(['user', 'orderItems.mbarang'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function cancel($id)
    {
        $order = \App\Models\Order::with('user')->findOrFail($id);
        
        $order->update([
            'status_payment' => 'dibatalkan',
            'status_delivery' => 'dibatalkan'
        ]);

        if ($order->user) {
            $order->user->notify(new \App\Notifications\OrderCancelledNotification($order->order_number));
        }

        return back()->with('success', 'Pesanan berhasil dibatalkan oleh Admin.');
    }
}
