<?php $__env->startSection('konten'); ?>
<style>
    /* Background halaman dibuat abu-abu agar kotak checkout menonjol ala Shopee */
    body { background-color: #f8f9fa; }
    .checkout-page { font-family: 'Quicksand', sans-serif; color: #333; padding-bottom: 50px; }

    /* Tombol Kembali */
    .btn-back {
        color: #556B2F; /* Grassy Green */
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        margin-bottom: 20px;
        transition: 0.3s;
    }
    .btn-back:hover { transform: translateX(-5px); color: #E7998B; }

    /* Card Section ala Shopee */
    .checkout-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 20px;
        padding: 25px 30px;
    }

    /* Garis atas ala amplop surat */
    .address-card { border-top: 5px solid #E7998B; }

    /* Header tiap kotak */
    .section-title { font-family: 'Fredoka One', cursive; color: #556B2F; font-size: 1.3rem; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .section-title.pink { color: #E7998B; }

    /* Input Form Custom */
    .form-loop { border: 1px solid #ddd; border-radius: 8px; padding: 12px 15px; width: 100%; transition: 0.3s; font-family: 'Quicksand', sans-serif; }
    .form-loop:focus { border-color: #556B2F; outline: none; box-shadow: 0 0 0 3px rgba(85, 107, 47, 0.1); }

    /* Tabel Produk */
    .table-produk { width: 100%; border-collapse: collapse; }
    .table-produk th { color: #888; font-weight: 600; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    .table-produk td { padding: 20px 0; border-bottom: 1px dashed #eee; vertical-align: middle; }

    /* Radio Button Pembayaran Custom */
    .payment-label { cursor: pointer; margin-right: 15px; margin-bottom: 10px; display: inline-block; }
    .payment-label input { display: none; }
    .payment-box { border: 1px solid #ddd; padding: 10px 20px; border-radius: 8px; transition: 0.3s; color: #555; font-weight: 600; background: #fff; }
    
    /* Efek saat diklik (Active) */
    .payment-label input:checked + .payment-box {
        border-color: #E7998B; /* Warna Pink LoopWear */
        color: #E7998B;
        background-color: #fffaf9;
        position: relative;
    }
    
    /* Tambahan centang merah kecil di sudut ala Shopee */
    .payment-label input:checked + .payment-box::after {
        content: '✔';
        position: absolute;
        bottom: 0;
        right: 0;
        background: #E7998B;
        color: white;
        font-size: 8px;
        padding: 2px 4px;
        border-radius: 4px 0 4px 0;
    }

    /* CSS DAFTAR BANK ALA SHOPEE */
    .bank-list-wrapper {
        display: none; /* Disembunyikan secara default */
        border-top: 1px solid #f0f0f0;
        margin-top: 25px;
        padding-top: 25px;
    }
    .bank-item {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
        cursor: pointer;
    }
    .bank-item input[type="radio"] {
        accent-color: #ee4d2d; /* Warna merah radio button Shopee */
        width: 18px;
        height: 18px;
        margin-right: 15px;
        cursor: pointer;
    }
    .bank-logo {
        width: 45px;
        height: 30px;
        object-fit: contain;
        margin-right: 15px;
        border: 1px solid #eee;
        border-radius: 4px;
        padding: 3px;
        background: #fff;
    }
    .bank-name { font-size: 0.95rem; color: #333; }
    .bank-name small { display: block; color: #888; font-size: 0.8rem; margin-top: 2px; }

    /* Ringkasan Pembayaran */
    .summary-text { color: #777; font-size: 0.95rem; }
    .summary-total { font-size: 1.8rem; font-weight: bold; color: #E7998B; }
    .btn-pesanan { background: #E7998B; color: #fff; font-family: 'Quicksand', sans-serif; font-weight: bold; padding: 12px 45px; border-radius: 8px; border: none; font-size: 1.1rem; transition: 0.3s; }
    .btn-pesanan:hover { background: #d68779; color: #fff; }
</style>

<div class="container checkout-page pt-4">
    
    <a href="<?php echo e(route('cart.index')); ?>" class="btn-back">← Kembali ke Keranjang</a>

    <form action="<?php echo e(route('checkout.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php $__currentLoopData = $selected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" name="selected[]" value="<?php echo e($id); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <div class="checkout-card address-card">
            <div class="section-title pink">📍 Alamat Pengiriman</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="nama" class="form-loop" placeholder="Nama Lengkap Penerima" value="<?php echo e(auth()->check() ? auth()->user()->name : ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-loop" placeholder="Email / No. Handphone" value="<?php echo e(auth()->check() ? auth()->user()->email : ''); ?>" required>
                </div>
                <div class="col-12">
                    <textarea name="alamat" class="form-loop" rows="3" placeholder="Alamat Lengkap (Nama Jalan, RT/RW, Kec., Kota, Kode Pos)" required><?php echo e(auth()->check() ? auth()->user()->alamat ?? '' : ''); ?></textarea>
                </div>
            </div>
        </div>

        
        <div class="checkout-card">
            <div class="section-title">Produk Dipesan</div>
            <table class="table-produk">
                <thead>
                    <tr>
                        <th class="text-start">Produk</th>
                        <th class="text-center">Harga Satuan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Subtotal Produk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $checkout_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 50px; height: 50px; background: #eee; border-radius: 8px; overflow: hidden;">
                                    <img src="<?php echo e(asset('images/' . ($item['gambar'] ?? 'no-image.png'))); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div><span class="fw-bold text-dark d-block"><?php echo e($item['nama']); ?></span></div>
                            </div>
                        </td>
                        <td class="text-center text-muted">Rp <?php echo e(number_format($item['harga'], 0, ',', '.')); ?></td>
                        <td class="text-center"><?php echo e($item['qty']); ?></td>
                        <td class="text-end fw-bold text-dark">Rp <?php echo e(number_format($item['harga'] * $item['qty'], 0, ',', '.')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
            <div class="row mt-4 align-items-center border-top pt-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fw-bold">Pesan:</span>
                        <input type="text" name="pesan" class="form-loop" style="padding: 8px 15px;" placeholder="(Opsional) Tinggalkan pesan...">
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <span class="text-muted me-3">Opsi Pengiriman:</span>
                    <span class="fw-bold" style="color: #556B2F;">Reguler (Rp 10.000)</span>
                </div>
            </div>
        </div>

        
        <div class="checkout-card">
            
            
            <div class="border-bottom pb-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="section-title mb-0" style="font-size: 1.1rem;">Metode Pembayaran</div>
                    </div>
                    <div class="col-md-9">
                        <label class="payment-label">
                            
                            <input type="radio" name="payment" value="qris" class="payment-radio" checked>
                            <div class="payment-box">QRIS</div>
                        </label>
                        <label class="payment-label">
                            <input type="radio" name="payment" value="transfer" class="payment-radio">
                            <div class="payment-box">Transfer Bank</div>
                        </label>
                        <label class="payment-label">
                            <input type="radio" name="payment" value="cod" class="payment-radio">
                            <div class="payment-box">COD</div>
                        </label>
                    </div>
                </div>

                
                <div class="row bank-list-wrapper" id="bank-list-wrapper">
                    <div class="col-md-3">
                        <div class="section-title mb-0" style="font-size: 1rem; color: #333; font-family: 'Quicksand', sans-serif;">Pilih Bank</div>
                    </div>
                    <div class="col-md-9">
                        
                        <label class="bank-item">
                            <input type="radio" name="bank" value="bca">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="bank-logo" alt="BCA">
                            <span class="bank-name">Bank BCA</span>
                        </label>

                        <label class="bank-item">
                            <input type="radio" name="bank" value="mandiri">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" class="bank-logo" alt="Mandiri">
                            <span class="bank-name">Bank Mandiri</span>
                        </label>

                        <label class="bank-item">
                            <input type="radio" name="bank" value="bni">
                            <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/512px-BNI_logo.svg.png" class="bank-logo" alt="BNI">
                            <span class="bank-name">Bank BNI</span>
                        </label>
                        <label class="bank-item">
                            <input type="radio" name="bank" value="bri">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/BRI_2020.svg" class="bank-logo" alt="BRI">
                            <span class="bank-name">Bank BRI</span>
                        </label>

                        <label class="bank-item">
                            <input type="radio" name="bank" value="bsi" checked>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg" class="bank-logo" alt="BSI">
                            <span class="bank-name">Bank Syariah Indonesia (BSI)</span>
                        </label>

                        <label class="bank-item">
                            <input type="radio" name="bank" value="lainnya">
                            <div class="bank-logo d-flex align-items-center justify-content-center" style="background: #f0f0f0;">
                                <span style="font-size: 1.2rem;">🏛️</span>
                            </div>
                            <span class="bank-name">
                                Bank lainnya
                                <small>Menerima transfer dari semua bank.</small>
                            </span>
                        </label>

                    </div>
                </div>
            </div>

            
            <div class="row justify-content-end text-end mt-2">
                <div class="col-md-5 col-lg-4">
                    <div class="d-flex justify-content-between mb-2 summary-text">
                        <span>Subtotal untuk Produk</span>
                        <span>Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 summary-text">
                        <span>Total Ongkos Kirim</span>
                        <span>Rp <?php echo e(number_format($ongkir, 0, ',', '.')); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 summary-text">
                        <span>Biaya Layanan</span>
                        <span>Rp <?php echo e(number_format($biaya_layanan, 0, ',', '.')); ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                        <span class="summary-text fs-5">Total Pembayaran</span>
                        <span class="summary-total">Rp <?php echo e(number_format($grand_total, 0, ',', '.')); ?></span>
                    </div>
                    <button type="submit" class="btn-pesanan w-100">Buat Pesanan</button>
                </div>
            </div>
        </div>

    </form>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const paymentRadios = document.querySelectorAll('.payment-radio');
        const bankListWrapper = document.getElementById('bank-list-wrapper');

        // Fungsi mengecek mana yang lagi dipilih
        function toggleBankList() {
            // Cari radio button yang sedang 'checked'
            const selectedPayment = document.querySelector('.payment-radio:checked').value;
            
            if (selectedPayment === 'transfer') {
                bankListWrapper.style.display = 'flex'; // Munculkan daftar bank
            } else {
                bankListWrapper.style.display = 'none'; // Sembunyikan
            }
        }

        // Jalankan saat halaman pertama kali diload
        toggleBankList();

        // Tambahkan event listener ke setiap tombol metode pembayaran
        paymentRadios.forEach(radio => {
            radio.addEventListener('change', toggleBankList);
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/checkout.blade.php ENDPATH**/ ?>