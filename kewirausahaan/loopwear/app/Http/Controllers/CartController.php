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
        $item = Mbarang::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "nama" => $item->nama_barang,
                "harga" => $item->harga,
                "gambar" => $item->gambar,
                "qty" => 1
            ];
        }

        session()->put('cart', $cart);
        return back();
    }

    public function update(Request $request, $id)
    {
         $cart = session()->get('cart');

        if ($request->type == 'plus') {
            $cart[$id]['qty']++;
        } else {
            $cart[$id]['qty']--;
        }

        session()->put('cart', $cart);

    return back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back();
    }
}
