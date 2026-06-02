
<?php $__env->startSection('konten'); ?>
<div class="card shadow col-md-6 mx-auto">
    <div class="card-header bg-warning text-dark"><h5>Edit Data Barang</h5></div>
    <div class="card-body">
        <form action="<?php echo e(route('barang.update', $barang->id_barang)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="<?php echo e($barang->nama_barang); ?>" required>
            </div>
            <div class="mb-3">
                <label>Kategori Produk</label>
                <select name="kategori" class="form-select">
                    <option value="hijab" <?php echo e($barang->kategori == 'hijab' ? 'selected' : ''); ?>>Hijab</option>
                    <option value="baju" <?php echo e($barang->kategori == 'baju' ? 'selected' : ''); ?>>Baju</option>
                    <option value="celana" <?php echo e($barang->kategori == 'celana' ? 'selected' : ''); ?>>Celana</option>
                    <option value="sepatu" <?php echo e($barang->kategori == 'sepatu' ? 'selected' : ''); ?>>Sepatu</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?php echo e($barang->harga); ?>" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="<?php echo e($barang->stok); ?>" required>
            </div>
            <div class="mb-3">
                <label>Foto Produk (Kosongkan jika tidak ingin ganti)</label>
                <br>
                <img src="<?php echo e(asset('images/'.$barang->gambar)); ?>" width="100" class="mb-2 rounded">
                <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
            <a href="<?php echo e(route('barang.index')); ?>" class="btn btn-secondary w-100 mt-2">Batal</a>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/barang/edit.blade.php ENDPATH**/ ?>