@extends('layout.main')
@section('konten')
<div class="card shadow col-md-6 mx-auto">
    <div class="card-header bg-warning text-dark"><h5>Edit Data Barang</h5></div>
    <div class="card-body">
        <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
            </div>
            <div class="mb-3">
                <label>Kategori Produk</label>
                <select name="kategori" class="form-select">
                    <option value="hijab" {{ $barang->kategori == 'hijab' ? 'selected' : '' }}>Hijab</option>
                    <option value="baju" {{ $barang->kategori == 'baju' ? 'selected' : '' }}>Baju</option>
                    <option value="celana" {{ $barang->kategori == 'celana' ? 'selected' : '' }}>Celana</option>
                    <option value="sepatu" {{ $barang->kategori == 'sepatu' ? 'selected' : '' }}>Sepatu</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ $barang->harga }}" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
            </div>
            <div class="mb-3">
                <label>Foto Produk (Kosongkan jika tidak ingin ganti)</label>
                <br>
                <img src="{{ asset('images/'.$barang->gambar) }}" width="100" class="mb-2 rounded">
                <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
        </form>
    </div>
</div>

@endsection