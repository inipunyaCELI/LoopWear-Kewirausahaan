<?php $__env->startSection('konten'); ?>
<style>
    .cart-title { font-family: 'Fredoka One', cursive; color: #47510B; letter-spacing: 1px; margin-top: 40px; }
    
    .cart-header { color: #888; font-weight: 700; font-size: 0.85rem; border-bottom: 2px solid #f4f4f4; padding-bottom: 15px; }

    .cart-item { border-bottom: 1px solid #eee; padding: 25px 0; transition: 0.3s; }
    .cart-item:hover { background-color: #fafafa; }
    .product-name { font-weight: 700; color: #333; margin-bottom: 2px; }
    .product-variant { font-size: 0.8rem; color: #999; }

    .qty-control { display: flex; align-items: center; gap: 15px; justify-content: center; }
    .btn-qty {
        width: 28px; height: 28px;
        border-radius: 50%;
        border: 1px solid #ddd;
        background: white;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: bold;
        transition: 0.2s;
    }
    .btn-qty:hover { border-color: #47510B; color: #47510B; background: #f9f9f9; }

    .price-subtotal { color: #AB1717; font-weight: 800; font-size: 1.1rem; }
    .btn-remove { color: #ccc; text-decoration: none; font-size: 1.2rem; transition: 0.3s; }
    .btn-remove:hover { color: #AB1717; }

    .cart-footer {
        position: sticky;
        bottom: 0;
        background: white;
        box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
        padding: 20px 0;
        margin-top: 50px;
        z-index: 100;
    }
    .btn-checkout {
        background-color: #47510B;
        color: #fff24d !important;
        padding: 12px 50px;
        border-radius: 8px;
        font-family: 'Quicksand', sans-serif;
        font-weight: 800;
        border: none;
        transition: 0.3s;
        cursor: pointer;
    }
    .btn-checkout:hover { background-color: #363d08; transform: translateY(-2px); }
    .hover-danger:hover { color: #AB1717 !important; }

    .voucher-input {
        border: 1.5px solid #47510B;
        border-radius: 10px;
        padding: 8px 16px;
        font-family: 'Quicksand', sans-serif;
        font-size: 0.9rem;
        outline: none;
        width: 220px;
        transition: 0.2s;
    }
    .voucher-input:focus { border-color: #E7998B; box-shadow: 0 0 0 3px rgba(231,153,139,0.15); }

    .btn-voucher {
        background: #47510B;
        color: #fff24d;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-voucher:hover { background: #363d08; }

    .voucher-aktif-box {
        background: #f6ffe8;
        border: 1.5px solid #47510B;
        border-radius: 10px;
        padding: 10px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        transition: 0.3s;
    }

    .diskon-row {
        font-family: 'Quicksand', sans-serif;
        font-size: 0.85rem;
    }
</style>

<div class="container pb-5">
    <h2 class="cart-title mb-5">YOUR CART</h2>

    <div class="row cart-header d-none d-md-flex text-center">
        <div class="col-md-1 text-start">
            <input type="checkbox" id="checkAll" class="form-check-input" checked>
        </div>
        <div class="col-md-4 text-start">Produk</div>
        <div class="col-md-2">Harga Satuan</div>
        <div class="col-md-2">Kuantitas</div>
        <div class="col-md-2">Total Harga</div>
        <div class="col-md-1">Aksi</div>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="row cart-item align-items-center text-center">
        <div class="col-md-1 text-start">
            <input type="checkbox" 
                   class="item-check form-check-input" 
                   name="selected[]" 
                   value="<?php echo e($id); ?>"
                   data-price="<?php echo e($item['harga']); ?>" 
                   data-qty="<?php echo e($item['qty']); ?>" 
                   checked 
                   form="formCheckout">
        </div>
        
        <div class="col-md-4 d-flex align-items-center text-start">
            <img src="<?php echo e(asset('images/'.$item['gambar'])); ?>" width="90" class="rounded shadow-sm me-3" alt="Produk">
            <div>
                <div class="product-name"><?php echo e($item['nama']); ?></div>
                <div class="product-variant">Variasi: Default</div>
            </div>
        </div>

        <div class="col-md-2 text-muted">
            Rp <?php echo e(number_format($item['harga'],0,',','.')); ?>

        </div>

        <div class="col-md-2">
            <div class="qty-control">
                <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST" class="d-flex align-items-center gap-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" name="action" value="decrease" class="btn-qty">-</button>
                    <span class="fw-bold"><?php echo e($item['qty']); ?></span>
                    <button type="submit" name="action" value="increase" class="btn-qty">+</button>
                </form>
            </div>
        </div>

        <div class="col-md-2 price-subtotal">
            Rp <?php echo e(number_format($item['harga'] * $item['qty'],0,',','.')); ?>

        </div>

        <div class="col-md-1">
            <a href="<?php echo e(route('cart.remove', $id)); ?>" class="btn-remove">×</a>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="text-center py-5">
        <p class="text-muted">Keranjang belanja kamu masih kosong.</p>
        <a href="/products" class="btn btn-outline-dark btn-sm">Belanja Sekarang</a>
    </div>
    <?php endif; ?>
</div>

<div class="cart-footer">
    
    <div class="container mb-3">
        <?php if(session('voucher')): ?>
            <div class="d-flex justify-content-end">
                <div class="voucher-aktif-box">
                    <span class="fw-bold" style="color:#47510B; font-family:'Quicksand',sans-serif; font-size:0.9rem;">
                        🏷️ <strong><?php echo e(session('voucher.kode')); ?></strong>
                        <?php if(session('voucher.tipe') == 'persen'): ?>
                            — diskon <?php echo e(session('voucher.nilai')); ?>%
                        <?php elseif(session('voucher.tipe') == 'nominal'): ?>
                            — potongan Rp <?php echo e(number_format(session('voucher.nilai'),0,',','.')); ?>

                        <?php elseif(session('voucher.tipe') == 'gratis_ongkir'): ?>
                            — gratis ongkir
                        <?php endif; ?>
                    </span>
                    <a href="<?php echo e(route('cart.voucher.remove')); ?>" class="text-danger small fw-bold text-decoration-none ms-3">✕ Hapus</a>
                </div>
            </div>
        <?php else: ?>
            <form action="<?php echo e(route('cart.voucher')); ?>" method="POST" class="d-flex justify-content-end gap-2">
                <?php echo csrf_field(); ?>
                <input type="text" name="kode" placeholder="Punya kode voucher?" 
                       value="<?php echo e(old('kode')); ?>"
                       class="voucher-input">
                <button type="submit" class="btn-voucher">Pakai</button>
            </form>
        <?php endif; ?>

        <?php if(session('voucher_error')): ?>
            <p class="text-end text-danger small mt-1 mb-0 fw-bold">⚠️ <?php echo e(session('voucher_error')); ?></p>
        <?php endif; ?>
        <?php if(session('voucher_success')): ?>
            <p class="text-end small mt-1 mb-0 fw-bold" style="color:#47510B;">✅ <?php echo e(session('voucher_success')); ?></p>
        <?php endif; ?>
    </div>

    
    
    <span id="diskonVoucher" 
          data-tipe="<?php echo e(session('voucher.tipe', '')); ?>" 
          data-nilai="<?php echo e(session('voucher.nilai', 0)); ?>" 
          data-min="<?php echo e(session('voucher.min_belanja', 0)); ?>" 
          style="display:none;"></span>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 d-flex align-items-center gap-4">
                <label class="text-muted" style="cursor:pointer; font-family:'Quicksand',sans-serif;">
                    Total Items (<span id="countSelected"><?php echo e(count($cart)); ?></span>)
                </label>
                
                <form id="formRemoveSelected" action="<?php echo e(route('cart.remove_selected')); ?>" method="POST" style="display:none;">
                    <?php echo csrf_field(); ?>
                    <div id="hiddenRemoveInputs"></div>
                </form>

                <button type="button" onclick="hapusTerpilih()" 
                        class="btn btn-link text-muted small text-decoration-none p-0 border-0 hover-danger" 
                        style="font-weight:600; font-family:'Quicksand',sans-serif;">
                    Hapus Terpilih
                </button>
            </div>
            
            <div class="col-md-6 d-flex justify-content-end align-items-center gap-5">
                <div class="text-end">
                    
                    <div id="barisDiskon" style="display:none;" class="diskon-row mb-1">
                        <span class="text-muted">Subtotal: Rp <span id="totalAsli">0</span></span><br>
                        <span class="fw-bold" style="color:#47510B;">🏷️ Diskon: -Rp <span id="nilaiDiskon">0</span></span>
                    </div>
                    <span class="text-muted d-block small">Total Pembayaran:</span>
                    <span class="fw-bold fs-3" style="color:#AB1717;">Rp <span id="totalHarga">0</span></span>
                </div>
                
                <?php if(auth()->guard()->check()): ?>
                    <form id="formCheckout" action="<?php echo e(route('checkout.index')); ?>" method="GET">
                        <button type="submit" class="btn-checkout">Checkout</button>
                    </form>
                <?php else: ?>
                    <button type="button" class="btn-checkout" onclick="wajibLogin()">Checkout</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function hitungTotal() {
    let total = 0;
    const checkedItems = document.querySelectorAll('.item-check:checked');
    const allItems    = document.querySelectorAll('.item-check');
    const checkAll    = document.getElementById('checkAll');

    checkedItems.forEach(item => {
        total += parseInt(item.dataset.price) * parseInt(item.dataset.qty);
    });

    const countSelected = document.getElementById('countSelected');
    if (countSelected) {
        countSelected.innerText = checkedItems.length;
    }

    const diskonEl = document.getElementById('diskonVoucher');
    const tipeDiskon = diskonEl?.dataset.tipe || '';
    const nilaiDiskonRaw = parseFloat(diskonEl?.dataset.nilai || 0);
    const minBelanja = parseInt(diskonEl?.dataset.min || 0);

    let diskon = 0;

    if (total >= minBelanja && total > 0) {
        if (tipeDiskon === 'persen') {
            diskon = (total * nilaiDiskonRaw) / 100; 
        } else if (tipeDiskon === 'nominal') {
            diskon = nilaiDiskonRaw;
            if (diskon > total) diskon = total; 
        }
    }

    const finalTotal = Math.max(0, total - diskon);

    const barisDiskon = document.getElementById('barisDiskon');
    const voucherBox = document.querySelector('.voucher-aktif-box');

    if (diskon > 0) {
        if(barisDiskon) barisDiskon.style.display = 'block';
        document.getElementById('totalAsli').innerText  = total.toLocaleString('id-ID');
        document.getElementById('nilaiDiskon').innerText = diskon.toLocaleString('id-ID');
        
        if(voucherBox) voucherBox.style.opacity = '1'; 
    } else {
        if(barisDiskon) barisDiskon.style.display = 'none';
        
        // Redupkan kotak voucher jika sedang dicentang tapi total belanja kurang dari minimum
        if(voucherBox && minBelanja > 0 && total < minBelanja) {
            voucherBox.style.opacity = '0.5';
        } else if (voucherBox) {
            voucherBox.style.opacity = '1';
        }
    }

    document.getElementById('totalHarga').innerText = finalTotal.toLocaleString('id-ID');

    if (allItems.length > 0) {
        checkAll.checked = (checkedItems.length === allItems.length);
    } else if (checkAll) {
        checkAll.checked = false;
    }
}

function hapusTerpilih() {
    const checkedItems = document.querySelectorAll('.item-check:checked');
    
    if (checkedItems.length === 0) {
        Swal.fire({
            title: 'Oops!',
            text: 'Pilih minimal 1 barang dulu untuk dihapus ya.',
            icon: 'warning',
            confirmButtonColor: '#47510B'
        });
        return;
    }

    Swal.fire({
        title: 'Yakin hapus barang?',
        text: 'Barang yang dicentang akan dibuang dari tas belanja.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#AB1717',
        cancelButtonColor: '#888',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        customClass: { popup: 'rounded-4' }
    }).then((result) => {
        if (result.isConfirmed) {
            const hiddenContainer = document.getElementById('hiddenRemoveInputs');
            hiddenContainer.innerHTML = '';
            checkedItems.forEach(item => {
                let input = document.createElement('input');
                input.type  = 'hidden';
                input.name  = 'selected[]';
                input.value = item.value;
                hiddenContainer.appendChild(input);
            });
            document.getElementById('formRemoveSelected').submit();
        }
    });
}

function wajibLogin() {
    Swal.fire({
        title: 'Login Dulu Yuk! 🔐',
        text: 'Kamu harus masuk ke akunmu dulu buat lanjutin pesanan ini.',
        icon: 'info',
        iconColor: '#E7998B',
        showCancelButton: true,
        confirmButtonColor: '#47510B',
        cancelButtonColor: '#888',
        confirmButtonText: 'Login Sekarang',
        cancelButtonText: 'Nanti Aja',
        customClass: { popup: 'rounded-4' }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/login';
        }
    });
}

hitungTotal();

document.querySelectorAll('.item-check').forEach(el => {
    el.addEventListener('change', hitungTotal);
});

const checkAllElement = document.getElementById('checkAll');
if (checkAllElement) {
    checkAllElement.addEventListener('change', function () {
        document.querySelectorAll('.item-check').forEach(el => {
            el.checked = this.checked;
        });
        hitungTotal();
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/cart.blade.php ENDPATH**/ ?>