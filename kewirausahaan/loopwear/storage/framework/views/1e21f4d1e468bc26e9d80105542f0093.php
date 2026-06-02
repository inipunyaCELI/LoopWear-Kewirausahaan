

<?php $__env->startSection('konten'); ?>

<div class="container mt-5 text-center">

    <h3>Finalisasi Pesanan</h3>

    <p>Order ID: <?php echo e($order->id); ?></p>
    <p>Total: Rp <?php echo e(number_format($order->total_price)); ?></p>

    <button id="pay-button" class="btn btn-primary">
        Bayar Sekarang
    </button>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>

<script>
    document.getElementById('pay-button').onclick = function(){
        snap.pay('<?php echo e($snapToken); ?>', {
            // Optional
            onSuccess: function(result){
                window.location.href = '/pesanan'; // Sesuaikan dengan route halaman sukses kamu
            },
            // Optional
            onPending: function(result){
                window.location.href = '/pesanan'; // Sesuaikan dengan route halaman pending kamu
            },
            // Optional
            onError: function(result){
                window.location.href = '/'; // Sesuaikan dengan route halaman error kamu
            },
            // Optional
            onClose: function(){
                alert('Kamu menutup popup tanpa menyelesaikan pembayaran.');
            }
        });
    };
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/payment.blade.php ENDPATH**/ ?>