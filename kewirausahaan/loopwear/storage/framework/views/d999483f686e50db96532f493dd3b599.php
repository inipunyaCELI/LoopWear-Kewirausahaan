

<?php $__env->startSection('konten'); ?>
<div class="container py-5">
    <h2>Checkout</h2>

    <form action="<?php echo e(route('checkout.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <input type="text" name="nama" class="form-control mb-3" placeholder="Nama" required>
        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
        <textarea name="alamat" class="form-control mb-3" placeholder="Alamat" required></textarea>

        <button class="btn btn-success">Lanjut Bayar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\loopwear\resources\views/checkout.blade.php ENDPATH**/ ?>