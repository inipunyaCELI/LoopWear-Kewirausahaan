<?php $__env->startSection('konten'); ?>
<style>
    /* Tipografi */
    .admin-title { font-family: 'Fredoka One', cursive; color: #47510B; letter-spacing: 1px; }
    .table-text { font-family: 'Quicksand', sans-serif; font-weight: 600; color: #555; }

    /* Tombol Custom */
    .btn-back { 
        background-color: #47510B !important; 
        color: #fff24d !important; 
        border-radius: 12px; 
        font-weight: 700;
        border: none;
        transition: 0.3s;
    }
    .btn-back:hover { background-color: #363d08 !important; transform: translateX(-5px); }

    .btn-add { 
        background-color: #8CABFF !important; 
        color: white !important; 
        border-radius: 12px; 
        font-weight: 700;
        border: none;
    }
    .btn-add:hover { background-color: #7195f0 !important; }

    /* Tabel & Card */
    .custom-card { border-radius: 25px; border: none; overflow: hidden; }
    .table-container { background: white; border-radius: 25px; padding: 20px; }
    
    .table thead th {
        border-top: none;
        color: #E7998B; /* Beet Pink */
        font-family: 'Fredoka One', cursive;
        font-weight: normal;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .product-name { color: #47510B; font-weight: 800; }
    .price-tag { color: #AB1717; font-weight: 700; }

    /* Aksi */
    .btn-edit-soft { background-color: #FFF24D; color: #47510B; border: none; border-radius: 8px; font-weight: 700; }
    .btn-delete-soft { background-color: #FFB6A9; color: white; border: none; border-radius: 8px; font-weight: 700; }
</style>

<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="admin-title mb-0">KELOLA BARANG</h2>
        <a href="/dashboard" class="btn btn-back px-4 py-2 shadow-sm">
            ← Dashboard
        </a>
    </div>

    <div class="table-container shadow-sm">
        
        <div class="d-flex justify-content-between align-items-center mb-4 px-2">
            <h5 class="admin-title" style="font-size: 1.2rem; opacity: 0.7;">Koleksi Barang</h5>
            <a href="<?php echo e(route('barang.create')); ?>" class="btn btn-add px-4 shadow-sm">
                + Tambah Produk
            </a>
        </div>

        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="ps-3">Foto</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-text">
                    <?php $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="ps-3">
                            <div style="width: 70px; height: 70px; overflow: hidden; border-radius: 15px;" class="shadow-sm border">
                                <img src="<?php echo e(asset('images/'.$b->gambar)); ?>" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover;"
                                     onerror="this.onerror=null;this.src='<?php echo e(asset('images/no-image.png')); ?>';">
                            </div>
                        </td>
                        <td>
                            <div class="product-name"><?php echo e($b->nama_barang); ?></div>
                            <small class="text-muted">ID: #<?php echo e($b->id_barang); ?></small>
                        </td>
                        <td>
                            <span class="price-tag">Rp <?php echo e(number_format($b->harga, 0, ',', '.')); ?></span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill px-3 py-2" 
                                  style="background-color: #f8f9fa; color: #47510B; border: 1px solid #eee;">
                                <?php echo e($b->stok); ?>

                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?php echo e(route('barang.edit', $b->id_barang)); ?>" class="btn btn-edit-soft btn-sm px-3">
                                    Edit
                                </a>
                                <form action="<?php echo e(route('barang.destroy', $b->id_barang)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-delete-soft btn-sm px-3" onclick="return confirm('Yakin ingin menghapus <?php echo e($b->nama_barang); ?>?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/barang/index.blade.php ENDPATH**/ ?>