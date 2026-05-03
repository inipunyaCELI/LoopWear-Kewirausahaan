

<?php $__env->startSection('konten'); ?>

<div class="container py-5 text-center">

    <h2 class="title-main mb-4">
        <?php echo e(ucfirst($kategori)); ?> LoopWear
    </h2>

    <div class="row g-4">

        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="text-center">

                <div class="product-img-wrapper">
                    <img src="<?php echo e(asset('images/'.$item->gambar)); ?>" class="product-img">
                </div>

                <h6 class="product-name"><?php echo e($item->nama_barang); ?></h6>

                <div class="product-meta">
                    <span class="price">
                        Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?>

                    </span>

                    <span class="divider">|</span>

                    <form action="<?php echo e(route('wishlist.add', $item->id_barang)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button class="icon love">❤️</button>
                    </form>

                    <form action="<?php echo e(route('cart.add', $item->id_barang)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button class="icon cart">🛒</button>
                    </form>
                </div>

            </div>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted">Produk belum tersedia</p>
        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/category.blade.php ENDPATH**/ ?>