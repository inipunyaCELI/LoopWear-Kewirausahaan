<?php $__env->startSection('konten'); ?>
<div class="container py-5">
    <h2 class="text-center mb-5" style="color:#E7998B; font-family: 'Fredoka One', cursive;">My Wishlist ❤️</h2>

    <div class="row">
        
        <?php $__empty_1 = true; $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px;">
                    <div class="product-img-wrapper" style="height: 250px; overflow: hidden; border-radius: 15px;">
                        <img src="<?php echo e(asset('images/' . ($item['gambar'] ?? 'default.jpg'))); ?>" 
                             class="img-fluid w-100 h-100" 
                             style="object-fit: cover;">
                    </div>

                    <div class="card-body px-0 text-center">
                        <h6 style="font-weight: 800; color: #47510B;"><?php echo e($item['nama']); ?></h6>
                        <p style="color: #47510B;">Rp <?php echo e(number_format($item['harga'], 0, ',', '.')); ?></p>

                        
                        <form action="<?php echo e(route('cart.add', $id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-warning w-100 mb-2" style="border-radius: 12px; font-weight: bold;">
                                Add To Cart 🛒
                            </button>
                        </form>

                        
                        <a href="<?php echo e(route('wishlist.remove', $id)); ?>" 
                           class="text-decoration-none d-block mt-2" 
                           style="color: #47510B; font-size: 0.8rem; font-weight: bold; opacity: 0.6;">
                           ✕ Hapus Barang
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5">
                <p>Wishlist kamu masih kosong nih...</p>
                <a href="/products" class="btn btn-sm btn-outline-secondary">Cari Baju Lucu</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\KULIAH\SEMESTER 2\KEWIR\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/wishlist.blade.php ENDPATH**/ ?>