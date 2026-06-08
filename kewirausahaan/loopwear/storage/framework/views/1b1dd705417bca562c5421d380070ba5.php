<?php $__env->startSection('konten'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap');

    .page-wrap { font-family: 'Quicksand', sans-serif; }

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
    .btn-back-dash:hover { background: #47510B; color: #fff24d; }

    /* FORM TAMBAH VOUCHER */
    .form-card {
        background: #fffde8;
        border: 1.5px solid #e8e0a0;
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 36px;
    }
    .form-card h5 {
        font-family: 'Fredoka One', cursive;
        color: #47510B;
        font-size: 1.3rem;
        margin-bottom: 20px;
    }
    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #47510B;
        margin-bottom: 4px;
    }
    .form-control, .form-select {
        border: 1.5px solid #c8d08a;
        border-radius: 10px;
        font-family: 'Quicksand', sans-serif;
        font-size: 0.9rem;
        transition: 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #47510B;
        box-shadow: 0 0 0 3px rgba(71,81,11,0.1);
    }
    .btn-tambah {
        background: #47510B;
        color: #fff24d;
        border: none;
        border-radius: 12px;
        padding: 10px 28px;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        transition: 0.2s;
        cursor: pointer;
    }
    .btn-tambah:hover { background: #363d08; }

    /* TABEL */
    .tbl-wrap {
        background: white;
        border-radius: 20px;
        border: 1px solid #eee;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }
    .tbl-voucher thead th {
        background: #fffde8;
        color: #47510B;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e8e0a0;
        padding: 14px 16px;
    }
    .tbl-voucher tbody td {
        font-size: 0.9rem;
        padding: 14px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f5f5f5;
        color: #333;
    }
    .tbl-voucher tbody tr:last-child td { border-bottom: none; }
    .tbl-voucher tbody tr:hover { background: #fafff0; }

    .kode-badge {
        background: #47510B;
        color: #fff24d;
        font-family: 'Fredoka One', cursive;
        font-size: 0.95rem;
        letter-spacing: 1px;
        padding: 4px 14px;
        border-radius: 8px;
        display: inline-block;
    }

    .badge-persen    { background: #e8f4fd; color: #1565c0; border-radius: 20px; padding: 3px 12px; font-size: 0.78rem; font-weight: 700; }
    .badge-nominal   { background: #e8f5e9; color: #2e7d32; border-radius: 20px; padding: 3px 12px; font-size: 0.78rem; font-weight: 700; }
    .badge-ongkir    { background: #fff3e0; color: #e65100; border-radius: 20px; padding: 3px 12px; font-size: 0.78rem; font-weight: 700; }

    .badge-aktif     { background: #e6f4ea; color: #2e7d32; border-radius: 20px; padding: 3px 12px; font-size: 0.78rem; font-weight: 700; }
    .badge-nonaktif  { background: #f5f5f5; color: #888; border-radius: 20px; padding: 3px 12px; font-size: 0.78rem; font-weight: 700; }
    .badge-target-new { background: #ede7f6; color: #673ab7; border-radius: 20px; padding: 3px 12px; font-size: 0.75rem; font-weight: 700; display: inline-block; margin-top: 4px; }

    /* TOMBOL AKSI */
    .btn-act {
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 0.78rem;
        border-radius: 20px;
        padding: 5px 14px;
        border: none;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-toggle-on  { background: #fff3e0; color: #e65100; border: 1.5px solid #e65100; }
    .btn-toggle-on:hover  { background: #e65100; color: white; }
    .btn-toggle-off { background: #e6f4ea; color: #2e7d32; border: 1.5px solid #2e7d32; }
    .btn-toggle-off:hover { background: #2e7d32; color: white; }
    .btn-hapus { background: transparent; color: #c0392b; border: 1.5px solid #c0392b; }
    .btn-hapus:hover { background: #c0392b; color: white; }

    .expired-text { color: #e65100; font-size: 0.8rem; font-weight: 700; }
    .valid-text   { color: #2e7d32; font-size: 0.8rem; }
    .unlimited-text { color: #aaa; font-size: 0.8rem; font-style: italic; }
</style>

<div class="container page-wrap py-5">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title m-0">🏷️ Kelola Voucher</h3>
        <a href="/dashboard" class="btn-back-dash">← Kembali ke Dashboard</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert rounded-3 mb-4 fw-bold" style="background:#e6f4ea; color:#2e7d32; border:none;">
            ✅ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="form-card">
        <h5>✨ Tambah Voucher Baru</h5>
        <form action="<?php echo e(route('admin.vouchers.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Kode Voucher</label>
                    <input type="text" name="kode" class="form-control" placeholder="cth: LOOPWEAR10" 
                           value="<?php echo e(old('kode')); ?>" required style="text-transform:uppercase;">
                    <?php $__errorArgs = ['kode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="text-danger"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Tipe Diskon</label>
                    <select name="tipe" id="tipeSelect" class="form-select" required onchange="toggleNilai()">
                        <option value="">-- Pilih --</option>
                        <option value="persen"       <?php echo e(old('tipe')=='persen'       ? 'selected' : ''); ?>>Persentase (%)</option>
                        <option value="nominal"      <?php echo e(old('tipe')=='nominal'      ? 'selected' : ''); ?>>Nominal (Rp)</option>
                        <option value="gratis_ongkir"<?php echo e(old('tipe')=='gratis_ongkir'? 'selected' : ''); ?>>Gratis Ongkir</option>
                    </select>
                    <?php $__errorArgs = ['tipe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="text-danger"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-2" id="kolomNilai">
                    <label class="form-label">Nilai Diskon</label>
                    <input type="number" name="nilai" class="form-control" placeholder="cth: 20" 
                           value="<?php echo e(old('nilai', 0)); ?>" min="0">
                    <?php $__errorArgs = ['nilai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="text-danger"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Min. Belanja (Rp)</label>
                    <input type="number" name="min_belanja" class="form-control" placeholder="0 = tidak ada" 
                           value="<?php echo e(old('min_belanja', 0)); ?>" min="0">
                </div>

                <div class="col-md-1">
                    <label class="form-label">Kuota</label>
                    <input type="number" name="kuota" class="form-control" placeholder="∞" 
                           value="<?php echo e(old('kuota')); ?>" min="1">
                    <small class="text-muted" style="font-size:0.73rem;">kosong = unlimited</small>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Berlaku Hingga</label>
                    <input type="date" name="berlaku_hingga" class="form-control" 
                           value="<?php echo e(old('berlaku_hingga')); ?>">
                    <small class="text-muted" style="font-size:0.73rem;">kosong = selamanya</small>
                </div>

                
                <div class="col-12 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="khusus_pengguna_baru" id="khususPenggunaBaru" value="1" <?php echo e(old('khusus_pengguna_baru') ? 'checked' : ''); ?> style="cursor: pointer; border-color: #c8d08a;">
                        <label class="form-check-label fw-bold" for="khususPenggunaBaru" style="cursor: pointer; color: #47510B; font-size: 0.88rem;">
                            🔒 Khusus Pengguna Baru (Hanya bisa diklaim oleh akun yang belum pernah memiliki riwayat transaksi sukses)
                        </label>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end mt-1">
                    <button type="submit" class="btn-tambah">+ Tambah Voucher</button>
                </div>
            </div>
        </form>
    </div>

    <div class="tbl-wrap">
        <table class="table tbl-voucher mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tipe</th>
                    <th>Nilai</th>
                    <th>Min. Belanja</th>
                    <th>Kuota</th>
                    <th>Terpakai</th>
                    <th>Berlaku Hingga</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <span class="kode-badge"><?php echo e($v->kode); ?></span>
                        
                        <?php if($v->khusus_pengguna_baru): ?>
                            <br><span class="badge-target-new">👤 User Baru</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if($v->tipe == 'persen'): ?>
                            <span class="badge-persen">% Persen</span>
                        <?php elseif($v->tipe == 'nominal'): ?>
                            <span class="badge-nominal">Rp Nominal</span>
                        <?php else: ?>
                            <span class="badge-ongkir">🚚 Ongkir</span>
                        <?php endif; ?>
                    </td>

                    <td class="fw-bold">
                        <?php if($v->tipe == 'persen'): ?>
                            <?php echo e($v->nilai); ?>%
                        <?php elseif($v->tipe == 'nominal'): ?>
                            Rp <?php echo e(number_format($v->nilai, 0, ',', '.')); ?>

                        <?php else: ?>
                            <span class="text-muted fst-italic">—</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if($v->min_belanja > 0): ?>
                            Rp <?php echo e(number_format($v->min_belanja, 0, ',', '.')); ?>

                        <?php else: ?>
                            <span class="unlimited-text">Tidak ada</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if($v->kuota !== null): ?>
                            <?php echo e($v->kuota); ?>

                        <?php else: ?>
                            <span class="unlimited-text">∞ Unlimited</span>
                        <?php endif; ?>
                    </td>

                    <td class="fw-bold" style="color:#47510B;"><?php echo e($v->terpakai); ?>x</td>

                    <td>
                        <?php if($v->berlaku_hingga): ?>
                            <?php if(\Carbon\Carbon::parse($v->berlaku_hingga)->isPast()): ?>
                                <span class="expired-text">⚠️ <?php echo e(\Carbon\Carbon::parse($v->berlaku_hingga)->format('d M Y')); ?></span>
                            <?php else: ?>
                                <span class="valid-text"><?php echo e(\Carbon\Carbon::parse($v->berlaku_hingga)->format('d M Y')); ?></span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="unlimited-text">Selamanya</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if($v->aktif): ?>
                            <span class="badge-aktif">✅ Aktif</span>
                        <?php else: ?>
                            <span class="badge-nonaktif">⏸ Nonaktif</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <a href="<?php echo e(route('admin.vouchers.toggle', $v->id)); ?>" 
                               class="btn-act <?php echo e($v->aktif ? 'btn-toggle-on' : 'btn-toggle-off'); ?>">
                                <?php echo e($v->aktif ? 'Nonaktifkan' : 'Aktifkan'); ?>

                            </a>

                            <form action="<?php echo e(route('admin.vouchers.destroy', $v->id)); ?>" method="POST"
                                  onsubmit="return confirm('Yakin hapus voucher <?php echo e($v->kode); ?>?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-act btn-hapus">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center py-5 text-muted fst-italic">
                        Belum ada voucher. Tambahkan voucher pertama di atas!
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
function toggleNilai() {
    const tipe = document.getElementById('tipeSelect').value;
    const kolom = document.getElementById('kolomNilai');
    const input = kolom.querySelector('input');

    if (tipe === 'gratis_ongkir') {
        kolom.style.opacity = '0.4';
        input.disabled = true;
        input.value = 0;
    } else {
        kolom.style.opacity = '1';
        input.disabled = false;
    }
}

document.querySelector('input[name="kode"]').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

toggleNilai();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/vouchers/index.blade.php ENDPATH**/ ?>