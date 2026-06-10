<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Mbarang;
use App\Models\OrderItem;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
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
            if (isset($cart[$id])) {
                $checkout_items[$id] = $cart[$id];
                $subtotal += $cart[$id]['harga'] * $cart[$id]['qty'];
            }
        }

        $ongkir        = 10000;
        $biaya_layanan = 2000;

        $voucherSession = session()->get('voucher');
        $voucher        = null;
        $diskon         = 0;
        $gratis_ongkir  = false;

        if ($voucherSession) {
            $voucherModel = Voucher::where('kode', $voucherSession['kode'])->where('aktif', true)->first();

            if ($voucherModel && $voucherModel->isValid($subtotal)) {
                $voucher = $voucherSession; 
                
                if ($voucherModel->tipe === 'gratis_ongkir' || $voucherModel->tipe === 'ongkir') {
                    $gratis_ongkir = true;
                    $ongkir = 0;
                } else {
                    $diskon = $voucherModel->hitungDiskon($subtotal);
                    $voucher['diskon'] = $diskon; 
                    
                    session()->put('voucher', $voucher);
                }
                } else {
                session()->forget('voucher');
                session()->now('error', 'Voucher dibatalkan karena syarat minimum belanja tidak terpenuhi.'); 
            }        
        }

        $grand_total = max(0, $subtotal - $diskon + $ongkir + $biaya_layanan);

        return view('checkout', compact(
            'checkout_items', 'selected', 'subtotal',
            'ongkir', 'biaya_layanan', 'grand_total',
            'diskon', 'voucher', 'gratis_ongkir'
        ));
    }

    public function store(Request $request)
    {
        $cart     = session()->get('cart', []);
        $selected = $request->selected ?? [];

        if (empty($selected)) {
            return back()->with('error', 'Pilih barang dulu');
        }

        $user = auth()->user();
        if ($user && empty($user->alamat)) {
            $user->update(['alamat' => $request->alamat]);
        }

        $subtotal     = 0;
        $itemsDipilih = [];

        foreach ($selected as $id) {
            if (isset($cart[$id])) {
                $item      = $cart[$id];
                $subtotal += $item['harga'] * $item['qty'];
                $itemsDipilih[$id] = $item;
            }
        }

        $ongkir        = 10000;
        $biaya_layanan = 2000;

        $voucherSession = session()->get('voucher');
        $diskon         = 0;
        $voucher        = null;

        if ($voucherSession) {
            $voucherModel = Voucher::where('kode', $voucherSession['kode'])->where('aktif', true)->first();

            if ($voucherModel && $voucherModel->isValid($subtotal)) {
                $voucher = $voucherSession;
                if ($voucherModel->tipe === 'gratis_ongkir' || $voucherModel->tipe === 'ongkir') {
                    $ongkir = 0;
                } else {
                    $diskon = $voucherModel->hitungDiskon($subtotal);
                }
            } else {
                session()->forget('voucher');
            }
        }

        $grand_total = max(0, $subtotal - $diskon + $ongkir + $biaya_layanan);

        $order = Order::create([
            'user_id'        => auth()->id(),
            'order_number'   => 'LW-' . time() . '-' . rand(1000, 9999),
            'total_price'    => $grand_total,
            'status_payment' => 'pending',
            'address'        => $request->alamat,
        ]);

        foreach ($itemsDipilih as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'barang_id'  => $id,
                'nama_barang'=> $item['nama'],
                'harga'      => $item['harga'],
                'qty'        => $item['qty'],
            ]);

            if (isset($cart[$id])) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        if ($voucher) {
            Voucher::where('kode', $voucher['kode'])->increment('terpakai');
            session()->forget('voucher');
        }

        Config::$serverKey    = config('midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_number,
                'gross_amount' => $grand_total,
            ],
            'customer_details' => [
                'first_name'      => $request->nama,
                'email'           => $request->email,
                'billing_address' => ['address' => $request->alamat],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $order->update(['snap_token' => $snapToken]);

        $payment_method = $request->payment;
        $bank           = $request->bank ?? 'bsi';

        return view('payment', compact('order', 'snapToken', 'payment_method', 'bank'));
    }

    public function process(Request $request)
    {
        $barang        = Mbarang::findOrFail($request->id_barang);
        $ongkir        = 10000;
        $biaya_layanan = 2000;
        $grand_total   = $barang->harga + $ongkir + $biaya_layanan;

        $order = Order::create([
            'user_id'        => auth()->id(),
            'order_number'   => 'LW-' . time() . '-' . rand(1000, 9999),
            'total_price'    => $grand_total,
            'status_payment' => 'pending',
            'address'        => $request->address,
        ]);

        Config::$serverKey    = config('midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_number,
                'gross_amount' => $grand_total,
            ],
            'customer_details' => [
                'first_name'      => $request->nama,
                'email'           => $request->email,
                'billing_address' => ['address' => $request->alamat],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $order->update(['snap_token' => $snapToken]);

        return view('payment', compact('order', 'snapToken'));
    }

    public function callback(Request $request)
    {
        try {
            $serverKey = config('midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
            $hashed    = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            if ($hashed == $request->signature_key) {
                $order = Order::where('order_number', $request->order_id)->first();

                if ($order) {
                    if (in_array($request->transaction_status, ['capture', 'settlement'])) {
                        $order->status_payment = 'success';
                    } elseif (in_array($request->transaction_status, ['cancel', 'deny', 'expire'])) {
                        $order->status_payment = 'failed';
                    } elseif ($request->transaction_status == 'pending') {
                        $order->status_payment = 'pending';
                    }
                    $order->save();
                    return response()->json(['message' => 'Status berhasil diupdate'], 200);
                }
                return response()->json(['message' => 'Order tidak ditemukan'], 404);
            }
            return response()->json(['message' => 'Invalid Signature'], 403);

        } catch (\Exception $e) {
            Log::error('Midtrans Webhook Error: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}