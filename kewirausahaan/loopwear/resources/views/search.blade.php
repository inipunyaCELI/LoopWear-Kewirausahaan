@extends('layout.main')

@section('konten')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap');

    .search-page { font-family: 'Quicksand', sans-serif; color: #333; }

    /* ── Hero bar ── */
    .search-hero {
        background: #fff9db; /* Light pastel yellow matching main theme */
        padding: 48px 0 40px;
        text-align: center;
    }

    .search-hero-title {
        font-family: 'Fredoka One', cursive;
        color: #E7998B; /* Pink title */
        font-size: 2.2rem;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .search-hero-sub {
        color: #666;
        font-size: 0.88rem;
        margin-bottom: 28px;
    }

    .search-bar-hero {
        display: flex;
        max-width: 560px;
        margin: 0 auto;
        background: #fff;
        border: 2px solid #E7998B; /* Pink border */
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(231, 153, 139, 0.15); /* Soft pink shadow */
    }

    .search-bar-hero input {
        flex: 1;
        border: none;
        outline: none;
        padding: 15px 24px;
        font-family: 'Quicksand', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: #333;
        background: transparent;
    }

    .search-bar-hero button {
        background: #E7998B;
        color: #fff;
        border: none;
        padding: 0 28px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        align-items: center;
    }

    .search-bar-hero button:hover { background: #d4857a; }

    /* ── Result info bar ── */
    .result-info-bar {
        background: #fafafa;
        border-bottom: 1px solid #eee;
        padding: 14px 0;
    }

    .result-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff24d;
        color: #47510B;
        font-weight: 800;
        font-size: 0.82rem;
        border-radius: 50px;
        padding: 4px 14px;
    }

    /* ── Product Card ── */
    .product-img-wrapper {
        max-width: 220px;
        aspect-ratio: 1 / 1;
        margin: 0 auto 14px auto;
        background-color: #f8f9fa;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: box-shadow 0.3s;
    }

    .product-img-wrapper:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.35s ease;
    }

    .product-img-wrapper:hover .product-img { transform: scale(1.06); }

    .product-name {
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #47510B;
        letter-spacing: 0.3px;
    }

    .product-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 8px;
        flex-wrap: wrap;
    }

    .product-meta .price { font-weight: 700; color: #47510B; font-size: 0.92rem; }
    .product-meta .divider { color: #ddd; }

    .btn-icon-loop {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: 1.2rem;
        transition: transform 0.2s;
        display: flex;
        align-items: center;
        line-height: 1;
    }

    .btn-icon-loop:hover { transform: scale(1.2); }

    /* ── Highlight matched text ── */
    .product-badge {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 2px 10px;
        border-radius: 50px;
        margin-bottom: 6px;
        letter-spacing: 0.3px;
    }

    .badge-kategori { background: #e8f3e8; color: #47510B; }
    .badge-warna    { background: #fde8e5; color: #c0564a; }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        font-size: 4.5rem;
        margin-bottom: 20px;
        opacity: 0.6;
    }

    .empty-title {
        font-family: 'Fredoka One', cursive;
        font-size: 1.6rem;
        color: #E7998B;
        margin-bottom: 10px;
    }

    .empty-sub {
        color: #888;
        font-size: 0.9rem;
        max-width: 400px;
        margin: 0 auto 28px;
        line-height: 1.6;
    }

    .suggestions {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .suggestion-chip {
        background: #f0f0f0;
        color: #47510B;
        font-weight: 700;
        font-size: 0.82rem;
        border-radius: 50px;
        padding: 7px 20px;
        text-decoration: none;
        transition: 0.2s;
    }

    .suggestion-chip:hover { background: #47510B; color: #fff24d; }
</style>

{{-- ── Hero ── --}}
<div class="search-hero">
    <h1 class="search-hero-title">Hasil Pencarian</h1>
    <p class="search-hero-sub">
        @if($items->count() > 0)
            Ditemukan <strong style="color:#47510B;">{{ $items->count() }}</strong> produk untuk "{{ $query }}"
        @else
            Tidak ada produk yang cocok untuk "{{ $query }}"
        @endif
    </p>

    {{-- Search again bar --}}
    <form action="{{ route('search') }}" method="GET" class="px-3">
        <div class="search-bar-hero">
            <input
                type="text"
                name="q"
                value="{{ $query }}"
                placeholder="Cari nama, kategori, atau warna..."
                autocomplete="off"
                required
            >
            <button type="submit" title="Cari">🔍</button>
        </div>
    </form>
</div>

{{-- ── Result Info Bar ── --}}
<div class="result-info-bar">
    <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <span class="result-count-badge">{{ $items->count() }} produk</span>
            <span style="font-size: 0.85rem; color: #666;">
                untuk kata kunci <strong>"{{ $query }}"</strong>
            </span>
        </div>
        <a href="{{ route('user.products') }}" style="font-size:0.82rem; color:#47510B; font-weight:700; text-decoration:none;">
            ← Lihat Semua Produk
        </a>
    </div>
</div>

{{-- ── Main Content ── --}}
<div class="container search-page py-5">

    @if($items->count() > 0)

        <div class="row g-4 justify-content-center">
            @foreach($items as $item)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="text-center">

                    {{-- Badges: Kategori & Warna --}}
                    <div class="mb-1" style="min-height: 26px;">
                        @if($item->kategori)
                            <span class="product-badge badge-kategori">{{ ucfirst($item->kategori) }}</span>
                        @endif
                        @if($item->warna)
                            <span class="product-badge badge-warna">{{ ucfirst($item->warna) }}</span>
                        @endif
                    </div>

                    {{-- Gambar + Link ke Detail --}}
                    <a href="{{ route('user.products.detail', $item->id_barang) }}" class="text-decoration-none">
                        <div class="product-img-wrapper shadow-sm">
                            <img
                                src="{{ asset('images/' . $item->gambar) }}"
                                class="product-img"
                                alt="{{ $item->nama_barang }}"
                                onerror="this.src='{{ asset('images/no-image.png') }}'"
                            >
                        </div>
                        <h6 class="product-name">{{ $item->nama_barang }}</h6>
                    </a>

                    {{-- Harga & Aksi --}}
                    <div class="product-meta">
                        <span class="price">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                        <span class="divider">|</span>

                        <form action="{{ route('wishlist.add', $item->id_barang) }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="btn-icon-loop" title="Simpan ke Wishlist" style="color:#E7998B;">♥</button>
                        </form>

                        <form action="{{ route('cart.add', $item->id_barang) }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="btn-icon-loop" title="Tambah ke Keranjang" style="color:#8CABFF;">🛒</button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

    @else

        {{-- ── Empty State ── --}}
        <div class="empty-state">
            <div class="empty-icon">🔍</div>
            <h2 class="empty-title">Produk Tidak Ditemukan</h2>
            <p class="empty-sub">
                Kami tidak menemukan produk yang cocok dengan "<strong>{{ $query }}</strong>".
                Coba kata kunci lain, atau jelajahi kategori di bawah ini.
            </p>
            <div class="suggestions">
                <a href="{{ route('search') }}?q=hijab"  class="suggestion-chip">Hijab</a>
                <a href="{{ route('search') }}?q=baju"   class="suggestion-chip">Baju</a>
                <a href="{{ route('search') }}?q=celana" class="suggestion-chip">Celana</a>
                <a href="{{ route('search') }}?q=sepatu" class="suggestion-chip">Sepatu</a>
                <a href="{{ route('search') }}?q=hitam"  class="suggestion-chip">Hitam</a>
                <a href="{{ route('search') }}?q=putih"  class="suggestion-chip">Putih</a>
                <a href="{{ route('search') }}?q=merah"  class="suggestion-chip">Merah</a>
            </div>
            <div class="mt-4">
                <a href="{{ route('user.products') }}" class="btn-back"
                   style="display:inline-block; background:#47510B; color:#fff24d; font-weight:700; border-radius:50px; padding:10px 32px; text-decoration:none; font-size:0.9rem; transition:0.2s;"
                   onmouseover="this.style.background='#E7998B';this.style.color='#fff';"
                   onmouseout="this.style.background='#47510B';this.style.color='#fff24d';">
                    Lihat Semua Produk →
                </a>
            </div>
        </div>

    @endif

</div>

@endsection
