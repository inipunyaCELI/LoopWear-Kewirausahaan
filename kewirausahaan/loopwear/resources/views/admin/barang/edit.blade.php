@extends('layout.main')

@section('konten')
<style>
    /* Tipografi & Warna Dasar */
    .edit-container { font-family: 'Quicksand', sans-serif; }
    .edit-title { font-family: 'Fredoka One', cursive; color: #47510B; letter-spacing: 1px; }
    
    /* Card Styling - Lemon Yellow Header */
    .custom-card-edit { 
        border-radius: 30px; 
        border: none; 
        overflow: hidden; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
    }
    .card-header-loop { 
        background-color: #FFF24D !important; 
        border-bottom: none; 
        padding: 20px; 
    }

    /* Form Styling */
    .form-label-loop { font-weight: 700; color: #47510B; font-size: 0.9rem; margin-bottom: 8px; }
    .form-control-loop { 
        border-radius: 15px; 
        border: 2px solid #f0f0f0; 
        padding: 12px 15px; 
        transition: 0.3s; 
    }
    .form-control-loop:focus { 
        border-color: #FFF24D; 
        box-shadow: none; 
        background-color: #fffdf0; 
    }

    /* Button Styling */
    .btn-save-loop { 
        background-color: #47510B !important; 
        color: #FFF24D !important; 
        border-radius: 15px; 
        font-weight: 800; 
        padding: 12px; 
        border: none; 
        transition: 0.3s; 
    }
    .btn-save-loop:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(71, 81, 11, 0.2); }

    .btn-cancel-loop { 
        background-color: #8CABFF !important; 
        color: white !important; 
        border-radius: 15px; 
        font-weight: 800; 
        padding: 12px; 
        border: none; 
        transition: 0.3s; 
    }
    .btn-cancel-loop:hover { opacity: 0.9; transform: translateY(-2px); color: white; }

    .img-preview-edit { 
        border-radius: 20px; 
        border: 3px solid #FFF24D; 
        padding: 5px; 
        background: white; 
    }
</style>

<div class="container py-5 edit-container">
    <div class="card shadow-sm col-md-8 mx-auto custom-card-edit">
        <div class="card-header-loop text-center">
            <h4 class="edit-title mb-0">EDIT DATA BARANG ✨</h4>
        </div>
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- BARIS 1: NAMA BARANG --}}
                    <div class="col-12 mb-4">
                        <label class="form-label-loop">Nama Barang 🎀</label>
                        <input type="text" name="nama_barang" class="form-control form-control-loop" value="{{ $barang->nama_barang }}" required>
                    </div>

                    {{-- BARIS 2: KATEGORI & WARNA --}}
                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Kategori Produk</label>
                        <select name="kategori" class="form-select form-control-loop">
                            <option value="baju" {{ $barang->kategori == 'baju' ? 'selected' : '' }}>Baju </option>
                            <option value="celana" {{ $barang->kategori == 'celana' ? 'selected' : '' }}>Celana </option>
                            <option value="hijab" {{ $barang->kategori == 'hijab' ? 'selected' : '' }}>Hijab </option>
                            <option value="sepatu" {{ $barang->kategori == 'sepatu' ? 'selected' : '' }}>Sepatu </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Warna Utama </label>
                        <select name="warna" class="form-select form-control-loop">
                            <option value="black" {{ $barang->warna == 'black' ? 'selected' : '' }}>Black</option>
                            <option value="blue" {{ $barang->warna == 'blue' ? 'selected' : '' }}>Blue</option>
                            <option value="brown" {{ $barang->warna == 'brown' ? 'selected' : '' }}>Brown</option>
                            <option value="gray" {{ $barang->warna == 'gray' ? 'selected' : '' }}>Gray</option>
                            <option value="orange" {{ $barang->warna == 'orange' ? 'selected' : '' }}>Orange</option>
                            <option value="pink" {{ $barang->warna == 'pink' ? 'selected' : '' }}>Pink</option>
                            <option value="purple" {{ $barang->warna == 'purple' ? 'selected' : '' }}>Purple</option>
                            <option value="red" {{ $barang->warna == 'red' ? 'selected' : '' }}>Red</option>
                            <option value="silver" {{ $barang->warna == 'silver' ? 'selected' : '' }}>Silver</option>
                            <option value="White" {{ $barang->warna == 'White' ? 'selected' : '' }}>White</option>
                            <option value="yellow" {{ $barang->warna == 'yellow' ? 'selected' : '' }}>Yellow</option>                        </select>
                    </div>

                    {{-- BARIS 3: HARGA & STOK --}}
                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control form-control-loop" value="{{ $barang->harga }}" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Stok Ready</label>
                        <input type="number" name="stok" class="form-control form-control-loop" value="{{ $barang->stok }}" required>
                    </div>

                    {{-- BARIS 4: FOTO --}}
                    <div class="col-12 mb-4 text-center">
                        <label class="form-label-loop d-block text-start">Foto Produk Saat Ini</label>
                        <div class="position-relative d-inline-block mt-2 mb-3">
                            <img src="{{ asset('images/'.$barang->gambar) }}" width="120" class="img-preview-edit shadow-sm">
                        </div>
                        <input type="file" name="gambar" class="form-control form-control-loop">
                        <small class="text-muted d-block mt-2 italic">*Kosongkan jika tidak ingin ganti foto</small>
                    </div>
                </div>

                <div class="d-grid gap-3 mt-4">
                    <button type="submit" class="btn btn-save-loop shadow-sm">Simpan Perubahan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-cancel-loop shadow-sm text-center text-decoration-none">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection