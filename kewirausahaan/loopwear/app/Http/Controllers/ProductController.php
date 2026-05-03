<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $items = Mbarang::where('status', 'available')->latest()->take(4)->get();
        return view('welcome', compact('items'));
    }

    public function center(Request $request)
    {
        $all_items = Mbarang::where('status', 'available')->get();

        $data = [
            'hijab'  => $all_items->where('kategori', 'hijab'),
            'baju'   => $all_items->where('kategori', 'baju'),
            'celana' => $all_items->where('kategori', 'celana'),
            'sepatu' => $all_items->where('kategori', 'sepatu'),
        ];

        return view('products', compact('data'));
    }

    public function create() { }
    public function store(Request $request) { }

    public function show($id)
    {
        $item = Mbarang::findOrFail($id);
        return view('detail_barang', compact('item'));
    }

    public function edit(string $id) { }
    public function update(Request $request, string $id) { }
    public function destroy(string $id) { }
}