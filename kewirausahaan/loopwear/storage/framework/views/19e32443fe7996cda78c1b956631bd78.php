<?php $__env->startSection('konten'); ?>

<style>
    .detail-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .status-badge {
        font-size: 0.8rem;
        padding: 6px 16px;
        border-radius: 20px;
    }
    .section-title {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #aaa;
        margin-bottom: 12px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.92rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: #888; }
    .info-value { font-weight: 600; color: #333; }
    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .item-row:last-child { border-bottom: none; }
    .page-header {
        background: linear-gradient(135deg, #fff24d, #ffe08a);
        border-radius: 16px;
        padding: 24px 30px;
        margin-bottom: 24px;
    }
</style>

<div class="container py-5">

    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1" style="color: #4A4A4A;">📋 Detail Pesanan</h4>
            <p class="mb-0 text-muted fw-bold"><?php echo e($order->order_number); ?></p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                ← Kembali
            </a>
            <?php if($order->status_payment == 'success'): ?>
            <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-dark rounded-pill px-4" target="_blank">
                🖨️ Cetak Resi
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-4">

        <!-- Kolom Kiri: Info Pemesan -->
        <div class="col-lg-5">

            <!-- Info Pemesan -->
            <div class="card detail-card p-4 mb-4">
                <p class="section-title">👤 Data Pemesan</p>
                <div class="info-row">
                    <span class="info-label">Nama</span>
                    <span class="info-value"><?php echo e($order->user->name ?? 'Guest'); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?php echo e($order->user->email ?? '-'); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Alamat Pengiriman</span>
                    <span class="info-value text-end" style="max-width: 55%;"><?php echo e($order->address ?? 'Tidak dicantumkan'); ?></span>
                </div>
            </div>

            <!-- Status Pesanan -->
            <div class="card detail-card p-4">
                <p class="section-title">📊 Status Pesanan</p>
                <div class="info-row">
                    <span class="info-label">Tanggal Order</span>
                    <span class="info-value"><?php echo e($order->created_at->format('d M Y, H:i')); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status Pembayaran</span>
                    <span>
                        <?php if($order->status_payment == 'success'): ?>
                            <span class="badge bg-success status-badge">✅ Lunas</span>
                        <?php elseif($order->status_payment == 'pending'): ?>
                            <span class="badge bg-warning text-dark status-badge">⏳ Menunggu</span>
                        <?php elseif($order->status_payment == 'dibatalkan'): ?>
                            <span class="badge bg-danger status-badge">❌ Dibatalkan</span>
                        <?php else: ?>
                            <span class="badge bg-secondary status-badge"><?php echo e($order->status_payment); ?></span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status Pengiriman</span>
                    <span>
                        <?php if($order->status_delivery == 'pending'): ?>
                            <span class="badge bg-info text-dark status-badge">📦 Dikemas</span>
                        <?php elseif($order->status_delivery == 'dikirim'): ?>
                            <span class="badge bg-primary status-badge">🚚 Dikirim</span>
                        <?php elseif($order->status_delivery == 'selesai'): ?>
                            <span class="badge bg-success status-badge">✅ Selesai</span>
                        <?php elseif($order->status_delivery == 'dibatalkan'): ?>
                            <span class="badge bg-danger status-badge">❌ Dibatalkan</span>
                        <?php else: ?>
                            <span class="badge bg-secondary status-badge"><?php echo e($order->status_delivery); ?></span>
                        <?php endif; ?>
                    </span>
                </div>

                <!-- Aksi Update Status Admin -->
                <?php if($order->status_payment == 'success' && $order->status_delivery != 'dibatalkan' && $order->status_delivery != 'selesai'): ?>
                <div class="mt-3 pt-2">
                    <p class="section-title">⚙️ Ubah Status Pengiriman</p>
                    <form action="<?php echo e(route('admin.orders.updateStatus', $order->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="d-flex gap-2">
                            <select name="status_delivery" class="form-select rounded-pill" style="font-size: 0.9rem;">
                                <option value="pending" <?php echo e($order->status_delivery == 'pending' ? 'selected' : ''); ?>>Dikemas</option>
                                <option value="dikirim" <?php echo e($order->status_delivery == 'dikirim' ? 'selected' : ''); ?>>Dikirim</option>
                                <option value="selesai" <?php echo e($order->status_delivery == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">Simpan</button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Kolom Kanan: Barang yang Dibeli -->
        <div class="col-lg-7">
            <div class="card detail-card p-4">
                <p class="section-title">🛍️ Barang yang Dibeli</p>

                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item-row">
                    <div>
                        <p class="fw-bold mb-1"><?php echo e($item->nama_barang); ?></p>
                        <small class="text-muted"><?php echo e($item->qty); ?> pcs × Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></small>
                    </div>
                    <div class="fw-bold" style="color: #E7998B;">
                        Rp <?php echo e(number_format($item->qty * $item->harga, 0, ',', '.')); ?>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- Total -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 2px dashed #eee;">
                    <span class="fw-bold" style="font-size: 1rem;">Total Belanja</span>
                    <h4 class="fw-bold text-danger mb-0">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></h4>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/orders/detail.blade.php ENDPATH**/ ?>