@extends('layout.main')

@section('konten')
<style>
    .overview-title {
        font-family: 'Fredoka One', cursive;
        color: #E7998B;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .card-overview {
        border-radius: 25px;
        transition: transform 0.3s ease;
        border: none;
    }
    .card-overview:hover {
        transform: translateY(-5px);
    }

    .stat-number {
        font-family: 'Quicksand', sans-serif;
        font-weight: 800;
        font-size: 3.5rem;
    }

    .stat-label {
        font-weight: 700;
        opacity: 0.8;
        text-transform: lowercase;
    }

    .welcome-box {
        background-color: #ffffff;
        border: 2px solid #f0f0f0;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .welcome-title {
        font-family: 'Fredoka One', cursive;
        color: #47510B;
    }

    .btn-loop {
        background-color: #47510B !important;
        color: #fff24d !important;
        font-weight: 800;
        border: none;
        padding: 12px 30px;
        border-radius: 15px;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
        width: auto !important;
    }
    .btn-loop:hover {
        background-color: #363d08 !important;
        transform: scale(1.05);
        color: #fff24d !important;
    }
</style>

<div class="container py-5">
    <h2 class="overview-title mb-5 text-center text-md-start">LOOPWEAR OVERVIEW</h2>
    
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card card-overview shadow-sm" style="background-color: #FFF24D; color: #47510B;">
                <div class="card-body p-4 text-center">
                    <h5 class="stat-label">total koleksi</h5>
                    <h1 class="stat-number my-2">{{ $totalBarang }}</h1>
                    <p class="mb-0 fw-bold small">produk terdaftar</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-overview shadow-sm" style="background-color: #8CABFF; color: white;">
                <div class="card-body p-4 text-center">
                    <h5 class="stat-label" style="color: rgba(255,255,255,0.8);">stok ready</h5>
                    <h1 class="stat-number my-2">{{ $barangTersedia }}</h1>
                    <p class="mb-0 fw-bold small">siap jual</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-overview shadow-sm" style="background-color: #E7998B; color: white;">
                <div class="card-body p-4 text-center">
                    <h5 class="stat-label" style="color: rgba(255,255,255,0.8);">pelanggan</h5>
                    <h1 class="stat-number my-2">{{ $totalUser }}</h1>
                    <p class="mb-0 fw-bold small">user terdaftar</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <a href="{{ route('admin.vouchers.index') }}" class="text-decoration-none">
                <div class="card card-overview shadow-sm" style="background-color: #47510B; color: #fff24d;">
                    <div class="card-body p-4 text-center">
                        <h5 class="stat-label" style="color: rgba(255,244,77,0.8);">voucher aktif</h5>
                        <h1 class="stat-number my-2">{{ $totalVoucher }}</h1>
                        <p class="mb-0 fw-bold small">voucher tersedia</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="mt-5 welcome-box border-0 shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="welcome-title mb-3">Selamat Datang, Admin!</h3>
                <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.6;">
                    Gunakan menu navigasi untuk mengelola stok barang terbaru, memantau pesanan yang masuk,
                    atau mengecek status pembayaran otomatis melalui sistem Midtrans.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/barang" class="btn btn-loop shadow-sm">
                        Kelola Stok Barang
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-loop shadow-sm">
                        Lihat Daftar Pesanan
                    </a>
                    <a href="{{ route('admin.vouchers.index') }}" class="btn btn-loop shadow-sm">
                        🏷️ Kelola Voucher
                    </a>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-block text-center">
                <div style="font-size: 5rem;">📦</div>
            </div>
        </div>
    </div>
</div>
@endsection