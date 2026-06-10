@extends('layout.main')

@section('konten')
<style>
    body { background-color: #f8f9fa; }
    .checkout-page { font-family: 'Quicksand', sans-serif; color: #333; padding-bottom: 50px; }

    .btn-back {
        color: #556B2F;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        margin-bottom: 20px;
        transition: 0.3s;
    }
    .btn-back:hover { transform: translateX(-5px); color: #E7998B; }

    .checkout-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 20px;
        padding: 25px 30px;
    }
    .address-card { border-top: 5px solid #E7998B; }

    .section-title {
        font-family: 'Fredoka One', cursive;
        color: #556B2F;
        font-size: 1.3rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title.pink { color: #E7998B; }

    .form-loop {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px 15px;
        width: 100%;
        transition: 0.3s;
        font-family: 'Quicksand', sans-serif;
    }
    .form-loop:focus { border-color: #556B2F; outline: none; box-shadow: 0 0 0 3px rgba(85,107,47,0.1); }

    .table-produk { width: 100%; border-collapse: collapse; }
    .table-produk th { color: #888; font-weight: 600; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    .table-produk td { padding: 20px 0; border-bottom: 1px dashed #eee; vertical-align: middle; }

    .summary-text { color: #777; font-size: 0.95rem; }
    .summary-total { font-size: 1.8rem; font-weight: bold; color: #E7998B; }

    .btn-pesanan {
        background: #47510B;
        color: #fff24d;
        font-family: 'Quicksand', sans-serif;
        font-weight: bold;
        padding: 12px 45px;
        border-radius: 8px;
        border: none;
        font-size: 1.1rem;
        transition: 0.3s;
        cursor: pointer;
    }
    .btn-pesanan:hover { background: #363d08; }

    
    .voucher-box {
        background: #fffde8;
        border: 1.5px solid #c8d08a;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 16px;
    }
    .voucher-aktif-box {
        background: #f6ffe8;
        border: 1.5px solid #47510B;
        border-radius: 10px;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .voucher-input {
        border: 1.5px solid #47510B;
        border-radius: 8px;
        padding: 8px 14px;
        font-family: 'Quicksand', sans-serif;
        font-size: 0.9rem;
        outline: none;
        flex: 1;
        transition: 0.2s;
    }
    .voucher-input:focus { box-shadow: 0 0 0 3px rgba(71,81,11,0.1); }
    .btn-voucher {
        background: #47510B;
        color: #fff24d;
        border: none;
        border-radius: 8px;
        padding: 8px 18px;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
        white-space: nowrap;
    }
    .btn-voucher:hover { background: #363d08; }

    .diskon-row { color: #47510B; font-weight: 700; }
    .coret { text-decoration: line-through; color: #aaa; font-size: 0.85rem; }
</style>

<div class="container checkout-page pt-4">

    <a href="{{ route('cart.index') }}" class="btn-back">&larr; Kembali ke Keranjang</a>

    <form id="formCheckout" action="{{ route('checkout.store') }}" method="POST">
        @csrf
        @foreach($selected as $id)
            <input type="hidden" name="selected[]" value="{{ $id }}">
        @endforeach

        <div class="checkout-card address-card">
            <div class="section-title pink">📍 Alamat Pengiriman</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="nama" class="form-loop" placeholder="Nama Lengkap Penerima"
                           value="{{ auth()->check() ? auth()->user()->name : '' }}"
                           required readonly style="background-color:#f4f4f2; cursor:not-allowed;">
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-loop" placeholder="Email"
                           value="{{ auth()->check() ? auth()->user()->email : '' }}"
                           required readonly style="background-color:#f4f4f2; cursor:not-allowed;">
                </div>
                <div class="col-md-12">
                    <input type="text" name="no_hp" class="form-loop" placeholder="Nomor Handphone"
                           value="{{ auth()->check() ? auth()->user()->phone : '' }}" required>
                </div>
                <div class="col-12">
                    <textarea name="alamat" class="form-loop" rows="3"
                              placeholder="Alamat Lengkap (Nama Jalan, RT/RW, Kec., Kota, Kode Pos)"
                              required>@if(auth()->check() && auth()->user()->address){{ auth()->user()->address }}, {{ auth()->user()->city }} {{ auth()->user()->postal_code }}@endif</textarea>
                </div>
            </div>
            @if(auth()->check() && empty(auth()->user()->address))
                <small class="text-danger mt-2 d-block fw-bold">
                    ⚠️ Alamat kamu di profil masih kosong, langsung isi lengkap di dalam kotak textarea atas ya!
                </small>
            @endif
        </div>

        <div class="checkout-card">
            <div class="section-title">🛍️ Produk Dipesan</div>
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
                                <div style="width:50px; height:50px; background:#eee; border-radius:8px; overflow:hidden;">
                                    <img src="{{ asset('images/' . ($item['gambar'] ?? 'no-image.png')) }}"
                                         style="width:100%; height:100%; object-fit:cover;" alt="Gambar Produk">
                                </div>
                                <span class="fw-bold text-dark">{{ $item['nama'] }}</span>
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
                        <input type="text" name="pesan" class="form-loop" style="padding:8px 15px;" placeholder="(Opsional) Tinggalkan pesan...">
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <span class="text-muted me-3">Opsi Pengiriman:</span>
                    @if($gratis_ongkir)
                        <span class="coret">Rp 10.000</span>
                        <span class="fw-bold ms-1" style="color:#47510B;">Reguler (GRATIS 🎉)</span>
                    @else
                        <span class="fw-bold" style="color:#556B2F;">Reguler (Rp 10.000)</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="checkout-card">
            <div class="row justify-content-end">
                <div class="col-md-6 col-lg-5">

                    @if($voucher)
                        <div class="voucher-aktif-box">
                            <span class="fw-bold" style="color:#47510B; font-size:0.9rem;">
                                🏷️ <strong>{{ $voucher['kode'] }}</strong>
                                @if($voucher['tipe'] == 'persen')
                                    — diskon {{ $voucher['nilai'] }}%
                                @elseif($voucher['tipe'] == 'nominal')
                                    — potongan Rp {{ number_format($voucher['nilai'], 0, ',', '.') }}
                                @elseif($voucher['tipe'] == 'gratis_ongkir')
                                    — gratis ongkir
                                @endif
                            </span>
                            <a href="{{ route('cart.voucher.remove') }}" class="text-danger small fw-bold text-decoration-none ms-3">✕ Hapus</a>
                        </div>
                    @else
                        <div class="voucher-box">
                            <p class="mb-2 fw-bold" style="color:#47510B; font-size:0.85rem;">🏷️ Punya kode voucher?</p>
                            
                            <div class="d-flex gap-2">
                                <input type="text" name="kode" form="formVoucher" placeholder="Masukkan kode voucher"
                                    class="voucher-input" value="{{ old('kode') }}">
                                <button type="submit" form="formVoucher" class="btn-voucher">Pakai</button>
                            </div>                            
                            @if(session('voucher_error'))
                                <p class="text-danger small mt-2 mb-0 fw-bold">⚠️ {{ session('voucher_error') }}</p>
                            @endif
                        </div>
                    @endif

                    
                    <div class="d-flex justify-content-between mb-2 summary-text">
                        <span>Subtotal Produk</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    @if($diskon > 0)
                    <div class="d-flex justify-content-between mb-2 diskon-row">
                        <span>🏷️ Diskon Voucher</span>
                        <span>- Rp {{ number_format($diskon, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between mb-2 summary-text">
                        <span>Ongkos Kirim</span>
                        @if($gratis_ongkir)
                            <span><span class="coret">Rp 10.000</span> <span style="color:#47510B; font-weight:700;">GRATIS</span></span>
                        @else
                            <span>Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mb-3 summary-text">
                        <span>Biaya Layanan</span>
                        <span>Rp {{ number_format($biaya_layanan, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-top my-3"></div>

                    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                        <span class="summary-text fs-5" style="color:#333;">Total Pembayaran</span>
                        <span class="summary-total">Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn-pesanan w-100">Buat Pesanan</button>
                </div>
            </div>
        </div>

    </form>
</div>

@if(!$voucher)
<form id="formVoucher" action="{{ route('checkout.voucher') }}" method="POST" style="display: none;">
    @csrf
    @foreach($selected as $id)
        <input type="hidden" name="selected[]" value="{{ $id }}">
    @endforeach
</form>
@endif

@endsection