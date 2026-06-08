<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PesananController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($orders as $order) {
            if ($order->status_payment == 'pending') {
                $order->syncMidtransStatus();
                
                if ($order->status_payment == 'pending' && is_null($order->snap_token)) {
                    Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                    Config::$isProduction = false;
    
                    $params = [
                        'transaction_details' => [
                            'order_id' => $order->order_number,
                            'gross_amount' => $order->total_price,
                        ],
                    ];
                    
                    try {
                        $snapToken = Snap::getSnapToken($params);
                        $order->update(['snap_token' => $snapToken]);
                    } catch (\Exception $e) {
                    }
                }
            }
        }

        $semua = $orders;
        $dikemas = $orders->where('status_payment', 'success')->where('status_delivery', 'process');
        $dikirim = $orders->where('status_delivery', 'dikirim');
        $selesai = $orders->where('status_delivery', 'selesai');

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

    public function complete($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status_delivery', 'dikirim')
            ->firstOrFail();

        $order->update([
            'status_delivery' => 'selesai'
        ]);

        return back()->with('success', 'Pesanan telah diselesaikan. Terima kasih!');
    }
}