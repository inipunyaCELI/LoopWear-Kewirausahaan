<?php $__env->startSection('konten'); ?>
<div class="container text-center py-5">
    <h2 style="color:#E7998B;">My Wishlist ❤️</h2>

    <div class="row mt-4">
        <?php $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <img src="<?php echo e(asset('images/'.$item['gambar'])); ?>" class="img-fluid">

            <p><?php echo e($item['nama']); ?></p>
            <p>Rp <?php echo e(number_format($item['harga'],0,',','.')); ?></p>

            <form action="<?php echo e(route('cart.add', $id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-warning">Add To Cart 🛒</button>
            </form>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\semester 2\kewir\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/wishlist.blade.php ENDPATH**/ ?>