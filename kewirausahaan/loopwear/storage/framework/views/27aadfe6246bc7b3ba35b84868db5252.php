<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoopWear - Preloved Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background-color: #fff; }
        
        /* --- NAVBAR BASE --- */
        .navbar { 
            background-color: #fff24d !important; 
            padding: 12px 0; 
            position: sticky; 
            top: 0; 
            z-index: 1020; 
        }
        .navbar-brand { font-family: 'Fredoka One'; color: #E7998B !important; font-size: 1.8rem; }

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
        }
        .nav-link-custom:hover { color: #47510B !important; }

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
        }
        .nav-right-link:hover { color: #E7998B !important; }

        /* --- FIX UKURAN IKON (HATI & KERANJANG) --- */
        .nav-icon-group {
            font-size: 1.2rem !important; /* Ukuran seragam */
            text-decoration: none;
            transition: transform 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 18px; /* Jarak antar ikon */
        }

        .nav-icon-group:hover {
            transform: scale(1.2); /* Membesar saat kursor lewat */
        }

        /* Animasi Pop/Bounce saat dipencet */
        .nav-icon-group:active {
            animation: iconPop 0.3s ease;
        }

        @keyframes iconPop {
            0% { transform: scale(1); }
            50% { transform: scale(0.8) rotate(-10deg); }
            100% { transform: scale(1.2) rotate(0deg); }
        }

        /* Khusus Hati dikasih shadow agar efek 3D emoji makin dapet */
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
        }

        .user-icon-fix { display: flex; align-items: center; }

        /* --- PRODUCT STYLING (GLOBAL) --- */
        .product-img { width: 100%; height: 280px; object-fit: cover; border-radius: 15px; }
        .product-img-wrapper { overflow: hidden; margin-bottom: 15px; border-radius: 15px; }
        .product-img-wrapper:hover .product-img { transform: scale(1.05); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">
        
        
        <a class="navbar-brand" href="/">
            <img style="width: 100px" src="/images/logo_loop.png" alt="LoopWear">
        </a>

        
        <div class="nav-center-group d-none d-lg-flex">
            <a class="nav-link-custom" href="/">Home</a>
            <a class="nav-link-custom" href="/about">About</a>
            <a class="nav-link-custom" href="/products">Products</a>
            <a class="nav-link-custom" href="/contact">Contact</a>
        </div>

        
        <div class="d-flex align-items-center">
            
            
            <a href="/wishlist" class="nav-icon-group like-icon" title="Wishlist">❤️</a>
            
            
            <a href="/cart" class="nav-icon-group" title="Cart">🛒</a>

            <?php if(auth()->guard()->check()): ?>
                <div class="user-pill">
                    <span class="user-icon-fix">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#A0A0A0" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                    </span>
                    <span><?php echo e(Str::limit(auth()->user()->name, 5, '')); ?></span>
                </div>
                
                <?php if(auth()->user()->role == 'admin'): ?>
                    <a href="/dashboard" class="nav-right-link">Dashboard</a>
                <?php endif; ?>
                <a href="/logout" class="nav-right-link">Logout</a>
            <?php else: ?>
                <a href="/login" class="nav-right-link">👤 Login</a>
            <?php endif; ?>
        </div>

    </div>
</nav>

<main>
    <?php echo $__env->yieldContent('konten'); ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/layout/main.blade.php ENDPATH**/ ?>