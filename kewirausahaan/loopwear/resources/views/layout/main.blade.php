<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoopWear - Preloved Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SWEETALERT2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Quicksand', sans-serif; background-color: #fff; scroll-behavior: smooth; }

        /* --- NAVBAR BASE --- */
        .navbar {
            background-color: #fff24d !important;
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .navbar-brand {
            font-family: 'Fredoka One';
            color: #E7998B !important;
            font-size: 1.8rem;
        }

        /* --- MENU TENGAH (PINK) --- */
        .nav-center-group {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
        }

        .nav-link-custom {
            color: #E7998B !important;
            font-weight: 700;
            margin: 0 15px;
            text-decoration: none;
            transition: 0.3s;
            position: relative;
            padding-bottom: 3px;
        }

        .nav-link-custom:hover { color: #47510B !important; }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background-color: #47510B;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .nav-link-custom:hover::after { width: 100%; }

        .nav-link-custom.active { color: #47510B !important; }
        .nav-link-custom.active::after { width: 100%; }

        /* --- MENU KANAN (GRASSY GREEN) --- */
        .nav-right-link {
            color: #47510B !important;
            font-weight: 700;
            text-decoration: none;
            margin-left: 20px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
            position: relative;
            padding-bottom: 3px;
        }

        .nav-right-link:hover { color: #E7998B !important; }

        .nav-right-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background-color: #E7998B;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .nav-right-link:hover::after { width: 100%; }

        /* --- FIX UKURAN IKON (HATI & KERANJANG) --- */
        .nav-icon-group {
            font-size: 1.2rem !important;
            text-decoration: none;
            transition: transform 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 18px;
        }

        .nav-icon-group:hover { transform: scale(1.2); }

        .nav-icon-group:active {
            animation: iconPop 0.3s ease;
        }

        .navbar.scrolled {
            padding: 6px 0 !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
            transition: padding 0.3s ease, box-shadow 0.3s ease;
        }

        @keyframes iconPop {
            0% { transform: scale(1); }
            50% { transform: scale(0.8) rotate(-10deg); }
            100% { transform: scale(1.2) rotate(0deg); }
        }

        .like-icon {
            filter: drop-shadow(0 2px 3px rgba(231, 153, 139, 0.4));
        }

        /* User Pill Style */
        .user-pill {
            background-color: #47510B;
            color: #fff24d !important;
            padding: 6px 15px;
            border-radius: 25px;
            font-weight: 800;
            font-size: 0.85rem;
            margin-left: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            text-transform: lowercase;
            text-decoration: none;
        }

        .user-icon-fix {
            display: flex;
            align-items: center;
        }

        /* Cart Badge */
        .cart-wrapper {
            position: relative;
            display: inline-block;
            text-decoration: none;
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background-color: #E7998B;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Toast Notification */
        .cart-toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #4A4A4A;
            color: white;
            padding: 14px 24px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.95rem;
            z-index: 9999;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .cart-toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- PRODUCT STYLING (GLOBAL) --- */
        .product-img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .product-img-wrapper {
            overflow: hidden;
            margin-bottom: 15px;
            border-radius: 15px;
        }

        .product-img-wrapper:hover .product-img {
            transform: scale(1.05);
        }

        /* --- BACK TO TOP --- */
        #backToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            background-color: #47510B;
            color: #fff24d;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
            font-weight: 800;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        #backToTop.show {
            opacity: 1;
            transform: translateY(0);
        }

        #backToTop:hover {
            background-color: #E7998B;
            color: #fff;
        }

        /* --- PAGE TRANSITION --- */
        body {
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

@php $cartCount = count(session()->get('cart', [])); @endphp

@if(session('success_cart'))
<div class="cart-toast show" id="cartToast">
    🛒 {{ session('success_cart') }}
</div>
<script>
    setTimeout(function() {
        var toast = document.getElementById('cartToast');
        if (toast) { toast.classList.remove('show'); }
    }, 3000);
</script>
@endif

<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">

        {{-- KOLOM 1: LOGO --}}
        <a class="navbar-brand" href="/"><img style="width: 100px" src="/images/logo_loop.png" alt="LoopWear"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- KOLOM 2: MENU TENGAH --}}
        <div class="nav-center-group d-none d-lg-flex">
            <a class="nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
            <a class="nav-link-custom {{ request()->is('about') ? 'active' : '' }}" href="/about">About</a>
            <a class="nav-link-custom {{ request()->is('products*') ? 'active' : '' }}" href="/products">Products</a>
            <a class="nav-link-custom {{ request()->is('review') ? 'active' : '' }}" href="/review">Review</a>
            <a class="nav-link-custom {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
        </div>

        {{-- KOLOM 3: AKSI KANAN --}}
        <div class="d-flex align-items-center">

            {{-- Wishlist --}}
            <a href="/wishlist" class="nav-icon-group like-icon" title="Wishlist">❤️</a>

            {{-- Cart dengan badge --}}
            <a href="/cart" class="cart-wrapper nav-icon-group" title="Cart">
                🛒
                @if($cartCount > 0)
                <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>

            @auth
                @php
                    $unreadNotifications = auth()->user()->unreadNotifications;
                @endphp
                <div class="dropdown">
                    <a href="#" class="cart-wrapper nav-icon-group dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        🔔
                        @if($unreadNotifications->count() > 0)
                        <span class="cart-badge bg-danger">{{ $unreadNotifications->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-2" style="width: 300px; max-height: 400px; overflow-y: auto; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <li><h6 class="dropdown-header fw-bold text-dark">Notifikasi</h6></li>
                        @if($unreadNotifications->count() > 0)
                            @foreach($unreadNotifications as $notification)
                                <li>
                                    <a class="dropdown-item py-2" href="#" style="white-space: normal; border-bottom: 1px solid #eee;">
                                        <small class="fw-bold d-block text-danger">{{ $notification->data['title'] }}</small>
                                        <small class="text-muted" style="font-size: 0.8rem;">{{ $notification->data['message'] }}</small>
                                        <br>
                                        <small class="text-muted" style="font-size: 0.7rem;">{{ $notification->created_at->diffForHumans() }}</small>
                                    </a>
                                </li>
                                @php $notification->markAsRead(); @endphp
                            @endforeach
                        @else
                            <li><span class="dropdown-item text-muted text-center py-3"><small>Belum ada notifikasi baru.</small></span></li>
                        @endif
                    </ul>
                </div>

                <a href="/profile/edit" class="user-pill">
                    <span class="user-icon-fix">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#A0A0A0" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                    </span>
                    <span>{{ Str::limit(auth()->user()->name, 5, '') }}</span>
                </a>

                @if(auth()->user()->role == 'admin')
                    <a href="/dashboard" class="nav-right-link">Dashboard</a>
                @else
                    <a href="/pesanan" class="nav-right-link">📦 Pesanan</a>
                @endif

                <a href="/logout" class="nav-right-link text-danger">Logout</a>
            @else
                <a href="/login" class="nav-right-link">👤 Login</a>
            @endauth
        </div>
    </div>
</nav>

<main>
    @yield('konten')
</main>

{{-- SWEET ALERT SUCCESS --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

{{-- SWEET ALERT ERROR --}}
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}'
    });
</script>
@endif

{{-- FOOTER --}}
<footer style="background-color: #47510B; color: #fff24d; padding: 2rem 0 1rem; margin-top: 0;">
    <div class="container">
        <div class="row gy-4">

            {{-- Kolom 1: Brand + Tagline --}}
            <div class="col-md-3">
                <p style="font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px; color: #fff24d;">LoopWear</p>
                <p style="font-size: 0.82rem; line-height: 1.6; color: #fff24d; margin: 0; opacity: 0.85;">
                    Preloved fashion pilihan — stylish, terjangkau, dan ramah lingkungan. 💛
                </p>
            </div>

            {{-- Kolom 2: Menu --}}
            <div class="col-md-2 offset-md-1">
                <p style="font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px; color: #fff24d;">Menu</p>
                <ul style="list-style: none; padding: 0; font-size: 0.82rem; margin: 0;">
                    <li style="margin-bottom: 6px;"><a href="/" style="color: #fff24d; text-decoration: none; opacity: 0.85;">Home</a></li>
                    <li style="margin-bottom: 6px;"><a href="/about" style="color: #fff24d; text-decoration: none; opacity: 0.85;">About</a></li>
                    <li style="margin-bottom: 6px;"><a href="/products" style="color: #fff24d; text-decoration: none; opacity: 0.85;">Products</a></li>
                    <li style="margin-bottom: 6px;"><a href="/contact" style="color: #fff24d; text-decoration: none; opacity: 0.85;">Contact</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Kontak --}}
            <div class="col-md-3">
                <p style="font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px; color: #fff24d;">Kontak</p>
                <ul style="list-style: none; padding: 0; font-size: 0.82rem; margin: 0;">
                    <li style="margin-bottom: 6px; color: #fff24d; opacity: 0.85;">📧 hello@loopwear.com</li>
                    <li style="margin-bottom: 6px; color: #fff24d; opacity: 0.85;">📞 0812-3456-7890</li>
                    <li style="margin-bottom: 6px; color: #fff24d; opacity: 0.85;">📍 Banjarmasin, Indonesia</li>
                </ul>
            </div>

            {{-- Kolom 4: Sosmed --}}
            <div class="col-md-3">
                <p style="font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px; color: #fff24d;">Ikuti Kami</p>
                <a href="https://instagram.com/LoopWear.official" target="_blank"
                   style="display: flex; align-items: center; gap: 8px; color: #fff24d; text-decoration: none; font-size: 0.82rem; opacity: 0.85; margin-bottom: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff24d" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm.003 1.44c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.843-.038 1.096-.046 3.232-.046zm0 2.452a4.108 4.108 0 1 0 0 8.215 4.108 4.108 0 0 0 0-8.215zm0 6.775a2.667 2.667 0 1 1 0-5.334 2.667 2.667 0 0 1 0 5.334zm5.23-6.937a.96.96 0 1 1-1.92 0 .96.96 0 0 1 1.92 0z"/>
                    </svg>
                    @LoopWear.official
                </a>
                <a href="https://facebook.com/LoopWear.id" target="_blank"
                   style="display: flex; align-items: center; gap: 8px; color: #fff24d; text-decoration: none; font-size: 0.82rem; opacity: 0.85;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff24d" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                    LoopWear.id
                </a>
            </div>

        </div>

        {{-- Garis & Copyright --}}
        <hr style="border-color: rgba(255,242,77,0.2); margin-top: 1.5rem; margin-bottom: 0.8rem;">
        <p style="text-align: center; font-size: 0.78rem; color: #fff24d; opacity: 0.7; margin: 0;">
            © 2025 LoopWear. All rights reserved. Made with 💛 in Banjarmasin.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<button id="backToTop" title="Kembali ke atas">↑</button>

<script>
    const btn = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
        btn.classList.toggle('show', window.scrollY > 300);
    });
    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

<script>
    window.addEventListener('scroll', () => {
        document.querySelector('.navbar').classList.toggle('scrolled', window.scrollY > 50);
    });
</script>

</body>
</html>