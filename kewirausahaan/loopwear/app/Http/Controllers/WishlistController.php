<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mbarang;
use App\Models\Wishlist;


class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        return view('wishlist', compact('wishlist'));
    }

    public function add($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (!isset($wishlist[$id])) {
            $barang = \App\Models\Mbarang::find($id);

            $wishlist[$id] = [
                "nama" => $barang->nama_barang,
                "harga" => $barang->harga,
                "gambar" => $barang->gambar
            ];
        }

        session()->put('wishlist', $wishlist);

        return back()->with('success', 'Masuk ke wishlist!');
    }

    public function remove($id)
{
    $wishlist = session()->get('wishlist', []);

        if(isset($wishlist[$id])){
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return back();
    }
}
