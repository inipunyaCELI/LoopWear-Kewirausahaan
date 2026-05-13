<?php $__env->startSection('konten'); ?>
<style>
    .cart-title { font-family: 'Fredoka One', cursive; color: #47510B; letter-spacing: 1px; margin-top: 40px; }
    
    /* Tabel Header */
    .cart-header { color: #888; font-weight: 700; font-size: 0.85rem; border-bottom: 2px solid #f4f4f4; padding-bottom: 15px; }

    /* Baris Produk */
    .cart-item { border-bottom: 1px solid #eee; padding: 25px 0; transition: 0.3s; }
    .cart-item:hover { background-color: #fafafa; }
    .product-name { font-weight: 700; color: #333; margin-bottom: 2px; }
    .product-variant { font-size: 0.8rem; color: #999; }

    /* Tombol Quantity Bulat */
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

    /* Harga & Total */
    .price-subtotal { color: #AB1717; font-weight: 800; font-size: 1.1rem; }
    .btn-remove { color: #ccc; text-decoration: none; font-size: 1.2rem; transition: 0.3s; }
    .btn-remove:hover { color: #AB1717; }

    /* Floating Footer Checkout */
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
        background-color: #AB1717; /* Beet Red dari paletmu */
        color: white !important;
        padding: 12px 50px;
        border-radius: 8px;
        font-weight: 800;
        border: none;
        transition: 0.3s;
    }
    .btn-checkout:hover { background-color: #8a1212; transform: translateY(-2px); }
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
            <img src="<?php echo e(asset('images/'.$item['gambar'])); ?>" width="90" class="rounded shadow-sm me-3">
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
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 d-flex align-items-center gap-4">
                <div class="form-check">
                    <label class="form-check-label text-muted" style="cursor:pointer">
                        Total Items (<?php echo e(count($cart)); ?>)
                    </label>
                </div>
                <a href="#" class="text-muted small text-decoration-none hover-danger">Remove Selected</a>
            </div>
            
            <div class="col-md-6 d-flex justify-content-end align-items-center gap-5">
                <div class="text-end">
                    <span class="text-muted d-block small">Total Pembayaran:</span>
                    <span class="fw-bold fs-3" style="color: #AB1717;">Rp <span id="totalHarga">0</span></span>
                </div>
                
                <form id="formCheckout" action="<?php echo e(route('checkout.index')); ?>" method="GET">
                    <button type="submit" class="btn-checkout">
                        Checkout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function hitungTotal() {
    let total = 0;
    let checkedItems = document.querySelectorAll('.item-check:checked');
    let allItems = document.querySelectorAll('.item-check');
    let checkAll = document.getElementById('checkAll');

    // Menghitung total harga hanya untuk yang dicentang
    checkedItems.forEach(item => {
        let price = parseInt(item.dataset.price);
        let qty = parseInt(item.dataset.qty);
        total += price * qty;
    });

    // Update tampilan total harga
    document.getElementById('totalHarga').innerText = total.toLocaleString('id-ID');

    // LOGIKA SINKRONISASI: 
    // Jika jumlah yang dicentang sama dengan total produk, maka 'All' menyala. 
    // Jika ada yang tidak dicentang, 'All' mati.
    if (allItems.length > 0) {
        checkAll.checked = (checkedItems.length === allItems.length);
    } else {
        checkAll.checked = false;
    }
}

// Jalankan fungsi saat halaman pertama kali dibuka
hitungTotal();

// Listener untuk checkbox produk individu
document.querySelectorAll('.item-check').forEach(el => {
    el.addEventListener('change', hitungTotal);
});

// Listener untuk checkbox 'Check All' di bagian atas
document.getElementById('checkAll').addEventListener('change', function() {
    document.querySelectorAll('.item-check').forEach(el => {
        el.checked = this.checked;
    });
    hitungTotal();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\semester 2\kewir\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/cart.blade.php ENDPATH**/ ?>