<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Mbarang;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function process (Request $request)
    {
        $barang = Mbarang::findOrFail($request->id_barang);

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'LW-' . time(),
            'total_price' => $barang->harga,
            'status_payment' => 'pending',
            'address' => $request->address,
        ]);

        Config::$serverKey = config('midtrans.server_key'); 
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
           'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $order->update(['snap_token' => $snapToken]);

        return view('checkout', compact('order', 'snapToken'));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
