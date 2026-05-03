
<?php $__env->startSection('konten'); ?>
<div class="container py-4">
    <div class="card shadow border-0" style="border-radius: 20px;">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Tambah Koleksi Baru</h5>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('barang.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="<?php echo e(old('nama_barang')); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="hijab">Hijab</option>
                            <option value="baju">Baju</option>
                            <option value="celana">Celana</option>
                            <option value="sepatu">Sepatu</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" value="<?php echo e(old('harga')); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?php echo e(old('stok')); ?>" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Foto Produk</label>
                        <input type="file" name="gambar" class="form-control" required>
                        <small class="text-muted">Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Barang</button>
                    <a href="<?php echo e(route('barang.index')); ?>" class="btn btn-light px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/barang/create.blade.php ENDPATH**/ ?>