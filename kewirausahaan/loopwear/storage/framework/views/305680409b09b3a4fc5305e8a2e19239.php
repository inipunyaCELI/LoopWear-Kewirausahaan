<?php $__env->startSection('konten'); ?>
<div class="container py-5">
    <h2>Checkout</h2>

    <form action="<?php echo e(route('checkout.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <?php $__currentLoopData = $selected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" name="selected[]" value="<?php echo e($id); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <input type="text" name="nama" class="form-control mb-3" placeholder="Nama" required>
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <textarea name="alamat" class="form-control mb-3" placeholder="Alamat" required></textarea>

    <button class="btn btn-success">Lanjut Bayar</button>

    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/checkout.blade.php ENDPATH**/ ?>