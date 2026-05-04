
<?php $__env->startSection('konten'); ?>
<div class="card shadow">
    <div class="d-flex justify-content-between mb-3">
        <h3>Kelola Barang</h3>

        <a href="/dashboard" class="btn btn-dark">
            ← Kembali ke Dashboard
        </a>
    </div>
    <div class="card-header d-flex justify-content-between bg-white">
        <h5>Koleksi Barang</h5>
        <a href="<?php echo e(route('barang.create')); ?>" class="btn btn-primary btn-sm">+ Tambah</a>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    <?php $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td>
            <img src="<?php echo e(asset('images/'.$b->gambar)); ?>" width="70" height="70" style="object-fit: cover;" class="rounded border"
                 onerror="this.onerror=null;this.src='<?php echo e(asset('images/no-image.png')); ?>';">
        </td>
        <td><strong><?php echo e($b->nama_barang); ?></strong></td>
        <td>Rp <?php echo e(number_format($b->harga, 0, ',', '.')); ?></td>
        <td><?php echo e($b->stok); ?></td>
        <td>
            <a href="<?php echo e(route('barang.edit', $b->id_barang)); ?>" class="btn btn-warning btn-sm">Edit</a>
            <form action="<?php echo e(route('barang.destroy', $b->id_barang)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/barang/index.blade.php ENDPATH**/ ?>