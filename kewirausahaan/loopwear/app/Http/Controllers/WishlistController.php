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
        Wishlist::create([
        'barang_id' => $id,
        'user_id' => auth()->id()
    ]);

    return back();
    }

    public function remove($id)
    {
        $wishlist = session()->get('wishlist');
        unset($wishlist[$id]);
        session()->put('wishlist', $wishlist);

        return back();
    }
}
