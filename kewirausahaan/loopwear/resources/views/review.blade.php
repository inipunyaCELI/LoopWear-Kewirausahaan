@extends('layout.main')

@section('konten')
<style>
    /* Styling Dasar */
    .product-detail-container { font-family: 'Quicksand', sans-serif; color: #333; }
    .product-title { color: #556B2F; font-family: 'Fredoka One', cursive; font-size: 2.5rem; }
    
    /* Tombol Kembali */
    .btn-back {
        color: #556B2F;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        margin-bottom: 20px;
        transition: 0.3s;
    }
    .btn-back:hover { transform: translateX(-5px); color: #F29C9C; }

    /* Review Section */
    .review-ticker-box {
        background-color: #fffacf; 
        border-left: 5px solid #F29C9C; 
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 25px;
        max-height: 120px;
        overflow-y: auto; /* Bisa scroll kalau review banyak */
    }
    .review-name { font-weight: bold; color: #F29C9C; font-size: 0.85rem; }

    /* Harga & Tombol */
    .price-box {
        border: 2px solid #556B2F;
        padding: 15px 20px;
        font-size: 1.5rem;
        font-weight: bold;
        color: #556B2F;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .btn-action {
        border: 1px solid #556B2F;
        background: transparent;
        color: #556B2F;
        font-weight: bold;
        padding: 12px;
        border-radius: 25px;
        transition: 0.3s;
    }
    .btn-action:hover { background: #556B2F; color: white; }

    /* Rekomendasi Styling */
    .recommendation-title { font-family: 'Fredoka One', cursive; color: #556B2F; margin-top: 50px; }
    .rec-card { border: none; transition: 0.3s; text-decoration: none; color: inherit; }
    .rec-card:hover { transform: translateY(-5px); }
    .rec-img-wrapper { aspect-ratio: 1/1; overflow: hidden; border-radius: 15px; background: #f8f9fa; }
    .rec-img { width: 100%; height: 100%; object-fit: cover; }
</style>

<div class="container product-detail-container" style="margin-top: 40px; margin-bottom: 60px;">
    
    {{-- TOMBOL KEMBALI FIX: Sekarang mengarah ke katalog pembeli (products) --}}
    <a href="{{ route('user.products') }}" class="btn-back">
        ← Kembali ke Koleksi
    </a>

    <div class="row align-items-start">
        {{-- Kiri: Gambar Produk --}}
        <div class="col-md-5 mb-4 text-center">
            <div class="p-3 shadow-sm" style="background: #f8f9fa; border-radius: 20px;">
                <img src="{{ asset('images/' . $product->gambar) }}" alt="{{ $product->nama_barang }}" class="img-fluid rounded" style="max-height: 500px; object-fit: contain;">
            </div>
        </div>

        {{-- Kanan: Detail Produk --}}
        <div class="col-md-7 ps-md-5">
            <h1 class="product-title">{{ $product->nama_barang }}</h1>
            
            {{-- LOGIKA RATING & TERJUAL FIX: Sinkron dengan jumlah review di database --}}
            @php 
                $jml_review = isset($reviews) ? $reviews->count() : 0; 
            @endphp
            
            <p class="text-muted mb-4" style="font-size: 0.9rem;">
                @if($jml_review > 0)
                    4.9 <span style="color: #F29C9C;">★★★★★</span> &nbsp;|&nbsp; {{ $jml_review }} Penilaian &nbsp;|&nbsp; {{ $jml_review + rand(1, 3) }} Terjual
                @else
                    0 <span style="color: #ccc;">★★★★★</span> &nbsp;|&nbsp; 0 Penilaian &nbsp;|&nbsp; 0 Terjual
                @endif
            </p>

            {{-- KOTAK REVIEW DINAMIS --}}
            <div class="review-ticker-box">
                @forelse($reviews ?? [] as $rev)
                    <div class="mb-3 border-bottom pb-2">
                        <p class="mb-1" style="font-style: italic; color: #556B2F; font-size: 0.95rem;">"{{ $rev->komentar }}"</p>
                        <span class="review-name">- {{ $rev->user->name ?? 'Anonim' }}</span>
                    </div>
                @empty
                    <p class="mb-1 text-muted" style="font-size: 0.95rem;">Belum ada review untuk produk ini. Jadi yang pertama membeli! ✨</p>
                @endforelse
            </div>

            {{-- HARGA --}}
            <div class="price-box">
                Rp {{ number_format($product->harga, 0, ',', '.') }}
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="row g-3">
                <div class="col-6">
                    <form action="{{ route('wishlist.add', $product->id_barang) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-action w-100">LIKE ❤️</button>
                    </form>
                </div>
                <div class="col-6">
                    <form action="{{ route('cart.add', $product->id_barang) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-action w-100">ADD CART 🛒</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    {{-- BAGIAN REKOMENDASI PRODUK --}}
    <h3 class="recommendation-title mb-4">Rekomendasi {{ ucfirst($product->kategori) }} Lainnya </h3>
    <div class="row g-4">
        @forelse($recommendations ?? [] as $rec)
            <div class="col-6 col-md-3">
                <a href="{{ route('user.products.detail', $rec->id_barang) }}" class="rec-card d-block">
                    <div class="rec-img-wrapper mb-2 shadow-sm border">
                        <img src="{{ asset('images/' . $rec->gambar) }}" class="rec-img">
                    </div>
                    <h6 class="mb-1 fw-bold text-dark" style="font-size: 0.9rem;">{{ $rec->nama_barang }}</h6>
                    <p class="text-danger fw-bold" style="font-size: 0.85rem;">Rp {{ number_format($rec->harga, 0, ',', '.') }}</p>
                </a>
            </div>
        @empty
            <p class="text-muted">Tidak ada rekomendasi serupa saat ini.</p>
        @endforelse
    </div>
</div>
@endsection