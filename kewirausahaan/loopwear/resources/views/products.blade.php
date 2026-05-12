@extends('layout.main')



@section('konten')

<style>

    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap');

   

    /* Perbaikan global untuk halaman */

    .product-page {

        font-family: 'Quicksand', sans-serif;

        background-color: #fff;

        color: #333;

    }

   

    /* Mengaktifkan Smooth Scrolling */

    html {

        scroll-behavior: smooth;

    }



    /* Typography */

    .title-main {

        font-family: 'Fredoka One', cursive;

        color: #E7998B;

        font-size: 2.5rem;

        letter-spacing: 1px;

    }

    .subtitle {

        font-size: 0.9rem;

        color: #777;

        line-height: 1.4;

    }

    .title-kategori {

        font-family: 'Fredoka One', cursive;

        font-size: 2rem;

    }



    /* Custom Category Colors */

    .color-hijab { color: #C46A55; }

    .color-baju { color: #E7998B; }

    .color-celana { color: #8BA3C7; }

    .color-sepatu { color: #A3B18A; }



    /* CSS BANNER ATAS */

    .banner-img {

        width: 100%;

        aspect-ratio: 1 / 1;

        object-fit: cover;

        object-position: center;

        border-radius: 10px;

        transition: transform 0.3s ease;

    }

   

    .banner-wrapper:hover .banner-img {

        transform: scale(1.03);

    }

   

    /* --- CSS PRODUK (KOTAK, KECIL, GAK KEPOTONG) --- */

    .product-img-wrapper {

        max-width: 240px; /* Ukuran dikecilin dikit */

        aspect-ratio: 1 / 1; /* Bikin kotaknya persegi sempurna */

        margin: 0 auto 15px auto; /* Posisi ke tengah */

        background-color: #f8f9fa; /* Background terang sedikit */

        border-radius: 15px;

        overflow: hidden;

        display: flex;

        align-items: center;

        justify-content: center;

    }



    .product-img {

        width: 100%;

        height: 100%;

        object-fit: contain; /* Kunci biar gambar utuh & gak kepotong */

        transition: transform 0.3s ease;

    }



    .product-img-wrapper:hover .product-img {

        transform: scale(1.05);

    }



    .product-name {

        font-size: 0.85rem;

        font-weight: 700;

        text-transform: uppercase;

        margin-bottom: 5px;

        letter-spacing: 0.5px;

    }

   

    /* Meta, Harga, & Ikon */

    .product-meta {

        display: flex;

        justify-content: center;

        align-items: center;

        gap: 8px;

        font-size: 0.85rem;

        margin-top: 5px;

    }



    .product-meta .price {

        font-weight: 600;

        color: #555;

    }



    .product-meta .divider {

        color: #aaa;

    }



    .product-meta .icon {

        background: none;

        border: none;

        cursor: pointer;

        font-size: 1rem;

        transition: 0.2s;

        padding: 0;

    }



    .product-meta .icon:hover {

        transform: scale(1.2);

    }



    .icon.love { color: #e74c3c; }

    .icon.cart { color: #f39c12; }



    /* Buttons View All */

    .btn-view-all {

        border-radius: 50px;

        font-weight: 600;

        font-size: 0.85rem;

        border: 1px solid #333;

        color: #333;

        background: transparent;

        padding: 8px 35px;

        transition: all 0.3s ease;

        display: inline-block;

        text-decoration: none;

    }

    .btn-view-all:hover {

        background-color: #333;

        color: #fff;

    }

</style>



<div class="container product-page py-5">

   

    <div class="text-center mb-5">

        <h1 class="title-main mb-2">CATEGORIES PRODUCTS</h1>

        <p class="subtitle">Temukan gaya personalmu dengan koleksi fashion<br>terbaik dari LoopWear.</p>

    </div>



    <div class="row justify-content-center g-4 mb-5 pb-4 text-center">

        <div class="col-md-6 col-lg-5 banner-wrapper">

            <a href="#hijab" class="text-decoration-none" style="display: block;">

                <img src="{{ asset('images/banner-hijab.png') }}" class="img-fluid banner-img mb-3 shadow-sm" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

                <h4 class="title-kategori color-hijab" style="font-size: 1.5rem;">Hijab LoopWear</h4>

            </a>

        </div>

       

        <div class="col-md-6 col-lg-5 banner-wrapper">

            <a href="#baju" class="text-decoration-none" style="display: block;">

                <img src="{{ asset('images/banner-baju.png') }}" class="img-fluid banner-img mb-3 shadow-sm" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

                <h4 class="title-kategori color-baju" style="font-size: 1.5rem;">Baju LoopWear</h4>

            </a>

        </div>

       

        <div class="col-md-6 col-lg-5 banner-wrapper">

            <a href="#celana" class="text-decoration-none" style="display: block;">

                <img src="{{ asset('images/banner-celana.png') }}" class="img-fluid banner-img mb-3 shadow-sm" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

                <h4 class="title-kategori color-celana" style="font-size: 1.5rem;">Celana LoopWear</h4>

            </a>

        </div>

       

        <div class="col-md-6 col-lg-5 banner-wrapper">

            <a href="#sepatu" class="text-decoration-none" style="display: block;">

                <img src="{{ asset('images/banner-sepatu.png') }}" class="img-fluid banner-img mb-3 shadow-sm" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

                <h4 class="title-kategori color-sepatu" style="font-size: 1.5rem;">Sepatu LoopWear</h4>

            </a>

        </div>

    </div>



    @php

        $categories = [

            'hijab' => ['title' => 'Hijab LoopWear', 'color_class' => 'color-hijab'],

            'baju' => ['title' => 'Baju LoopWear', 'color_class' => 'color-baju'],

            'celana' => ['title' => 'Celana LoopWear', 'color_class' => 'color-celana'],

            'sepatu' => ['title' => 'Sepatu LoopWear', 'color_class' => 'color-sepatu']

        ];

    @endphp



    @foreach($categories as $key => $cat)

    <section id="{{ $key }}" class="mb-5 pb-4">

        <div class="text-center mb-4">

            <h2 class="title-kategori {{ $cat['color_class'] }}">{{ $cat['title'] }}</h2>

        </div>



        <div class="row justify-content-center g-4 mb-4">

            @forelse(collect($data[$key] ?? [])->take(3) as $item)

            <div class="col-md-4">

                <div class="text-center">

                    {{-- Link menuju Halaman Detail/Review --}}

                    <a href="{{ route('user.products.detail', $item->id_barang) }}" class="text-decoration-none text-dark">

                        <div class="product-img-wrapper">

                            <img src="{{ asset('images/' . $item->gambar) }}" class="product-img"

                                 onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

                        </div>

                        <h6 class="product-name">{{ $item->nama_barang }}</h6>

                    </a>

                   

                    <div class="product-meta">

                        <span class="price">

                            Rp {{ number_format($item->harga, 0, ',', '.') }}

                        </span>



                        <span class="divider">|</span>



                        {{-- Tombol Like & Cart di Halaman Produk --}}

                        <form action="{{ route('wishlist.add', $item->id_barang) }}" method="POST" style="display:inline;">

                            @csrf

                            <button class="icon love">❤️</button>

                        </form>



                        <form action="{{ route('cart.add', $item->id_barang) }}" method="POST" style="display:inline;">

                            @csrf

                            <button class="icon cart">🛒</button>

                        </form>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-12 text-center text-muted fst-italic">Koleksi belum tersedia.</div>

            @endforelse

        </div>



        {{-- POSISI VIEW ALL --}}

        <div class="text-center mt-3">

            <a href="{{ route('category.show', $key) }}" class="btn-view-all">

                VIEW ALL

            </a>

        </div>

    </section>

    @endforeach



</div>

@endsection