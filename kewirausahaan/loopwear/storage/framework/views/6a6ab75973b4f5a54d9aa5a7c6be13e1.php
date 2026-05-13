<?php $__env->startSection('konten'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap');

    .category-page { font-family: 'Quicksand', sans-serif; color: #333; }
    
    .title-main { 
        font-family: 'Fredoka One', cursive; 
        color: #E7998B; /* Pink Coquette */
        font-size: 2.5rem; 
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Tombol Kembali yang Estetik */
    .btn-back-loop {
        background-color: #f0f0f0;
        color: #47510B;
        font-weight: 700;
        border-radius: 50px;
        padding: 8px 25px;
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
        font-size: 0.9rem;
        border: none;
    }
    .btn-back-loop:hover {
        background-color: #47510B;
        color: #fff24d;
    }

    /* Style Gambar Produk */
    .product-img-wrapper {
        max-width: 220px;
        aspect-ratio: 1 / 1;
        margin: 0 auto 15px auto;
        background-color: #f8f9fa;
        border-radius: 15px;
        overflow: hidden;
        display: flex; 
        align-items: center;
        justify-content: center;
    }
    .product-img { width: 100%; height: 100%; object-fit: contain; transition: 0.3s; }
    .product-name { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; color: #47510B; }

    /* --- FIX BUTTON LOVE & CART SEJAJAR (HORIZONTAL) --- */
    .product-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        margin-top: 10px;
    }
    .product-meta .price { font-weight: 700; color: #47510B; font-size: 0.95rem; }
    .product-meta .divider { color: #ddd; }

    .btn-icon-loop {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: 1.3rem;
        transition: 0.2s;
        display: flex;
        align-items: center;
        line-height: 1;
    }
    .btn-icon-loop:hover { transform: scale(1.2); }
    .icon-pink { color: #E7998B; } 
    .icon-blue { color: #8CABFF; }
</style>

<div class="container category-page py-5">
    
    
    <div class="d-flex flex-column align-items-center mb-5">
        <a href="<?php echo e(route('user.products')); ?>" class="btn-back-loop mb-3 shadow-sm">
            ← Kembali ke Semua Koleksi
        </a>
        <h2 class="title-main text-center">
            <?php echo e(ucfirst($kategori)); ?> LoopWear
        </h2>
        <p class="text-muted small">Menampilkan semua koleksi <?php echo e($kategori); ?> terbaik untukmu</p>
    </div>

    <div class="row g-4 justify-content-center">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="text-center mb-4">
                
                <a href="<?php echo e(route('user.products.detail', $item->id_barang)); ?>" class="text-decoration-none">
                    <div class="product-img-wrapper shadow-sm">
                        <img src="<?php echo e(asset('images/'.$item->gambar)); ?>" class="product-img" onerror="this.src='<?php echo e(asset('images/no-image.png')); ?>'">
                    </div>
                    <h6 class="product-name"><?php echo e($item->nama_barang); ?></h6>
                </a>

                
                <div class="product-meta">
                    <span class="price">Rp<?php echo e(number_format($item->harga, 0, ',', '.')); ?></span>
                    <span class="divider">|</span>

                    
                    <form action="<?php echo e(route('wishlist.add', $item->id_barang)); ?>" method="POST" class="m-0 p-0">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-icon-loop icon-pink" title="Simpan ke Wishlist">♥</button>
                    </form>

                    
                    <form action="<?php echo e(route('cart.add', $item->id_barang)); ?>" method="POST" class="m-0 p-0">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-icon-loop icon-blue" title="Masuk Keranjang">🛒</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted fst-italic">Maaf, koleksi <?php echo e($kategori); ?> belum tersedia saat ini.</p>
            <a href="<?php echo e(route('user.products')); ?>" class="btn btn-outline-secondary btn-sm">Lihat Produk Lain</a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/category.blade.php ENDPATH**/ ?>