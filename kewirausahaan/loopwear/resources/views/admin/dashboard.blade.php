@extends('layout.main')
@section('konten')
<div class="container mt-5">
    <h2 class="mb-4" style="font-family: 'Fredoka One'; color: #FFB6A9;">LOOPWEAR OVERVIEW</h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0" style="background-color: #FFF24D; border-radius: 20px;">
                <div class="card-body p-4 text-center">
                    <h5 class="text-muted">Total Koleksi</h5>
                    <h1 class="display-4 fw-bold">{{ $totalBarang }}</h1>
                    <p class="mb-0">Produk Terdaftar</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0" style="background-color: #8CABFF; border-radius: 20px; color: white;">
                <div class="card-body p-4 text-center">
                    <h5 class="text-white-50">Stok Ready</h5>
                    <h1 class="display-4 fw-bold">{{ $barangTersedia }}</h1>
                    <p class="mb-0">Siap Jual</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0" style="background-color: #FFB6A9; border-radius: 20px; color: white;">
                <div class="card-body p-4 text-center">
                    <h5 class="text-white-50">Pelanggan</h5>
                    <h1 class="display-4 fw-bold">{{ $totalUser }}</h1>
                    <p class="mb-0">User Terdaftar</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 p-4 bg-light rounded-4 border">
        <h4>Selamat Datang, Admin!</h4>
        <p>Gunakan menu di samping untuk mengelola stok barang, melihat pesanan masuk, atau memantau pembayaran otomatis Midtrans.</p>
        <a href="/barang" class="btn btn-dark rounded-pill px-4">Kelola Stok Barang Sekarang</a>
    </div>
</div>
@endsection