@extends('layout.main')

@section('konten')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* =========================================
       0. GLOBAL STYLING
       ========================================= */
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

    body {
        font-family: 'Quicksand', sans-serif;
        color: #333;
    }

    .section-title {
        font-family: 'Fredoka One', cursive;
        color: #333;
        font-size: 1.8rem;
    }

    /* =========================================
       1. HERO SECTION STYLING
       ========================================= */
    .hero-section {
        transition: background-color 0.8s ease-in-out;
        overflow: hidden; 
    }

    #hero-title, #order-btn {
        transition: color 0.5s ease, background-color 0.5s ease;
    }

    .hero-thumbs img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: transparent;
        border: none;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.15)) grayscale(30%);
    }

    .hero-thumbs img.active {
        transform: scale(1.25) translateY(-8px);
        filter: drop-shadow(0 12px 18px rgba(0,0,0,0.3)) grayscale(0%);
    }

    .hero-right-col {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 500px;
    }

    .main-hero-img {
        z-index: 10;
        max-width: 60%; 
        max-height: 380px;
        object-fit: contain;
        transition: opacity 0.4s ease, transform 0.5s ease;
        filter: drop-shadow(0 15px 25px rgba(0,0,0,0.25));
    }

    .img-fade-in {
        animation: fadeInZoom 0.6s ease forwards;
    }

    @keyframes fadeInZoom {
        0% { opacity: 0; transform: scale(0.85); }
        100% { opacity: 1; transform: scale(1); }
    }

    .floater {
        position: absolute;
        z-index: 5;
        max-width: 65px; 
        object-fit: contain;
        transition: all 0.8s ease-in-out;
        animation: floatAnimation 3s infinite ease-in-out alternate;
        filter: drop-shadow(0 8px 12px rgba(0,0,0,0.2));
    }

    .floater-1 { top: 5%; left: 5%; animation-delay: 0s; }
    .floater-2 { bottom: 10%; left: 10%; animation-delay: 1s; }
    .floater-3 { bottom: 10%; right: 5%; animation-delay: 0.5s; }

    @keyframes floatAnimation {
        0% { transform: translateY(0px) rotate(0deg); }
        100% { transform: translateY(-15px) rotate(5deg); }
    }

    #hero-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 450px;
        height: 450px;
        z-index: 1;
        transition: background 0.8s ease;
        border-radius: 50%;
    }

    #view-menu-btn {
        background-color: transparent;
        border: 2px solid #47510B; 
        color: #47510B;
        transition: all 0.3s ease;
    }

    #view-menu-btn:hover, #view-menu-btn:active {
        background-color: #47510B; 
        color: #fffacf; 
        border-color: #47510B;
    }

    /* =========================================
       2. CAROUSEL & NEW BANNER STYLING
       ========================================= */
    .save-carousel { border-radius: 20px; overflow: hidden; border: none; margin-bottom: 50px; }
    
    .save-poster {
        background-color: #fdf5e6;
        min-height: 220px;
        display: flex;
        align-items: center;
        padding: 30px 90px; 
        transition: all 0.3s ease;
    }

    .save-poster img {
        max-height: 180px; 
        object-fit: contain;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.15));
        transition: transform 0.4s ease;
    }

    .save-poster:hover { transform: scale(1.02) rotate(-0.5deg); }
    .save-poster:hover img { transform: scale(1.08) translateY(-5px); }

    .save-text h3 { font-family: 'Fredoka One', cursive; font-weight: 800; color: #e27d60; font-size: 1.8rem; margin-bottom: 5px; text-transform: uppercase; }
    .save-text p { font-size: 0.95rem; color: #555; margin-bottom: 10px; font-weight: 600; }
    
    .carousel-control-prev, .carousel-control-next { width: 5%; opacity: 0.7; }
    .carousel-control-prev-icon, .carousel-control-next-icon { filter: invert(1); }

    .earth-edit-banner {
        background-color: #c7d159; 
        border-radius: 20px;
        padding: 50px 30px;
        text-align: center;
        color: white;
        box-shadow: 0 8px 20px rgba(199, 209, 89, 0.3);
        transition: all 0.3s ease;
    }

    .earth-edit-banner:hover { transform: translateY(-5px) rotate(1deg); }

    .earth-edit-banner h2 {
        font-family: 'Fredoka One', cursive;
        font-size: 2.2rem;
        margin-top: 10px;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    .earth-edit-banner p {
        font-weight: 600;
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.5;
    }

    /* =========================================
       3. PRODUK DINAMIS STYLING
       ========================================= */
       
    .best-seller-section {
        background-color: #e6eeb1; 
        border-radius: 25px;
        padding: 50px 20px;
    }

    .just-for-you-section {
        background-color: #ffeceb; 
        border-radius: 25px; 
        padding: 50px 20px;
        margin-bottom: 50px;
    }

    .product-grid-card-1 {
        background: #ffffff;
        border-radius: 20px; 
        padding: 12px;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 4px solid #c7d159;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .product-grid-card-1:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(199, 209, 89, 0.4);
    }

    .product-grid-card-2 {
        background: #fffafa;
        border-radius: 20px;
        padding: 12px;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 3px dashed #F29C9C; 
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .product-grid-card-2:hover {
        transform: scale(1.05) rotate(1deg); 
        border-color: #d67a7a;
        background: #fff;
    }
    
    .product-img-box {
        background-color: #f8f9fa;
        border-radius: 14px;
        padding: 20px;
        position: relative;
        text-align: center;
        margin-bottom: 15px;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .grid-img {
        height: 100%;
        max-height: 160px;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .product-grid-card-1:hover .grid-img, .product-grid-card-2:hover .grid-img {
        transform: scale(1.1);
    }

    /* Wishlist Button Styling */
    .btn-wishlist-grid {
        background: #fff;
        border: none;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        font-size: 1.1rem;
        color: #ddd;
        transition: color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        cursor: pointer;
        padding: 0;
        line-height: 1;
    }

    .btn-wishlist-grid:hover {
        color: #F29C9C;
        transform: scale(1.1);
    }

    .btn-wishlist-grid.wishlisted,
    .btn-wishlist-grid.wishlisted:hover {
        color: #e74c3c;
    }

    .product-brand {
        font-weight: 800;
        font-size: 0.85rem;
        margin-bottom: 4px;
        color: #F29C9C; 
        letter-spacing: 0.5px;
    }

    .product-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #555;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price-discount {
        color: #333;
        font-weight: 800;
        font-size: 1.15rem;
    }

    .btn-grid-action {
        width: 100%;
        background-color: #fff;
        border: 2px solid #e0e0e0;
        color: #555;
        padding: 10px;
        border-radius: 50px; 
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        margin-top: auto; 
        cursor: pointer;
    }

    .btn-grid-action:hover {
        border-color: #47510B;
        background-color: #47510B;
        color: white;
    }

    .product-grid-card-1 > form, .product-grid-card-2 > form {
        width: 100%;
        margin-top: auto;
    }

    /* Animasi Toast Notifikasi */
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeOut {
        from { opacity: 1; }
        to   { opacity: 0; transform: translateY(10px); }
    }
</style>

{{-- 1. HERO SECTION --}}
<section id="hero-section" class="hero-section" style="min-height: 100vh;">
    <div class="container pt-5">
        <div class="row align-items-center" style="min-height: 80vh;">
            
            <div class="col-md-6">
                <h1 id="hero-title" class="display-3 fw-bold mb-3" style="font-family: 'Fredoka One', cursive;">
                    Hijab LoopWear
                </h1>
                <p id="hero-desc" class="lead mb-4 text-dark" style="opacity: 0.8;">
                    Hijab premium, lembut, siap bikin outfit makin glowing.
                </p>
                <div class="d-flex gap-3 mb-5">
                    <a href="/cart" id="order-btn" class="btn rounded-pill px-4 py-2 fw-bold shadow border-0">ORDER NOW</a>
                    <a href="/category/hijab" id="view-menu-btn" class="btn rounded-pill px-4 py-2 fw-bold">VIEW PRODUCTS</a>
                </div>

                <div class="d-flex gap-4 hero-thumbs align-items-center">
                    <img src="{{ asset('images/hijab_pink.png') }}" onclick="changeHero('hijab', this)" class="active">
                    <img src="{{ asset('images/baju.png') }}" onclick="changeHero('baju', this)">
                    <img src="{{ asset('images/celana.png') }}" onclick="changeHero('celana', this)">
                    <img src="{{ asset('images/sepatu.png') }}" onclick="changeHero('sepatu', this)">
                </div>
            </div> 

            <div class="col-md-6 hero-right-col">
                <div id="hero-glow"></div>
                <img id="floater-1" src="" class="floater floater-1">
                <img id="floater-2" src="" class="floater floater-2">
                <img id="floater-3" src="" class="floater floater-3">
                <img id="hero-img" src="" class="position-relative main-hero-img" alt="Produk Utama">
            </div> 

        </div> 
    </div> 
</section>

<div id="products-start"></div>

{{-- 2. LOOP TRENDS BANNER CAROUSEL --}}
<div class="container mt-5 pt-4">
    <div id="saveCarousel" class="carousel slide save-carousel shadow-sm" data-bs-ride="carousel">
        <div class="carousel-inner">
            
            <div class="carousel-item active">
                <div class="save-poster">
                    <div class="row align-items-center w-100 m-0">
                        <div class="col-md-4 text-center">
                             <img src="{{ asset('images/sepatu.png') }}" class="img-fluid" alt="Sepatu">
                        </div>
                        <div class="col-md-5 save-text px-md-4">
                            <h3>NEW ARRIVAL: SNEAKERS SERIES</h3>
                            <p class="mb-0">Koleksi sepatu preloved original hits, rilis malam ini.</p>
                            <small class="text-muted" style="font-size: 0.75rem;">Koleksi Terbatas</small>
                        </div>
                        <div class="col-md-3 text-center mt-3 mt-md-0">
                            <a href="/category/sepatu" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold" style="font-size: 0.85rem;">BELI SEKARANG ></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="carousel-item">
                <div class="save-poster" style="background-color: #eaf4f4;">
                    <div class="row align-items-center w-100 m-0">
                        <div class="col-md-8 save-text px-md-4">
                            <h3 style="color: #47510B;">CURATED THRIFT MIX</h3>
                            <p class="mb-0">Pashmina silk dan culotte jeans terkurasi untuk OOTD harianmu.</p>
                            <small class="text-muted" style="font-size: 0.75rem;">Hemat & Aesthetic</small>
                        </div>
                        <div class="col-md-4 text-center">
                             <img src="{{ asset('images/hijab_pink.png') }}" class="img-fluid" alt="Hijab">
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="save-poster" style="background-color: #fffaf0;">
                    <div class="row align-items-center w-100 m-0">
                        <div class="col-md-4 text-center">
                             <img src="{{ asset('images/baju.png') }}" class="img-fluid" alt="Baju">
                        </div>
                        <div class="col-md-8 save-text px-md-4">
                            <h3>VINTAGE COQUETTE FINDS</h3>
                            <p class="mb-0">Kemeja pita dan cardigan gemes untuk tampilan vintage aesthetic.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#saveCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#saveCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

{{-- 3. SECTION: MOST WANTED PICKS --}}
<div class="container mt-5 pt-4">
    <div class="best-seller-section shadow-sm">
        <h3 class="text-center section-title mb-5">Most Wanted Picks</h3>
        <div class="row g-4">
            
            @forelse($latestProducts as $barang)
            <div class="col-6 col-md-3">
                <div class="product-grid-card-1">
                    <div class="product-img-box">
                        {{-- Fitur Tombol Wishlist --}}
                        <form action="{{ route('wishlist.add', $barang->id_barang) }}" method="POST" style="display:inline; position:absolute; top:10px; right:10px; z-index:10;">
                            @csrf
                            <button type="submit" class="btn-wishlist-grid {{ isset(session('wishlist')[$barang->id_barang]) ? 'wishlisted' : '' }}" title="Tambah ke Wishlist">
                                <i class="{{ isset(session('wishlist')[$barang->id_barang]) ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </form>
                        <a href="/products/{{ $barang->id_barang }}">
                            <img src="{{ asset('images/' . ($barang->gambar ?? 'no-image.png')) }}" class="grid-img" alt="{{ $barang->nama_barang ?? $barang->nama }}" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                        </a>
                    </div>
                    <div class="product-info mb-3 px-2 flex-grow-1">
                        <div class="product-brand">{{ strtoupper($barang->kategori ?? 'LOOPWEAR') }}</div>
                        <div class="product-name">
                            <a href="/products/{{ $barang->id_barang }}" class="text-decoration-none text-dark">{{ $barang->nama_barang ?? $barang->nama ?? 'Nama Produk' }}</a>
                        </div>
                        <div>
                            <span class="product-price-discount">Rp {{ number_format($barang->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <form action="{{ route('cart.add', $barang->id_barang) }}" method="POST" class="px-2 pb-2">
                        @csrf
                        <button type="submit" class="btn-grid-action">Masukkan ke Tas</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted fst-italic py-4">
                Belum ada produk yang tersedia.
            </div>
            @endforelse

        </div>
    </div>
</div>

{{-- 4. BANNER: THE THRIFT EDIT --}}
<div class="container mt-5 pt-4">
    <div class="earth-edit-banner shadow-sm">
        <i class="fas fa-leaf mb-3" style="font-size: 2.5rem; color: white;"></i>
        <h2 class="fw-bold mb-3" style="font-family: 'Fredoka One', cursive; letter-spacing: 1px;">THE THRIFT EDIT</h2>
        <p class="mb-0 mx-auto" style="max-width: 600px; font-weight: 500;">
            Look good and feel good with our curated preloved collection.<br>
            Explore fashion picks carefully crafted to help reduce impact on our planet.
        </p>
    </div>
</div>

{{-- 5. SECTION: JUST FOR YOU --}}
<div class="container mt-5 pt-4 mb-5">
    <div class="just-for-you-section shadow-sm">
        <h3 class="text-center section-title mb-5" style="color: #c44131;">Just For You</h3>
        <div class="row g-4">
            
            @forelse($randomProducts as $barang)
            <div class="col-6 col-md-3">
                <div class="product-grid-card-2"> 
                    <div class="product-img-box" style="background-color: #fff;">
                        {{-- Fitur Tombol Wishlist --}}
                        <form action="{{ route('wishlist.add', $barang->id_barang) }}" method="POST" style="display:inline; position:absolute; top:10px; right:10px; z-index:10;">
                            @csrf
                            <button type="submit" class="btn-wishlist-grid {{ isset(session('wishlist')[$barang->id_barang]) ? 'wishlisted' : '' }}" title="Tambah ke Wishlist">
                                <i class="{{ isset(session('wishlist')[$barang->id_barang]) ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </form>
                        <a href="/products/{{ $barang->id_barang }}">
                            <img src="{{ asset('images/' . ($barang->gambar ?? 'no-image.png')) }}" class="grid-img" alt="{{ $barang->nama_barang ?? $barang->nama }}" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                        </a>
                    </div>
                    <div class="product-info mb-3 px-2 flex-grow-1">
                        <div class="product-brand">{{ strtoupper($barang->kategori ?? 'LOOPWEAR') }}</div>
                        <div class="product-name">
                            <a href="/products/{{ $barang->id_barang }}" class="text-decoration-none text-dark">{{ $barang->nama_barang ?? $barang->nama ?? 'Nama Produk' }}</a>
                        </div>
                        <div>
                            <span class="product-price-discount">Rp {{ number_format($barang->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <form action="{{ route('cart.add', $barang->id_barang) }}" method="POST" class="px-2 pb-2">
                        @csrf
                        <button type="submit" class="btn-grid-action">Masukkan ke Tas</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted fst-italic py-4">
                Belum ada produk untukmu.
            </div>
            @endforelse

        </div>

        {{-- Tombol Lihat Semua Produk --}}
        <div class="text-center mt-5">
            <a href="/products" class="btn btn-outline-dark rounded-pill px-5 py-2 fw-bold" style="border-width: 2px;">Lihat Semua Produk</a>
        </div>
    </div>
</div>

{{-- NOTIFIKASI TOAST --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.createElement('div');
        toast.innerHTML = `
            <div id="toast-notif" style="
                position: fixed; bottom: 30px; right: 30px; z-index: 9999;
                background: #47510B; color: white;
                padding: 14px 22px; border-radius: 12px;
                font-family: 'Quicksand', sans-serif; font-weight: 700;
                box-shadow: 0 8px 24px rgba(0,0,0,0.2);
                display: flex; align-items: center; gap: 10px;
                animation: slideIn 0.4s ease;
            ">
                <i class="fas fa-heart" style="color:#F29C9C; font-size:1.2rem;"></i>
                {{ session('success') }}
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            const el = document.getElementById('toast-notif');
            if (el) el.style.animation = 'fadeOut 0.5s ease forwards';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    });
</script>
@endif

@if(session('success_cart'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.createElement('div');
        toast.innerHTML = `
            <div id="toast-cart" style="
                position: fixed; bottom: 30px; right: 30px; z-index: 9999;
                background: #2c7a7b; color: white;
                padding: 14px 22px; border-radius: 12px;
                font-family: 'Quicksand', sans-serif; font-weight: 700;
                box-shadow: 0 8px 24px rgba(0,0,0,0.2);
                display: flex; align-items: center; gap: 10px;
                animation: slideIn 0.4s ease;
            ">
                <i class="fas fa-shopping-cart" style="color:#b2f5ea; font-size:1.2rem;"></i>
                {{ session('success_cart') }}
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            const el = document.getElementById('toast-cart');
            if (el) el.style.animation = 'fadeOut 0.5s ease forwards';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    });
</script>
@endif

{{-- SCRIPT HERO UTAMA --}}
<script>
    const heroData = {
        hijab: {
            title: "Hijab LoopWear",
            desc: "Hijab premium, lembut, siap bikin outfit makin glowing.",
            bgColor: "#fffacf",       
            glowColor: "#FFFFFF",     
            titleColor: "#F29C9C",    
            btnBg: "#F29C9C",         
            btnText: "#FFFFFF",       
            mainImg: "{{ asset('images/hijab_pink.png') }}",
            linkURL: "/category/hijab",
            floaters: [
                "{{ asset('images/baju.png') }}",
                "{{ asset('images/celana.png') }}",
                "{{ asset('images/sepatu.png') }}"
            ]
        },
        baju: {
            title: "Baju LoopWear",
            desc: "Blouse, kemeja, & kaos ternyaman untuk OOTD harianmu.",
            bgColor: "#FDFDFD",       
            glowColor: "#FAD8D8",     
            titleColor: "#F29C9C",    
            btnBg: "#C44131",         
            btnText: "#FFFFFF",
            mainImg: "{{ asset('images/baju.png') }}",
            linkURL: "/category/baju",
            floaters: [
                "{{ asset('images/hijab_pink.png') }}",
                "{{ asset('images/celana.png') }}",
                "{{ asset('images/sepatu.png') }}"
            ]
        },
        celana: {
            title: "Celana LoopWear",
            desc: "Jeans vintage atau culotte? Temukan fitting terbaikmu di sini.",
            bgColor: "#cedcfb",       
            glowColor: "#314896",     
            titleColor: "#F7B0A1",    
            btnBg: "#415AAB",         
            btnText: "#F7B0A1",       
            mainImg: "{{ asset('images/celana.png') }}",
            linkURL: "/category/celana",
            floaters: [
                "{{ asset('images/baju.png') }}",
                "{{ asset('images/hijab_pink.png') }}",
                "{{ asset('images/sepatu.png') }}"
            ]
        },
        sepatu: {
            title: "Sepatu LoopWear",
            desc: "Step up your look! Sneakers & heels preloved tapi tetap kece.",
            bgColor: "#ebfacc",       
            glowColor: "#8c9a76",     
            titleColor: "#F7B0A1",    
            btnBg: "#4A5828",         
            btnText: "#F7B0A1",       
            mainImg: "{{ asset('images/sepatu.png') }}",
            linkURL: "/category/sepatu",
            floaters: [
                "{{ asset('images/baju.png') }}",
                "{{ asset('images/hijab_pink.png') }}",
                "{{ asset('images/celana.png') }}"
            ]
        }
    };

    function changeHero(category, elementClicked) {
        const data = heroData[category];
        if (!data) return;

        if (elementClicked) {
            document.querySelectorAll('.hero-thumbs img').forEach(thumb => thumb.classList.remove('active'));
            elementClicked.classList.add('active');
        }

        const titleEl = document.getElementById('hero-title');
        titleEl.innerText = data.title;
        titleEl.style.color = data.titleColor;

        document.getElementById('hero-desc').innerText = data.desc;

        const btnEl = document.getElementById('order-btn');
        btnEl.style.backgroundColor = data.btnBg;
        btnEl.style.color = data.btnText;

        document.getElementById('hero-section').style.backgroundColor = data.bgColor;
        document.getElementById('hero-glow').style.background = `radial-gradient(circle, ${data.glowColor} 0%, rgba(255,255,255,0) 65%)`;

        const mainImg = document.getElementById('hero-img');
        mainImg.classList.remove('img-fade-in');
        void mainImg.offsetWidth; 
        mainImg.src = data.mainImg;
        mainImg.classList.add('img-fade-in');

        document.getElementById('floater-1').src = data.floaters[0];
        document.getElementById('floater-2').src = data.floaters[1];
        document.getElementById('floater-3').src = data.floaters[2];

        const viewMenuBtn = document.getElementById('view-menu-btn');
        viewMenuBtn.style.borderColor = data.btnBg;
        viewMenuBtn.style.color = data.btnBg;
        viewMenuBtn.href = data.linkURL; 

        viewMenuBtn.onmouseover = function() {
            this.style.backgroundColor = data.btnBg;
            this.style.color = data.btnText;
        };
        viewMenuBtn.onmouseout = function() {
            this.style.backgroundColor = "transparent";
            this.style.color = data.btnBg;
        };
    }

    let currentCategoryIndex = 0;
    const categories = ['hijab', 'baju', 'celana', 'sepatu'];
    let autoSlideInterval;

    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            currentCategoryIndex = (currentCategoryIndex + 1) % categories.length;
            const nextCategory = categories[currentCategoryIndex];
            const nextThumb = document.querySelectorAll('.hero-thumbs img')[currentCategoryIndex];
            changeHero(nextCategory, nextThumb);
        }, 5000);
    }

    window.addEventListener('load', function() {
        const firstThumb = document.querySelectorAll('.hero-thumbs img')[0];
        changeHero('hijab', firstThumb);
        startAutoSlide();
    });

    document.querySelectorAll('.hero-thumbs img').forEach((thumb, index) => {
        thumb.onclick = function() {
            clearInterval(autoSlideInterval);
            currentCategoryIndex = index;
            changeHero(categories[index], this);
            startAutoSlide();
        };
    });
</script>
@endsection