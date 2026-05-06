<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Mbarang;
use App\Models\OrderItem;
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

    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $selected = $request->selected ?? [];

        $selectedItems = [];

        foreach ($selected as $id) {
            if(isset($cart[$id])) {
                $selectedItems[$id] = $cart[$id];
            }
        }

        return view('checkout', [
            'items' => $selectedItems,
            'selected' => $selected
        ]);
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
            $cart = session()->get('cart', []);
            $selected = $request->selected ?? [];

            if(empty($selected)){
                return back()->with('error', 'Pilih barang dulu');
            }

            $total = 0;
            $itemsDipilih = [];

            foreach ($selected as $id) {
                if(isset($cart[$id])) {
                    $item = $cart[$id];
                    $subtotal = $item['harga'] * $item['qty'];
                    $total += $subtotal;

                    $itemsDipilih[$id] = $item;
                }
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'LW-' . time(),
                'total_price' => $total,
                'status_payment' => 'pending',
                'address' => $request->alamat
            ]);

            foreach ($itemsDipilih as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'barang_id' => $id,
                    'nama_barang' => $item['nama'],
                    'harga' => $item['harga'],
                    'qty' => $item['qty']
                ]);
            }

            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $total,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            return view('payment', compact('order', 'snapToken'));
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



