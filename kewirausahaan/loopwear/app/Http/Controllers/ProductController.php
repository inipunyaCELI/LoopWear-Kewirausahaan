<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Mbarang::findOrFail($id);
        return view('detail_barang', compact('item'));
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
