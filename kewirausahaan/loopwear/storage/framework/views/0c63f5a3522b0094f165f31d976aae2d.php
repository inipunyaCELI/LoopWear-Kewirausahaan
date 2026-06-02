

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
                    <a href="javascript:void(0)" onclick="showImageModal('<?php echo e(asset('images/'.$item->gambar)); ?>', '<?php echo e($item->nama_barang); ?>')">
                        <img src="<?php echo e(asset('images/'.$item->gambar)); ?>" class="product-img" onerror="this.onerror=null;this.src='<?php echo e(asset('images/no-image.png')); ?>';">
                    </a>
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

<!-- Modal Foto Produk -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold" id="imageModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center pt-2">
        <img id="modalImage" src="" class="img-fluid rounded" alt="Product Image" style="max-height: 80vh; object-fit: contain;">
      </div>
    </div>
  </div>
</div>

<script>
function showImageModal(imgSrc, title) {
    document.getElementById('modalImage').src = imgSrc;
    document.getElementById('imageModalLabel').innerText = title;
    var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
    myModal.show();
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/category.blade.php ENDPATH**/ ?>