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
    // Ini fungsi jika user checkout 1 barang langsung (beli sekarang)
    public function process(Request $request)
    {
        $barang = Mbarang::findOrFail($request->id_barang);
        
        $ongkir = 10000;
        $biaya_layanan = 2000;
        $grand_total = $barang->harga + $ongkir + $biaya_layanan;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'LW-' . time(),
            'total_price' => $grand_total,
            'status_payment' => 'pending',
            'address' => $request->address,
        ]);

        Config::$serverKey = config('midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY'); 
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

        return view('payment', compact('order', 'snapToken'));
    }

    // Ini fungsi untuk memunculkan Halaman Checkout (dari Keranjang)
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $selected = $request->selected ?? [];

        if (empty($selected)) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu barang untuk di-checkout.');
        }

        $checkout_items = [];
        $subtotal = 0;

        foreach ($selected as $id) {
            if(isset($cart[$id])) {
                $checkout_items[$id] = $cart[$id];
                $subtotal += $cart[$id]['harga'] * $cart[$id]['qty'];
            }
        }

        // Tetapkan biaya tambahan (Bisa diganti dinamis nanti kalau ada API Ekspedisi)
        $ongkir = 10000;
        $biaya_layanan = 2000;
        $grand_total = $subtotal + $ongkir + $biaya_layanan;

        // Bawa data ke halaman checkout
        return view('checkout', compact('checkout_items', 'selected', 'subtotal', 'ongkir', 'biaya_layanan', 'grand_total'));
    }

    public function create() {}

    // Ini fungsi saat tombol "Buat Pesanan" diklik
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        $selected = $request->selected ?? [];

        if(empty($selected)){
            return back()->with('error', 'Data pesanan tidak valid.');
        }

        // Jika user belum punya alamat di akunnya, simpan alamat yang dia ketik ini ke akunnya
        $user = auth()->user();
        if (empty($user->alamat)) {
            $user->update([
                'alamat' => $request->alamat
            ]);
        }

        $subtotal = 0;
        $itemsDipilih = [];

        foreach ($selected as $id) {
            if(isset($cart[$id])) {
                $item = $cart[$id];
                $subtotal += $item['harga'] * $item['qty'];
                $itemsDipilih[$id] = $item;
            }
        }

        $ongkir = 10000;
        $biaya_layanan = 2000;
        $grand_total = $subtotal + $ongkir + $biaya_layanan;

        // 1. Simpan ke tabel Orders
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'LW-' . time(),
            'total_price' => $grand_total, // Simpan harga keseluruhan
            'status_payment' => 'pending',
            'address' => $request->alamat
        ]);

        // 2. Simpan per item ke tabel OrderItems
        foreach ($itemsDipilih as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'barang_id' => $id,
                'nama_barang' => $item['nama'],
                'harga' => $item['harga'],
                'qty' => $item['qty']
            ]);
            
            // Opsional: Hapus barang yang sudah dicheckout dari session cart
            // unset($cart[$id]);
        }
        session()->put('cart', $cart);

        // 3. Request Token Midtrans
        Config::$serverKey = config('midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $grand_total,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'email' => $request->email,
                'billing_address' => [
                    'address' => $request->alamat
                ]
            ]
        ];

// ... kode midtrans kamu sebelumnya
        $snapToken = Snap::getSnapToken($params);

        // Tangkap metode pembayaran DAN bank yang dipilih
        $payment_method = $request->payment; 
        $bank = $request->bank ?? 'bsi'; // Default ke bsi kalau kosong

        // Bawa $bank ke halaman view
        return view('payment', compact('order', 'snapToken', 'payment_method', 'bank'));
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}