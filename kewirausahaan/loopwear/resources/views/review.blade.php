@extends('layout.main')

@section('konten')

@isset($product)
<style>
    .product-detail-container { font-family: 'Quicksand', sans-serif; color: #333; }
    .product-title { color: #556B2F; font-family: 'Fredoka One', cursive; font-size: 2.5rem; }

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

    .review-ticker-box {
        background-color: #fffacf;
        border-left: 5px solid #F29C9C;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 25px;
        max-height: 120px;
        overflow-y: auto;
    }
    .review-name { font-weight: bold; color: #F29C9C; font-size: 0.85rem; }

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

    .recommendation-title { font-family: 'Fredoka One', cursive; color: #556B2F; margin-top: 50px; }
    .rec-card { border: none; transition: 0.3s; text-decoration: none; color: inherit; }
    .rec-card:hover { transform: translateY(-5px); }
    .rec-img-wrapper { aspect-ratio: 1/1; overflow: hidden; border-radius: 15px; background: #f8f9fa; border: 1px solid #dee2e6; }
    .rec-img { width: 100%; height: 100%; object-fit: cover; }
</style>

<div class="container product-detail-container" style="margin-top: 40px; margin-bottom: 60px;">

    <a href="{{ route('user.products') }}" class="btn-back">
        ← Kembali ke Koleksi
    </a>

    <div class="row align-items-start">
        <div class="col-md-5 mb-4 text-center">
            <div class="p-3 shadow-sm" style="background: #f8f9fa; border-radius: 20px;">
                <img src="{{ asset('images/' . $product->gambar) }}" alt="{{ $product->nama_barang }}" class="img-fluid rounded" style="max-height: 500px; object-fit: contain;">
            </div>
        </div>

        <div class="col-md-7 ps-md-5">
            <h1 class="product-title">{{ $product->nama_barang }}</h1>

        <p class="text-muted mb-4" style="font-size: 0.9rem;">
            @if($total_review > 0)
                {{ $rata_rating }}
                <span style="color: #F29C9C;">
                    @for($i = 1; $i <= 5; $i++)
                        {!! $i <= round($rata_rating) ? '★' : '☆' !!}
                    @endfor
                </span>
                &nbsp;|&nbsp; {{ $total_review }} Penilaian
                &nbsp;|&nbsp; {{ $total_terjual }} Terjual
            @else
                <span style="color: #ccc;">★★★★★</span>
                &nbsp;|&nbsp; 0 Penilaian &nbsp;|&nbsp; 0 Terjual
            @endif
        </p>

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

            <div class="price-box">
                Rp {{ number_format($product->harga, 0, ',', '.') }}
            </div>

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

    
    <h3 class="recommendation-title mb-4">Rekomendasi {{ ucfirst($product->kategori) }} Lainnya </h3>
    <div class="row g-4">
        @forelse($recommendations ?? [] as $rec)
            <div class="col-6 col-md-3">
                <a href="{{ route('user.products.detail', $rec->id_barang) }}" class="rec-card d-block">
                    <div class="rec-img-wrapper mb-2 shadow-sm">
                        <img src="{{ asset('images/' . $rec->gambar) }}" class="rec-img" alt="{{ $rec->nama_barang }}">
                    </div>
                    <h6 class="mb-1 fw-bold text-dark" style="font-size: 0.9rem;">{{ $rec->nama_barang }}</h6>
                    <p class="text-danger fw-bold" style="font-size: 0.85rem;">Rp {{ number_format($rec->harga, 0, ',', '.') }}</p>
                </a>
            </div>
        @empty
            <p class="text-muted ps-3">Tidak ada rekomendasi serupa saat ini.</p>
        @endforelse
    </div>
</div>

@else

<style>
    .review-page { min-height: 80vh; }
    .star-display { color: #f5c518; font-size: 1.2rem; letter-spacing: 2px; }
    .review-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 18px rgba(0,0,0,0.07);
        transition: transform 0.2s ease;
    }
    .review-card:hover { transform: translateY(-4px); }
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #E7998B, #fff24d);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }
    .review-header-section {
        background: linear-gradient(135deg, #fff24d 0%, #ffe88a 100%);
        padding: 60px 0 40px;
        text-align: center;
    }
    .review-header-section h1 {
        font-family: 'Fredoka One', cursive;
        color: #E7998B;
        font-size: 2.8rem;
    }
</style>

<div class="review-header-section">
    <h1>❤️ Ulasan Pelanggan</h1>
    <p class="text-muted fw-bold" style="font-size: 1.1rem;">Apa kata mereka tentang LoopWear?</p>
</div>

<div class="container review-page py-5">

    @if(session('success_review'))
        <div class="alert alert-success rounded-3 mb-4">{{ session('success_review') }}</div>
    @endif

    @if($reviews->isEmpty())
        <div class="text-center py-5">
            <h4 class="text-muted">Belum ada ulasan.</h4>
            <p class="text-muted">Jadilah yang pertama memberikan ulasan setelah berbelanja!</p>
            <a href="/products" class="btn btn-warning rounded-pill px-4 fw-bold mt-2">Mulai Belanja</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($reviews as $review)
            <div class="col-md-6 col-lg-4">
                <div class="card review-card h-100 p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="avatar">
                            {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $review->user->name ?? 'Anonim' }}</h6>
                            <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                        </div>
                    </div>

                    <div class="star-display mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating) ★ @else ☆ @endif
                        @endfor
                        <small class="text-muted ms-1" style="font-size: 0.8rem;">{{ $review->rating }}/5</small>
                    </div>

                    <p class="mb-0" style="color: #555; font-size: 0.95rem; line-height: 1.6;">
                        {{ $review->komentar ?? 'Pelanggan ini tidak meninggalkan komentar.' }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

@endisset

@endsection