<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoopWear - Preloved Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background-color: #fff; }
        .navbar { background-color: #fff24d !important; padding: 15px 0; }
        .navbar-brand { font-family: 'Fredoka One'; color: #E7998B !important; font-size: 1.8rem; }
        .nav-link { color: #E7998B !important; font-weight: bold; margin: 0 10px; }
        .nav-link:hover { color: #4A4A4A !important; }
        .sticky-top { position: sticky; top: 0; z-index: 1020; }

        .product-img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    border-radius: 15px;
    }

    .product-img-wrapper {
        overflow: hidden;
        margin-bottom: 15px;
        border-radius: 15px;
    }

    .product-img-wrapper:hover .product-img {
        transform: scale(1.05);
    }

    .product-name {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .product-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
    }

    .product-meta .icon {
        background: none;
        border: none;
        cursor: pointer;
    }

    .icon.love {
        color: red;
    }

    .icon.cart {
        color: orange;
    }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/"><img style="width: 100px" src="/images/logo_loop.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#review">Review</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            </ul>
            <div class="d-flex gap-3 align-items-center">
            <a href="/wishlist" class="text-decoration-none">❤️</a>
            <a href="/cart" class="text-decoration-none">🛒</a>

            <?php if(auth()->guard()->check()): ?>
                <span style="font-weight:600;">
                    <?php echo e(auth()->user()->name); ?>

                </span>

                <?php if(auth()->user()->role == 'admin'): ?>
                    <a href="/dashboard" class="text-decoration-none">Dashboard</a>
                <?php endif; ?>

                <a href="/logout" class="text-decoration-none text-danger">Logout</a>
            <?php else: ?>
                <a href="/login" class="text-decoration-none">👤 Login</a>
            <?php endif; ?>

        </div>
        </div>
    </div>
</nav>

<?php echo $__env->yieldContent('konten'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/layout/main.blade.php ENDPATH**/ ?>