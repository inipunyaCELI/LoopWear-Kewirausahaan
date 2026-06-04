<?php $__env->startSection('konten'); ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0" style="color: #4A4A4A;">Kelola Pesanan</h3>
        <a href="/dashboard" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success rounded-3 mb-4 d-flex align-items-center gap-2">
            ✅ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Order ID</th>
                            <th>Pembeli</th>
                            <th>Tanggal</th>
                            <th>Total Belanja</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"><?php echo e($index + 1); ?></td>
                            <td class="fw-bold text-primary"><?php echo e($order->order_number); ?></td>
                            <td>
                                <div class="fw-bold"><?php echo e($order->user->name ?? 'Guest'); ?></div>
                                <small class="text-muted"><?php echo e($order->user->email ?? '-'); ?></small>
                            </td>
                            <td><?php echo e($order->created_at->format('d M Y, H:i')); ?></td>
                            <td class="fw-bold text-danger">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                            <td>
                                <?php if($order->status_payment == 'success'): ?>
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Sukses</span>
                                <?php elseif($order->status_payment == 'pending'): ?>
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Pending</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill"><?php echo e($order->status_payment); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    <!-- Lihat Detail -->
                                    <a href="<?php echo e(route('admin.orders.detail', $order->id)); ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 shadow-sm">
                                        🔍 Detail
                                    </a>

                                    <?php if($order->status_payment == 'success'): ?>
                                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm" target="_blank">
                                            🖨️ Cetak
                                        </a>

                                        <?php if($order->status_delivery == 'process' || $order->status_delivery == 'pending'): ?>
                                            <form action="<?php echo e(route('admin.orders.updateStatus', $order->id)); ?>" method="POST" onsubmit="return confirm('Tandai pesanan ini sebagai dikirim?');">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status_delivery" value="dikirim">
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                                                    📦 Kirim
                                                </button>
                                            </form>
                                        <?php elseif($order->status_delivery == 'dikirim'): ?>
                                            <button class="btn btn-sm btn-info rounded-pill px-3 text-white" disabled>Sedang Dikirim</button>
                                        <?php elseif($order->status_delivery == 'selesai'): ?>
                                            <button class="btn btn-sm btn-secondary rounded-pill px-3" disabled>Selesai</button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-secondary rounded-pill px-3" disabled>Belum Lunas</button>
                                    <?php endif; ?>

                                    <?php if($order->status_payment != 'dibatalkan' && $order->status_delivery != 'dibatalkan'): ?>
                                        <form action="<?php echo e(route('admin.orders.cancel', $order->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm">
                                                Batalkan
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted fst-italic">Belum ada pesanan masuk.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>