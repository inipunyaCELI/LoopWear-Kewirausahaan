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

        .icon.love { color: red; }
        .icon.cart { color: orange; }

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
    </style>
</head>
<body>

<?php $cartCount = count(session()->get('cart', [])); ?>

<?php if(session('success_cart')): ?>
<div class="cart-toast show" id="cartToast">
    🛒 <?php echo e(session('success_cart')); ?>

</div>
<script>
    setTimeout(function() {
        var toast = document.getElementById('cartToast');
        if (toast) { toast.classList.remove('show'); }
    }, 3000);
</script>
<?php endif; ?>

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
                <li class="nav-item"><a class="nav-link" href="/review">Review</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            </ul>
            <div class="d-flex gap-3 align-items-center">
                <a href="/wishlist" class="text-decoration-none">❤️</a>

                <a href="/cart" class="cart-wrapper">
                    🛒
                    <?php if($cartCount > 0): ?>
                    <span class="cart-badge"><?php echo e($cartCount); ?></span>
                    <?php endif; ?>
                </a>

                <?php if(auth()->guard()->check()): ?>
                    <?php 
                        $unreadNotifications = auth()->user()->unreadNotifications; 
                    ?>
                    <div class="dropdown">
                        <a href="#" class="cart-wrapper text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2rem;">
                            🔔
                            <?php if($unreadNotifications->count() > 0): ?>
                            <span class="cart-badge bg-danger"><?php echo e($unreadNotifications->count()); ?></span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2" style="width: 300px; max-height: 400px; overflow-y: auto; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                            <li><h6 class="dropdown-header fw-bold text-dark">Notifikasi</h6></li>
                            <?php if($unreadNotifications->count() > 0): ?>
                                <?php $__currentLoopData = $unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a class="dropdown-item py-2" href="#" style="white-space: normal; border-bottom: 1px solid #eee;">
                                            <small class="fw-bold d-block text-danger"><?php echo e($notification->data['title']); ?></small>
                                            <small class="text-muted" style="font-size: 0.8rem;"><?php echo e($notification->data['message']); ?></small>
                                            <br>
                                            <small class="text-muted" style="font-size: 0.7rem;"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                                        </a>
                                    </li>
                                    <?php $notification->markAsRead(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li><span class="dropdown-item text-muted text-center py-3"><small>Belum ada notifikasi baru.</small></span></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <span style="font-weight:600;" class="ms-2"><?php echo e(auth()->user()->name); ?></span>

                    <?php if(auth()->user()->role == 'admin'): ?>
                        <a href="/dashboard" class="text-decoration-none">Dashboard</a>
                    <?php else: ?>
                        <a href="/pesanan" class="text-decoration-none">📦 Pesanan</a>
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
</html><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/layout/main.blade.php ENDPATH**/ ?>