<?php $__env->startSection('konten'); ?>
<style>
    body { background-color: #f8f9fa; }
    .payment-page { font-family: 'Quicksand', sans-serif; max-width: 800px; margin: 0 auto; padding-bottom: 50px; }
    
    .payment-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.05);
        padding: 30px;
        margin-top: 30px;
    }

    /* Header Navigasi */
    .header-nav { display: flex; align-items: center; gap: 15px; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 25px; }
    .header-nav h4 { margin: 0; font-weight: 600; color: #333; }
    .back-btn { color: #555; text-decoration: none; font-size: 1.2rem; }

    /* Rincian Atas */
    .detail-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px dashed #eee; padding-bottom: 15px; }
    .text-orange { color: #ee4d2d !important; font-weight: 600; }
    .text-muted-small { font-size: 0.85rem; color: #888; }

    /* Kotak QRIS & VA */
    .qris-box { text-align: center; margin: 30px 0; }
    .qris-img { max-width: 250px; border: 1px solid #ddd; border-radius: 10px; padding: 10px; margin-bottom: 15px; }
    
    .va-box { background: #fafafa; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #eee; }
    .va-number { font-size: 1.8rem; color: #ee4d2d; font-weight: bold; letter-spacing: 2px; }
    .btn-copy { border: none; background: transparent; color: #00bfa5; font-weight: bold; cursor: pointer; }

    /* Petunjuk Pembayaran */
    .instruction-title { font-weight: 600; font-size: 1.1rem; margin-top: 30px; margin-bottom: 15px; }
    .instruction-list { list-style: none; padding-left: 0; color: #666; font-size: 0.95rem; }
    .instruction-list li { margin-bottom: 12px; display: flex; gap: 10px; align-items: flex-start; }
    .step-number { background: #ddd; color: #fff; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 0.75rem; font-weight: bold; flex-shrink: 0; margin-top: 2px; }

    /* Tombol Midtrans Asli */
    .btn-midtrans { background: #556B2F; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-weight: bold; transition: 0.3s; width: 100%; margin-top: 20px; }
    .btn-midtrans:hover { background: #425522; }
</style>

<div class="payment-page pt-4">
    <div class="payment-card">
        
        
        <div class="header-nav">
            <a href="<?php echo e(route('cart.index')); ?>" class="back-btn">←</a>
            <h4>Pembayaran</h4>
        </div>

        
        <div class="detail-row">
            <span>Total Pembayaran</span>
            <span class="text-orange fs-5">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></span>
        </div>
        <div class="detail-row">
            <span>Bayar dalam</span>
            <div class="text-end">
                <div class="text-orange" id="countdown">23 : 59 : 59</div>
                <div class="text-muted-small">Jatuh tempo <span id="duedate"></span></div>
            </div>
        </div>

        
        <?php if($payment_method == 'qris'): ?>
            <div class="qris-box">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS" width="100" class="mb-3">
                <br>
                
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=LoopWear-<?php echo e($order->order_number); ?>" class="qris-img" alt="QR Code">
                <p class="fw-bold text-muted">NMID: ID2025444802321</p>
            </div>

            <div class="instruction-title">Petunjuk Pembayaran QRIS</div>
            <ul class="instruction-list">
                <li><span class="step-number">1</span> Buka aplikasi e-wallet atau m-banking kamu (ShopeePay, GoPay, OVO, Dana, BCA mobile, dll).</li>
                <li><span class="step-number">2</span> Pilih menu <strong>Scan QR</strong>.</li>
                <li><span class="step-number">3</span> Arahkan kamera ke Kode QR di atas atau unggah screenshot QR tersebut.</li>
                <li><span class="step-number">4</span> Periksa nama merchant (LoopWear) dan pastikan nominal sudah sesuai.</li>
                <li><span class="step-number">5</span> Masukkan PIN dan selesaikan pembayaran.</li>
            </ul>


        <?php elseif($payment_method == 'transfer'): ?>
            <?php
                // Kita buat data dinamis untuk masing-masing bank
                $bankData = [
                    'bca' => ['nama' => 'Bank BCA', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg', 'va' => '112233445566'],
                    'mandiri' => ['nama' => 'Bank Mandiri', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg', 'va' => '899012345678'],
                    'bni' => ['nama' => 'Bank BNI', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/512px-BNI_logo.svg.png', 'va' => '827364519203'],
                    'bri' => ['nama' => 'Bank BRI', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/BRI_2020.svg', 'va' => '102938475612'],
                    'bsi' => ['nama' => 'Bank Syariah Indonesia (BSI)', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg', 'va' => '60008115541331'],
                    'lainnya' => ['nama' => 'Bank Lainnya (Transfer Antar Bank)', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/05/Credit_card_icon.svg', 'va' => '00001234567890']
                ];
                
                // Ambil data bank sesuai yang dipilih user, default ke BSI
                $selectedBank = $bankData[$bank] ?? $bankData['bsi'];
            ?>

            <div class="mt-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="<?php echo e($selectedBank['logo']); ?>" height="25" alt="<?php echo e($selectedBank['nama']); ?>">
                    <span class="fw-bold"><?php echo e($selectedBank['nama']); ?></span>
                </div>
                
                <div class="va-box">
                    <p class="mb-1 text-muted">No. Rekening / Virtual Account</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="va-number"><?php echo e($selectedBank['va']); ?></span>
                        <button class="btn-copy" onclick="alert('Nomor VA berhasil disalin!')">SALIN</button>
                    </div>
                </div>
                <p class="text-muted-small" style="color: #00bfa5 !important;">Proses verifikasi kurang dari 10 menit setelah pembayaran berhasil</p>
            </div>

            <div class="instruction-title">Petunjuk Transfer Virtual Account <?php echo e($selectedBank['nama']); ?></div>
            <ul class="instruction-list">
                <li><span class="step-number">1</span> Masuk dan login ke aplikasi m-banking atau internet banking kamu.</li>
                <li><span class="step-number">2</span> Pilih menu <strong>Transfer</strong> lalu pilih <strong>Virtual Account</strong>.</li>
                <li><span class="step-number">3</span> Masukkan nomor Virtual Account <strong><?php echo e($selectedBank['va']); ?></strong>, dan klik Lanjutkan.</li>
                <li><span class="step-number">4</span> Periksa informasi di layar. Pastikan nama merchant adalah LoopWear.</li>
                <li><span class="step-number">5</span> Masukkan PIN dan tunggu transaksimu selesai diproses.</li>
            </ul>

        
            <?php elseif($payment_method == 'cod'): ?>
            <div class="qris-box py-5">
                <h1 style="font-size: 4rem;">📦</h1>
                <h4 class="text-orange mt-3">Bayar di Tempat (COD)</h4>
                <p class="text-muted">Pesananmu akan segera dikemas dan dikirim.<br>Silakan siapkan uang tunai sebesar <strong>Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></strong> saat kurir datang.</p>
            </div>
        <?php endif; ?>

        
        <hr class="my-4">
        <p class="text-center text-muted-small mb-2">PENTING: Karena ini sistem percobaan, silakan klik tombol di bawah untuk memproses pembayaran sesungguhnya melalui Midtrans Gateway.</p>
        <button id="pay-button" class="btn-midtrans">Verifikasi Pembayaran via Midtrans</button>
    </div>
</div>


<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>
<script>
    // Trigger pop-up Midtrans saat tombol diklik
    document.getElementById('pay-button').onclick = function(){
        snap.pay('<?php echo e($snapToken); ?>', {
            // Jika pembayaran berhasil
            onSuccess: function(result){
                window.location.href = "<?php echo e(route('checkout.success')); ?>";
            },
            // Jika pembayaran tertunda (misal pilih transfer VA)
            onPending: function(result){
                window.location.href = "<?php echo e(route('checkout.success')); ?>"; 
            },
            // Jika pembayaran gagal
            onError: function(result){
                alert("Pembayaran gagal! Silakan coba lagi.");
            },
            // Jika pop-up ditutup tanpa bayar
            onClose: function(){
                alert("Kamu menutup halaman sebelum menyelesaikan pembayaran.");
            }
        });
    };

    // Tanggal Jatuh Tempo (Besok)
    let tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    document.getElementById('duedate').innerText = tomorrow.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute:'2-digit' });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/payment.blade.php ENDPATH**/ ?>