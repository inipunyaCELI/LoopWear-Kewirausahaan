

<?php $__env->startSection('konten'); ?>
<div class="container py-5">
    <h2>Your Cart</h2>

    <?php $total = 0; ?>

    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php 
            $subtotal = $item['harga'] * $item['qty']; 
            $total += $subtotal; 
        ?>

        <div class="row mb-3 align-items-center border p-2 rounded">

            <!-- CHECKBOX -->
            <div class="col-md-1">
                <input type="checkbox" name="selected[]" value="<?php echo e($id); ?>" checked>
            </div>

            <!-- IMAGE -->
            <div class="col-md-2">
                <img src="<?php echo e(asset('images/'.$item['gambar'])); ?>" width="80">
            </div>

            <!-- NAME -->
            <div class="col-md-2">
                <?php echo e($item['nama']); ?>

            </div>

            <!-- PRICE -->
            <div class="col-md-2">
                Rp <?php echo e(number_format($item['harga'],0,',','.')); ?>

            </div>

            <!-- QTY FORM (ISOLATED) -->
            <div class="col-md-2">
                <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="number" name="qty" value="<?php echo e($item['qty']); ?>" min="1" style="width:60px">

                    <button type="submit" class="btn btn-sm btn-primary">
                        OK
                    </button>
                </form>
            </div>

            <!-- SUBTOTAL -->
            <div class="col-md-2 text-danger">
                Rp <?php echo e(number_format($subtotal,0,',','.')); ?>

            </div>

            <!-- REMOVE -->
            <div class="col-md-1">
                <a href="<?php echo e(route('cart.remove', $id)); ?>">X</a>
            </div>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <hr>

    <h4>Total: Rp <?php echo e(number_format($total,0,',','.')); ?></h4>

    <!-- CHECKOUT BUTTON (NO FORM WRAPPER!) -->
    <a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-success">
        Checkout
    </a>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/cart.blade.php ENDPATH**/ ?>