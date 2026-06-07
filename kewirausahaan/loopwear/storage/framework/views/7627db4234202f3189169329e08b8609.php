<?php $__env->startSection('konten'); ?>
<div class="container py-5">
    <h2 class="text-center mb-5" style="color:#E7998B; font-family: 'Fredoka One', cursive;">My Wishlist ❤️</h2>

    <div class="row">
        
        <?php $__empty_1 = true; $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-6 col-md-3 mb-4">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                    <div class="product-img-wrapper" style="height: 220px; overflow: hidden; border-radius: 15px; position: relative;">
                        <img src="<?php echo e(asset('images/' . ($item['gambar'] ?? 'default.jpg'))); ?>" 
                             class="img-fluid w-100 h-100" 
                             style="object-fit: cover;"
                             onerror="this.onerror=null;this.src='<?php echo e(asset('images/no-image.png')); ?>';">
                    </div>

                    <div class="card-body px-0 text-center d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <h6 style="font-weight: 800; color: #47510B; min-height: 40px;" class="text-truncate-2"><?php echo e($item['nama'] ?? $item['nama_barang']); ?></h6>
                            <p class="fw-bold mb-0" style="color: #47510B;">Rp <?php echo e(number_format($item['harga'], 0, ',', '.')); ?></p>
                        </div>

                        <div>
                            
                            <form action="<?php echo e(route('cart.add', $id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-warning w-100 mb-2" style="border-radius: 12px; font-weight: bold; background-color: #E7998B; border-color: #E7998B; color: white;">
                                    Add To Cart 🛒
                                </button>
                            </form>

                            
                            <form action="<?php echo e(route('wishlist.remove', $id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini dari wishlist?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?> 
                                <button type="submit" class="btn btn-link text-decoration-none p-0 w-100" style="color: #47510B; font-size: 0.8rem; font-weight: bold; opacity: 0.6;">
                                    ✕ Hapus Barang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5" style="font-family: 'Quicksand', sans-serif;">
                <p class="text-muted fs-5">Wishlist kamu masih kosong nih... 🥺</p>
                <a href="/products" class="btn rounded-pill px-4 py-2 fw-bold" style="background-color: #47510B; color: #fffacf;">Cari Baju Lucu</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/wishlist.blade.php ENDPATH**/ ?>