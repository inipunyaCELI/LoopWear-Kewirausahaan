@extends('layout.main')

@section('konten')
<style>
    /* Background halaman dibuat abu-abu agar kotak checkout menonjol ala Shopee */
    body { background-color: #f8f9fa; }
    .checkout-page { font-family: 'Quicksand', sans-serif; color: #333; padding-bottom: 50px; }

    /* Tombol Kembali */
    .btn-back {
        color: #556B2F; /* Grassy Green */
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        margin-bottom: 20px;
        transition: 0.3s;
    }
    .btn-back:hover { transform: translateX(-5px); color: #E7998B; }

    /* Card Section ala Shopee */
    .checkout-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 20px;
        padding: 25px 30px;
    }

    /* Garis atas ala amplop surat */
    .address-card { border-top: 5px solid #E7998B; }

    /* Header tiap kotak */
    .section-title { font-family: 'Fredoka One', cursive; color: #556B2F; font-size: 1.3rem; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .section-title.pink { color: #E7998B; }

    /* Input Form Custom */
    .form-loop { border: 1px solid #ddd; border-radius: 8px; padding: 12px 15px; width: 100%; transition: 0.3s; font-family: 'Quicksand', sans-serif; }
    .form-loop:focus { border-color: #556B2F; outline: none; box-shadow: 0 0 0 3px rgba(85, 107, 47, 0.1); }

    /* Tabel Produk */
    .table-produk { width: 100%; border-collapse: collapse; }
    .table-produk th { color: #888; font-weight: 600; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    .table-produk td { padding: 20px 0; border-bottom: 1px dashed #eee; vertical-align: middle; }

    /* Ringkasan Pembayaran */
    .summary-text { color: #777; font-size: 0.95rem; }
    .summary-total { font-size: 1.8rem; font-weight: bold; color: #E7998B; }
    .btn-pesanan { background: #E7998B; color: #fff; font-family: 'Quicksand', sans-serif; font-weight: bold; padding: 12px 45px; border-radius: 8px; border: none; font-size: 1.1rem; transition: 0.3s; }
    .btn-pesanan:hover { background: #d68779; color: #fff; }
</style>

<div class="container checkout-page pt-4">
    
    <a href="{{ route('cart.index') }}" class="btn-back">← Kembali ke Keranjang</a>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        @foreach($selected as $id)
            <input type="hidden" name="selected[]" value="{{ $id }}">
        @endforeach

        {{-- BAGIAN 1: ALAMAT --}}
        <div class="checkout-card address-card">
            <div class="section-title pink">📍 Alamat Pengiriman</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="nama" class="form-loop" placeholder="Nama Lengkap Penerima" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-loop" placeholder="Email / No. Handphone" value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                </div>
                <div class="col-12">
                    <textarea name="alamat" class="form-loop" rows="3" placeholder="Alamat Lengkap (Nama Jalan, RT/RW, Kec., Kota, Kode Pos)" required>{{ auth()->check() ? auth()->user()->alamat ?? '' : '' }}</textarea>
                </div>
            </div>
        </div>

        {{-- BAGIAN 2: PRODUK --}}
        <div class="checkout-card">
            <div class="section-title">Produk Dipesan</div>
            <table class="table-produk">
                <thead>
                    <tr>
                        <th class="text-start">Produk</th>
                        <th class="text-center">Harga Satuan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Subtotal Produk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checkout_items as $id => $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 50px; height: 50px; background: #eee; border-radius: 8px; overflow: hidden;">
                                    <img src="{{ asset('images/' . ($item['gambar'] ?? 'no-image.png')) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div><span class="fw-bold text-dark d-block">{{ $item['nama'] }}</span></div>
                            </div>
                        </td>
                        <td class="text-center text-muted">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td class="text-center">{{ $item['qty'] }}</td>
                        <td class="text-end fw-bold text-dark">Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="row mt-4 align-items-center border-top pt-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fw-bold">Pesan:</span>
                        <input type="text" name="pesan" class="form-loop" style="padding: 8px 15px;" placeholder="(Opsional) Tinggalkan pesan...">
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <span class="text-muted me-3">Opsi Pengiriman:</span>
                    <span class="fw-bold" style="color: #556B2F;">Reguler (Rp 10.000)</span>
                </div>
            </div>
        </div>

        {{-- BAGIAN 3: RINCIAN TOTAL PEMBAYARAN --}}
        <div class="checkout-card">
            <div class="row justify-content-end text-end">
                <div class="col-md-5 col-lg-4">
                    <div class="d-flex justify-content-between mb-2 summary-text">
                        <span>Subtotal untuk Produk</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 summary-text">
                        <span>Total Ongkos Kirim</span>
                        <span>Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 summary-text">
                        <span>Biaya Layanan</span>
                        <span>Rp {{ number_format($biaya_layanan, 0, ',', '.') }}</span>
                    </div>
                    
                    {{-- Garis Pemisah --}}
                    <div class="border-top my-3"></div>

                    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                        <span class="summary-text fs-5" style="color: #333;">Total Pembayaran</span>
                        <span class="summary-total">Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                    </div>
                    <button type="submit" class="btn-pesanan w-100">Buat Pesanan</button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection