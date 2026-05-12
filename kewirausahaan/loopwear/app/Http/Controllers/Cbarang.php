<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;

class Cbarang extends Controller
{
    public function index()
    {
        $barang = Mbarang::all();
        return view('admin.barang.index', compact('barang'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga'       => 'required|numeric',
            'kategori'    => 'required',
            'warna'       => 'required', // Tambahkan validasi warna
            'stok'        => 'required|numeric',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "-" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
        }

        Mbarang::create([
            'nama_barang' => $request->nama_barang,
            'harga'       => $request->harga,
            'kategori'    => strtolower(trim($request->kategori)), 
            'warna'       => $request->warna, // Simpan data warna
            'stok'        => $request->stok, 
            'gambar'      => $nama_file ?? null,
            'status'      => 'available'
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show($id) 
    {
        $product = Mbarang::findOrFail($id);
        
        // Rekomendasi produk berdasarkan kategori yang sama
        $recommendations = Mbarang::where('kategori', $product->kategori)
                            ->where('id_barang', '!=', $id)
                            ->take(4)
                            ->get();

        // Pengaman jika tabel Review belum siap
        try {
            $reviews = $product->reviews()->with('user')->latest()->get();
        } catch (\Exception $e) {
            $reviews = collect(); 
        }

        // DISINI YANG DIUBAH: Mengarahkan langsung ke file review.blade.php
        return view('review', compact('product', 'recommendations', 'reviews'));
    }

    public function edit($id)
    {
        $barang = Mbarang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Mbarang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required',
            'kategori'    => 'required',
            'warna'       => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'gambar'      => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['kategori'] = strtolower(trim($request->kategori)); 
        
        if ($request->hasFile('gambar')) {
            if ($barang->gambar && file_exists(public_path('images/' . $barang->gambar))) {
                unlink(public_path('images/' . $barang->gambar));
            }
            $nama_file = time() . "_" . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('images'), $nama_file);
            $data['gambar'] = $nama_file;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('status', [
            'judul' => 'Terupdate!',
            'pesan' => 'Data barang berhasil diubah',
            'icon'  => 'success'
        ]);
    }

    public function destroy($id)
    {
        $barang = Mbarang::findOrFail($id);
        if ($barang->gambar && file_exists(public_path('images/' . $barang->gambar))) {
            unlink(public_path('images/' . $barang->gambar));
        }
        $barang->delete();
        return redirect()->route('barang.index')->with('status', [
            'judul' => 'Terhapus!',
            'pesan' => 'Barang sudah dihapus',
            'icon'  => 'warning'
        ]);
    }
}