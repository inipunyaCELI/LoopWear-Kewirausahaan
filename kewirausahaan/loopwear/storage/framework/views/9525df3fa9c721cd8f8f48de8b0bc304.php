<?php $__env->startSection('konten'); ?>
<style>
    /* Import font Quicksand untuk teks bodi dan Fredoka One untuk judul */
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;500;600;700&display=swap');

    .about-heading {
        font-family: 'Fredoka One', cursive;
        letter-spacing: 1px;
    }

    .about-text {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        text-align: justify; 
    }

    .about-quote {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.15rem;
        font-style: italic;
        color: #555;
        font-weight: 500;
        text-align: center;
    }

    /* --- STYLE BARU UNTUK LIST AGAR SANGAT RAPI (HANGING INDENT PERFECT) --- */
    
    /* List Angka (Misi) */
    .custom-ol {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.1rem;
        color: #555;
        line-height: 1.8;
        list-style: none; /* Matikan angka bawaan HTML */
        counter-reset: angka-misi; /* Buat penghitung angka otomatis di CSS */
        padding-left: 0;
        margin: 0;
        max-width: 600px; /* Batasan lebar teks */
    }

    .custom-ol li {
        position: relative;
        margin-bottom: 15px; /* Jarak antar poin */
        padding-left: 25px; /* Memberi ruang khusus untuk letak angka di kiri */
    }

    .custom-ol li::before {
        content: counter(angka-misi) "."; /* Memanggil angka */
        counter-increment: angka-misi;
        position: absolute; /* Kunci posisi angka di kiri */
        left: 0;
        top: 0;
        font-weight: 600; /* Sedikit ditebalkan agar jelas */
    }

    /* List Centang (Kenapa Memilih LoopWear) */
    .custom-ul {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.1rem;
        color: #555;
        line-height: 1.8;
        list-style: none; 
        padding-left: 0;
        margin: 0;
        max-width: 500px;
    }

    .custom-ul li {
        position: relative;
        margin-bottom: 15px;
        padding-left: 35px; /* Ruang khusus untuk tanda centang */
    }

    .custom-ul li::before {
        content: '✓';
        color: #FFB6A9;
        font-weight: bold;
        font-size: 1.2rem;
        position: absolute;
        left: 0;
        top: -2px; /* Menyesuaikan tinggi centang dengan huruf */
    }
</style>

<div class="container py-5">
    
    <div class="text-center mb-5 mt-4">
        <img src="<?php echo e(asset('images/logo_loop.png')); ?>" alt="Loop Logo" style="max-width: 300px;" class="mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="about-text mb-4">
                    <strong>LoopWear</strong> adalah usaha yang bergerak di bidang penjualan pakaian preloved berkualitas yang masih layak pakai dan tetap stylish. LoopWear hadir dengan tujuan memberikan kesempatan kedua bagi pakaian agar tetap bisa digunakan dan tidak terbuang sia-sia.
                </p>
                <p class="about-text">
                    Kami percaya bahwa fashion tidak harus selalu baru untuk tetap terlihat menarik. Dengan memilih pakaian preloved, kita tidak hanya bisa mendapatkan pakaian dengan harga yang lebih terjangkau, tetapi juga ikut berkontribusi dalam mengurangi limbah fashion dan mendukung gaya hidup yang lebih ramah lingkungan.
                </p>
            </div>
        </div>
    </div>

    
    <div class="row justify-content-center pt-3">
        <div class="col-md-8">
            
            
            <h2 class="text-center mb-3 about-heading" style="color: #6A8EAE;">Visi</h2>
            <p class="mb-5 about-quote">
                "Menjadi platform penjualan pakaian preloved yang terpercaya dan membantu meningkatkan kesadaran masyarakat tentang pentingnya fashion berkelanjutan."
            </p>

            
            <h2 class="text-center mb-4 about-heading" style="color: #E7998B;">Misi</h2>
            
            <div class="d-flex justify-content-center mb-5">
                <ol class="custom-ol">
                    <li>Menyediakan pakaian preloved berkualitas dengan harga terjangkau.</li>
                    <li>Memberikan alternatif fashion yang lebih ramah lingkungan.</li>
                    <li>Membantu memperpanjang siklus penggunaan pakaian agar tidak terbuang sia-sia.</li>
                    <li>Memberikan pengalaman belanja online yang mudah dan nyaman.</li>
                </ol>
            </div>

            
            <h2 class="text-center mb-4 about-heading" style="color: #FFB6A9;">Kenapa Memilih LoopWear?</h2>
            <div class="d-flex justify-content-center">
                <ul class="custom-ul">
                    <li>Pakaian preloved yang masih berkualitas</li>
                    <li>Harga lebih terjangkau dibanding pakaian baru</li>
                    <li>Mendukung sustainable fashion</li>
                    <li>Produk dipilih dengan seleksi yang teliti</li>
                </ul>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\loopwear\resources\views/about.blade.php ENDPATH**/ ?>