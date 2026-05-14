<?php $__env->startSection('konten'); ?>
<div class="container py-5">
    <h2>Your Cart</h2>

    <?php $total = 0; ?>

    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php 
            $subtotal = $item['harga'] * $item['qty']; 
            $total += $subtotal; 
        ?>

        <div class="row mb-3 align-items-center">
            <div class="col-md-2">
                <img src="<?php echo e(asset('images/'.$item['gambar'])); ?>" width="80">
            </div>

            <div class="col-md-3"><?php echo e($item['nama']); ?></div>
            <div class="col-md-2">Rp <?php echo e(number_format($item['harga'],0,',','.')); ?></div>
            <div class="col-md-2">Qty: <?php echo e($item['qty']); ?></div>
            <div class="col-md-2 text-danger">
                Rp <?php echo e(number_format($subtotal,0,',','.')); ?>

            </div>

            <div class="col-md-1">
                <a href="<?php echo e(route('cart.remove', $id)); ?>">X</a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <h4>Total: Rp <?php echo e(number_format($total,0,',','.')); ?></h4>

    <a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-danger">
    Checkout
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\KULIAH\SEMESTER 2\KEWIR\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/cart.blade.php ENDPATH**/ ?>