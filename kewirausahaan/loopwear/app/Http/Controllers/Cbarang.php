<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;

class Cbarang extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Mbarang::all();
        return view('admin.barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();

            $file->move(public_path('images'), $nama_file);

            $data['gambar'] = $nama_file;
        }

        Mbarang::create($data);

        return redirect()->route('barang.index')->with('status', [
            'judul' => 'Berhasil!',
            'pesan' => 'Barang thrift baru berhasil dipajang',
            'icon' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Mbarang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Mbarang::findOrFail($id);

        // 1. Validasi input
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil semua input kecuali gambar dulu
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus foto lama
            if ($barang->gambar && file_exists(public_path('images/' . $barang->gambar))) {
                unlink(public_path('images/' . $barang->gambar));
            }

            $nama_file = time() . "_" . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('images'), $nama_file);

            // Masukkan nama file baru ke array data
            $data['gambar'] = $nama_file;
        } else {
            // JIKA tidak upload gambar baru, tetap gunakan nama gambar yang lama
            $data['gambar'] = $barang->gambar;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('status', [
            'judul' => 'Terupdate!',
            'pesan' => 'Data barang berhasil diubah',
            'icon' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
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
