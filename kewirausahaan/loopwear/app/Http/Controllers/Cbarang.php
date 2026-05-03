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
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'stok' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "-" . $file->getClientOriginalName();

            $file->move(public_path('images'), $nama_file);
        }

        Mbarang::create([
            'nama_barang'   => $request->nama_barang,
            'harga'         => $request->harga,
            'kategori'      => $request->kategori, 
            'stok'          => $request->stok, 
            'gambar'        => $nama_file,
            'status'        => 'available'
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show(string $id) { }

    public function edit(string $id)
    {
        $barang = Mbarang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, string $id)
    {
        $barang = Mbarang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($barang->gambar && file_exists(public_path('images/' . $barang->gambar))) {
                unlink(public_path('images/' . $barang->gambar));
            }

            $nama_file = time() . "_" . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('images'), $nama_file);

            $data['gambar'] = $nama_file;
        } else {
            $data['gambar'] = $barang->gambar;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('status', [
            'judul' => 'Terupdate!',
            'pesan' => 'Data barang berhasil diubah',
            'icon' => 'success'
        ]);
    }

    public function destroy(string $id)
    {
        $barang = Mbarang::findOrFail($id);

        if ($barang->gambar && file_exists(public_path('images/' . $barang->gambar))) {
            unlink(public_path('images/' . $barang->gambar));
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('status', [
            'judul' => 'Terhapus!',
            'pesan' => 'Barang sudah dihapus dari daftar',
            'icon' => 'warning'
        ]);
    }
}