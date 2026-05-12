<?php $__env->startSection('konten'); ?>
<div class="container py-5">
    <h2>Your Cart</h2>

    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row mb-3 align-items-center border p-2 rounded">

        <div class="col-md-1">
            <input type="checkbox"
                   class="item-check"
                   name="selected[]"
                   value="<?php echo e($id); ?>"
                   data-price="<?php echo e($item['harga']); ?>"
                   data-qty="<?php echo e($item['qty']); ?>"
                   checked
                   form="formCheckout">
        </div>

        <div class="col-md-2">
            <img src="<?php echo e(asset('images/'.$item['gambar'])); ?>" width="80">
        </div>

        <div class="col-md-2">
            <?php echo e($item['nama']); ?>

        </div>

        <div class="col-md-2">
            Rp <?php echo e(number_format($item['harga'],0,',','.')); ?>

        </div>

        <div class="col-md-2">
            <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="number" name="qty" value="<?php echo e($item['qty']); ?>" min="1" style="width:60px">
                <button type="submit" class="btn btn-sm btn-primary">OK</button>
            </form>
        </div>

        <div class="col-md-2 text-danger">
            Rp <?php echo e(number_format($item['harga'] * $item['qty'],0,',','.')); ?>

        </div>

        <div class="col-md-1">
            <a href="<?php echo e(route('cart.remove', $id)); ?>">X</a>
        </div>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <hr>

    <h4>Total: Rp <span id="totalHarga">0</span></h4>

    <form id="formCheckout" action="<?php echo e(route('checkout.index')); ?>" method="GET">
        <button type="submit" class="btn btn-success">
            Checkout
        </button>
    </form>

</div>

<script>
function hitungTotal() {
    let total = 0;

    document.querySelectorAll('.item-check:checked').forEach(item => {
        let price = parseInt(item.dataset.price);
        let qty = parseInt(item.dataset.qty);
        total += price * qty;
    });

    document.getElementById('totalHarga').innerText =
        total.toLocaleString('id-ID');
}

hitungTotal();

document.querySelectorAll('.item-check').forEach(el => {
    el.addEventListener('change', hitungTotal);
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/cart.blade.php ENDPATH**/ ?>