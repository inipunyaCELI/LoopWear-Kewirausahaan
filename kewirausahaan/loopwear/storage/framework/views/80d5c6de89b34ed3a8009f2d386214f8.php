

<?php $__env->startSection('konten'); ?>
<style>
    /* Background sedikit lebih warm/pastel dibanding abu-abu biasa */
    body { background-color: #fcf9f9; }
    
    .success-page {
        font-family: 'Quicksand', sans-serif;
        max-width: 550px;
        margin: 80px auto;
        text-align: center;
        padding: 0 20px;
    }
    
    .success-card {
        background: #fff;
        border-radius: 24px; /* Lebih membulat halus */
        box-shadow: 0 15px 35px rgba(231, 153, 139, 0.08); /* Shadow warna pink transparan */
        padding: 50px 40px;
        border: 1px solid rgba(231, 153, 139, 0.15); /* Border sangat tipis */
        position: relative;
        overflow: hidden;
    }

    /* Garis dekorasi atas gradient (Pink ke Hijau Loopwear) */
    .card-decoration {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #E7998B, #f4c2bb, #556B2F);
    }
    
    /* Lingkaran lembut untuk tempat ikon */
    .success-icon-wrapper {
        width: 85px;
        height: 85px;
        background: #fff4f2; 
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px auto;
        animation: popIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        transform: scale(0);
        box-shadow: 0 0 0 10px rgba(231, 153, 139, 0.08); /* Efek cincin pudar di luar lingkaran */
    }

    /* Ikon Hati Estetik (SVG) */
    .success-icon-wrapper svg {
        color: #E7998B;
        width: 40px;
        height: 40px;
        fill: #E7998B;
    }
    
    .success-title {
        font-weight: 700;
        color: #556B2F; /* Pakai hijau gelap agar elegan */
        font-size: 1.6rem;
        margin-bottom: 12px;
        letter-spacing: 0.5px;
    }
    
    .success-desc {
        color: #777;
        margin-bottom: 35px;
        line-height: 1.7;
        font-size: 0.95rem;
    }
    
    /* Tombol Utama (Pill Shape) */
    .btn-home {
        background: #E7998B; 
        color: #fff;
        border: none;
        padding: 14px 40px;
        border-radius: 50px; /* Bikin melengkung sempurna */
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(231, 153, 139, 0.3); /* Glow pada tombol */
    }
    
    .btn-home:hover {
        background: #d68779;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(231, 153, 139, 0.4);
    }

    /* Animasi Lembut */
    @keyframes popIn {
        0% { transform: scale(0); opacity: 0; }
        80% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>

<div class="success-page pt-5 pb-5">
    <div class="success-card">
        
        <div class="card-decoration"></div>
        
        
        <div class="success-icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </div>
        
        <h2 class="success-title">Yay! Pesanan Berhasil ✨</h2>
        
        <p class="success-desc">
            Terima kasih telah berbelanja di <strong>LoopWear</strong>.<br>
            Pesanan kamu sedang kami proses dengan cinta 🎀. Rincian tagihan telah dikirimkan ke email kamu.
        </p>
        
        <div class="mt-2">
            <a href="/" class="btn-home">Lanjut Belanja</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/checkout_success.blade.php ENDPATH**/ ?>