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
        $barang = \App\Models\Mbarang::findOrFail($id);

        if(isset($cart[$id])) {
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

        // Menghapus item dari wishlist jika ada saat ditambahkan ke keranjang
        $wishlist = session()->get('wishlist', []);
        if(isset($wishlist[$id])) {
            unset($wishlist[$id]); 
            session()->put('wishlist', $wishlist); 
        }

        return back()->with('success', 'Produk berhasil dipindah ke Keranjang! 🛒');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            // Logika untuk tombol increase (+) dan decrease (-)
            if ($request->has('action')) {
                if ($request->action == 'increase') {
                    $cart[$id]['qty']++;
                } elseif ($request->action == 'decrease' && $cart[$id]['qty'] > 1) {
                    $cart[$id]['qty']--;
                }
            } 
            // Tetap mendukung input manual jika qty lebih dari 0
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

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk dihapus dari Keranjang.');
    }
}