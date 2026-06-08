@extends('layout.main')

@section('konten')
<style>
    .add-container { font-family: 'Quicksand', sans-serif; }
    .add-title { font-family: 'Fredoka One', cursive; color: #47510B; letter-spacing: 1px; }
    
    .custom-card-add { 
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

    .btn-save-loop { 
        background-color: #47510B !important;
        color: #FFF24D !important;
        border-radius: 15px; 
        font-weight: 800; 
        padding: 12px 30px;
        border: none; 
        transition: 0.3s; 
    }
    .btn-save-loop:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(71, 81, 11, 0.2); }

    .btn-cancel-loop { 
        background-color: #8CABFF !important;
        color: white !important; 
        border-radius: 15px; 
        font-weight: 800; 
        padding: 12px 30px;
        border: none; 
        transition: 0.3s; 
        text-decoration: none;
    }
    .btn-cancel-loop:hover { opacity: 0.9; transform: translateY(-2px); color: white; }
</style>

<div class="container py-5 add-container">
    <div class="card shadow-sm col-md-8 mx-auto custom-card-add">
        <div class="card-header-loop text-center">
            <h4 class="add-title mb-0">TAMBAH KOLEKSI BARU</h4>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-4">
                        <label class="form-label-loop">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control form-control-loop" placeholder="Contoh: Cute Lilac Cardigan" value="{{ old('nama_barang') }}" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Kategori</label>
                        <select name="kategori" class="form-select form-control-loop" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="baju" @selected(old('kategori') == 'baju')>Baju</option>
                            <option value="celana" @selected(old('kategori') == 'celana')>Celana</option>
                            <option value="hijab" @selected(old('kategori') == 'hijab')>Hijab</option>
                            <option value="sepatu" @selected(old('kategori') == 'sepatu')>Sepatu</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Warna Utama</label>
                        <select name="warna" class="form-select form-control-loop" required>
                            <option value="">-- Pilih Warna --</option>
                            <option value="black" @selected(old('warna') == 'black')>Black</option>
                            <option value="green" @selected(old('warna') == 'green')>Green</option>
                            <option value="blue" @selected(old('warna') == 'blue')>Blue</option>
                            <option value="brown" @selected(old('warna') == 'brown')>Brown</option>
                            <option value="gray" @selected(old('warna') == 'gray')>Gray</option>
                            <option value="orange" @selected(old('warna') == 'orange')>Orange</option>
                            <option value="pink" @selected(old('warna') == 'pink')>Pink</option>
                            <option value="purple" @selected(old('warna') == 'purple')>Purple</option>
                            <option value="red" @selected(old('warna') == 'red')>Red</option>
                            <option value="silver" @selected(old('warna') == 'silver')>Silver</option>
                            <option value="White" @selected(old('warna') == 'White')>White</option>
                            <option value="yellow" @selected(old('warna') == 'yellow')>Yellow</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control form-control-loop" placeholder="0" min="0" value="{{ old('harga') }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Stok Ready</label>
                        <input type="number" name="stok" class="form-control form-control-loop" min="0" value="{{ old('stok', 1) }}" required>
                    </div>

                    <div class="col-12 mb-5">
                        <label class="form-label-loop">Foto Produk</label>
                        <input type="file" name="gambar" class="form-control form-control-loop" accept=".jpg,.jpeg,.png" required>
                        <small class="text-muted d-block mt-2">*Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('barang.index') }}" class="btn-cancel-loop">Batal</a>
                    <button type="submit" class="btn-save-loop">Simpan Koleksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection