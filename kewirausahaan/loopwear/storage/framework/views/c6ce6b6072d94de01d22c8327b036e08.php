<?php $__env->startSection('konten'); ?>
<style>
    .page-title {
        font-family: 'Fredoka One', cursive;
        color: #47510B;
        font-size: 1.8rem;
    }
    .btn-back-dash {
        background: transparent;
        border: 2px solid #47510B;
        color: #47510B;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        border-radius: 15px;
        padding: 8px 20px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-back-dash:hover {
        background: #47510B;
        color: #fff24d;
    }
    .tbl-order thead th {
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        color: #47510B;
        border-bottom: 2px solid #e8e8e8;
        background: #fffde8;
    }
    .order-id-link {
        color: #47510B;
        font-weight: 700;
        text-decoration: none;
    }
    .order-id-link:hover { color: #E7998B; }

    /* tombol aksi */
    .btn-act {
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 0.78rem;
        border-radius: 20px;
        padding: 5px 14px;
        border: none;
        transition: 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-detail   { background: #f5f5f5; color: #47510B; border: 1.5px solid #47510B; }
    .btn-detail:hover { background: #47510B; color: #fff24d; }

    .btn-cetak    { background: #8CABFF; color: #1a2f80; border: 1.5px solid #8CABFF; }
    .btn-cetak:hover { background: #6a8fe0; color: #fff; }

    .btn-kirim    { background: #47510B; color: #fff24d; }
    .btn-kirim:hover { background: #363d08; }

    .btn-dikirim  { background: #E7998B; color: #fff; cursor: default; opacity: 0.85; }
    .btn-selesai  { background: #d4d4d4; color: #666; cursor: default; }
    .btn-belumlunas { background: #f5f5f5; color: #aaa; border: 1.5px solid #ddd; cursor: default; }

    .btn-batal    { background: transparent; color: #c0392b; border: 1.5px solid #c0392b; }
    .btn-batal:hover { background: #c0392b; color: #fff; }

    /* badge status */
    .badge-sukses   { background: #e6f4ea; color: #2e7d32; border-radius: 20px; padding: 4px 14px; font-size: 0.78rem; font-weight: 700; }
    .badge-pending  { background: #fff8e1; color: #b45309; border-radius: 20px; padding: 4px 14px; font-size: 0.78rem; font-weight: 700; }
    .badge-lainnya  { background: #f0f0f0; color: #666; border-radius: 20px; padding: 4px 14px; font-size: 0.78rem; font-weight: 700; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title m-0">Kelola Pesanan</h3>
        <a href="/dashboard" class="btn-back-dash">← Kembali ke Dashboard</a>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success rounded-3 mb-4">✅ <?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle tbl-order">
                    <thead>
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
                            <td><span class="order-id-link"><?php echo e($order->order_number); ?></span></td>
                            <td>
                                <div class="fw-bold" style="font-family:'Quicksand',sans-serif;"><?php echo e($order->user->name ?? 'Guest'); ?></div>
                                <small class="text-muted"><?php echo e($order->user->email ?? '-'); ?></small>
                            </td>
                            <td style="font-family:'Quicksand',sans-serif;"><?php echo e($order->created_at->format('d M Y, H:i')); ?></td>
                            <td class="fw-bold" style="color:#E7998B; font-family:'Quicksand',sans-serif;">
                                Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

                            </td>
                            <td>
                                <?php if($order->status_payment == 'success'): ?>
                                    <span class="badge-sukses">Sukses</span>
                                <?php elseif($order->status_payment == 'pending'): ?>
                                    <span class="badge-pending">Pending</span>
                                <?php else: ?>
                                    <span class="badge-lainnya"><?php echo e($order->status_payment); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap align-items-center">
                                    <a href="<?php echo e(route('admin.orders.detail', $order->id)); ?>" class="btn-act btn-detail">🔍 Detail</a>

                                    <?php if($order->status_payment == 'success'): ?>
                                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn-act btn-cetak" target="_blank">🖨️ Cetak</a>

                                        <?php if($order->status_delivery == 'process' || $order->status_delivery == 'pending'): ?>
                                            <form action="<?php echo e(route('admin.orders.updateStatus', $order->id)); ?>" method="POST" onsubmit="return confirm('Tandai pesanan ini sebagai dikirim?');">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status_delivery" value="dikirim">
                                                <button type="submit" class="btn-act btn-kirim">📦 Kirim</button>
                                            </form>
                                        <?php elseif($order->status_delivery == 'dikirim'): ?>
                                            <span class="btn-act btn-dikirim">🚚 Sedang Dikirim</span>
                                        <?php elseif($order->status_delivery == 'selesai'): ?>
                                            <span class="btn-act btn-selesai">✅ Selesai</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="btn-act btn-belumlunas">Belum Lunas</span>
                                    <?php endif; ?>

                                    <?php if($order->status_payment != 'dibatalkan' && $order->status_delivery != 'dibatalkan'): ?>
                                        <form action="<?php echo e(route('admin.orders.cancel', $order->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn-act btn-batal">Batalkan</button>
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
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>