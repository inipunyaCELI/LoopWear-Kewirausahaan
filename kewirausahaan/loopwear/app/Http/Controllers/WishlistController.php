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
            // Pakai findOrFail biar lebih aman
            $barang = \App\Models\Mbarang::findOrFail($id);

            $wishlist[$id] = [
                "id_barang" => $barang->id_barang, // Aku tambahin simpan ID-nya juga
                "nama" => $barang->nama_barang,
                "harga" => $barang->harga,
                "gambar" => $barang->gambar
            ];
        }

        session()->put('wishlist', $wishlist);

        // Nanti pesan success ini bisa kita tampilkan pakai SweetAlert/Popup
        return back()->with('success', 'Berhasil ditambahkan ke daftar Like!');
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


