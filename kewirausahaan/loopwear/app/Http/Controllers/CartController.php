<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mbarang;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        return view('cart', compact('cart'));
    }

    public function add($id)
    {
        $cart = session()->get('cart', []);
        $barang = Mbarang::findOrFail($id); 

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "id_barang" => $barang->id_barang,
                "nama"      => $barang->nama_barang,
                "harga"     => $barang->harga,
                "gambar"    => $barang->gambar,
                "qty"       => 1
            ];
        }

        session()->put('cart', $cart);

        $wishlist = session()->get('wishlist', []);
        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return back()->with('success_cart', 'Produk berhasil dimasukkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->has('action')) {
                if ($request->action == 'increase') {
                    $cart[$id]['qty']++;
                } elseif ($request->action == 'decrease' && $cart[$id]['qty'] > 1) {
                    $cart[$id]['qty']--;
                }
            } 

            elseif ($request->has('qty') && $request->qty > 0) {
                $cart[$id]['qty'] = $request->qty;
            }

            session()->put('cart', $cart);
        }

        return back()->with('success', 'Jumlah barang diperbarui!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk dihapus dari Keranjang.');
    }

    public function removeSelected(Request $request)
    {
        $cart = session()->get('cart', []);
        $selected = $request->selected ?? [];

        foreach ($selected as $id) {
            if (isset($cart[$id])) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return back()->with('success_cart', 'Barang terpilih berhasil dihapus dari tas!');
    }

    public function applyVoucher(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['harga'] * $item['qty']);

        $voucher = \App\Models\Voucher::where('kode', strtoupper($request->kode))
                                    ->where('aktif', true)
                                    ->first();

        if (!$voucher) {
            return back()->with('voucher_error', 'Kode voucher tidak ditemukan.');
        }

        if (!$voucher->isValid($total)) {
            return back()->with('voucher_error', 'Voucher tidak valid atau tidak memenuhi syarat.');
        }

        session()->put('voucher', [
            'kode'        => $voucher->kode,
            'tipe'        => $voucher->tipe,
            'nilai'       => $voucher->nilai,
            'diskon'      => $voucher->hitungDiskon($total),
            'min_belanja' => $voucher->min_belanja,
        ]);

        return back()->with('voucher_success', 'Voucher berhasil dipakai!');
    }

    public function removeVoucher()
    {
        session()->forget('voucher');
        return back()->with('voucher_success', 'Voucher dihapus.');
    }

    public function applyVoucherCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        $selected = $request->selected ?? [];

        $total = 0;
        foreach ($selected as $id) {
            if (isset($cart[$id])) {
                $total += $cart[$id]['harga'] * $cart[$id]['qty'];
            }
        }

        $voucher = \App\Models\Voucher::where('kode', strtoupper($request->kode))
                                      ->where('aktif', true)
                                      ->first();

        if (!$voucher) {
            return back()->with('voucher_error', 'Kode voucher tidak ditemukan.');
        }

        if (!$voucher->isValid($total)) {
            return back()->with('voucher_error', 'Voucher tidak valid atau minimum belanja tidak terpenuhi.');
        }

        session()->put('voucher', [
            'kode'        => $voucher->kode,
            'tipe'        => $voucher->tipe,
            'nilai'       => $voucher->nilai,
            'diskon'      => $voucher->hitungDiskon($total),
            'min_belanja' => $voucher->min_belanja, 
        ]);

        return back()->with('voucher_success', 'Voucher berhasil dipakai!');
    }
}