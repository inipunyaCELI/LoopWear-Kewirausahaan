<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        $semua = $orders;
        $dikemas = $orders->where('status_payment', 'success')->where('status_delivery', 'pending');
        $dikirim = $orders->where('status_delivery', 'dikirim');
        $selesai = $orders->where('status_delivery', 'selesai');
        
        // Fix for old pending orders without snap_token
        foreach ($orders as $order) {
            if ($order->status_payment == 'pending' && is_null($order->snap_token)) {
                \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                \Midtrans\Config::$isProduction = false;

                $params = [
                    'transaction_details' => [
                        'order_id' => $order->order_number,
                        'gross_amount' => $order->total_price,
                    ],
                ];
                
                try {
                    $snapToken = \Midtrans\Snap::getSnapToken($params);
                    $order->update(['snap_token' => $snapToken]);
                } catch (\Exception $e) {
                    // Ignore error if midtrans config fails for some reason
                }
            }
        }

        return view('pesanan', compact('semua', 'dikemas', 'dikirim', 'selesai'));
    }
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status_payment', 'pending')
            ->firstOrFail();

        $order->update([
            'status_payment' => 'dibatalkan',
            'status_delivery' => 'dibatalkan'
        ]);

        return back()->with('success_cancel', 'Pesanan berhasil dibatalkan.');
    }
}
