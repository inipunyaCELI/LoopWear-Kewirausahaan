<?php $__env->startSection('konten'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;500;600;700&display=swap');

    .about-heading {
        font-family: 'Fredoka One', cursive;
        letter-spacing: 1px;
    }

    .about-text {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.05rem;
        line-height: 1.9;
        color: #555;
        text-align: justify; 
    }

    .about-quote {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.1rem;
        font-style: italic;
        color: #6A8EAE;
        font-weight: 600;
        text-align: center;
        line-height: 1.8;
    }

    /* --- HERO ABOUT --- */
    .about-hero {
        background: linear-gradient(135deg, #fffde7 0%, #f9fbe7 100%);
        border-radius: 24px;
        padding: 50px 40px;
        text-align: center;
        margin-bottom: 50px;
        box-shadow: 0 4px 20px rgba(71, 81, 11, 0.07);
    }

    .about-tagline {
        font-family: 'Quicksand', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #47510B;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 20px;
        opacity: 0.7;
    }

    /* --- SECTION CARD --- */
    .about-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }

    .about-card-visi {
        border-top: 4px solid #6A8EAE;
    }

    .about-card-misi {
        border-top: 4px solid #E7998B;
    }

    .about-card-kenapa {
        border-top: 4px solid #fff24d;
    }

     .custom-ol {
        font-family: 'Quicksand', sans-serif;
        font-size: 1rem;
        color: #555;
        line-height: 1.8;
        list-style: none;
        counter-reset: angka-misi;
        padding-left: 0;
        margin: 0;
    }

    .custom-ol li {
        position: relative;
        margin-bottom: 12px;
        padding-left: 40px;
        padding-top: 2px;
    }

    .custom-ol li::before {
        content: counter(angka-misi);
        counter-increment: angka-misi;
        position: absolute;
        left: 0;
        top: 0;
        background-color: #E7998B;
        color: #fff;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.8rem;
    }

    .custom-ul {
        font-family: 'Quicksand', sans-serif;
        font-size: 1rem;
        color: #555;
        line-height: 1.8;
        list-style: none; 
        padding-left: 0;
        margin: 0;
    }

    .custom-ul li {
        position: relative;
        margin-bottom: 12px;
        padding-left: 40px; 
        padding-top: 2px;
    }

    .custom-ul li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: 0;
        background-color: #fff24d;
        color: #47510B;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.85rem; 
    }
</style>

<div class="container py-5">

    
    <div class="about-hero">
        <img src="<?php echo e(asset('images/logo_loop.png')); ?>" alt="Loop Logo" style="max-width: 220px;" class="mb-3">
        <p class="about-tagline">Preloved Fashion · Sustainable Style</p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="about-text mb-3">
                    <strong>LoopWear</strong> adalah usaha yang bergerak di bidang penjualan pakaian preloved berkualitas yang masih layak pakai dan tetap stylish. LoopWear hadir dengan tujuan memberikan kesempatan kedua bagi pakaian agar tetap bisa digunakan dan tidak terbuang sia-sia.
                </p>
                <p class="about-text mb-0">
                    Kami percaya bahwa fashion tidak harus selalu baru untuk tetap terlihat menarik. Dengan memilih pakaian preloved, kita tidak hanya bisa mendapatkan pakaian dengan harga yang lebih terjangkau, tetapi juga ikut berkontribusi dalam mengurangi limbah fashion dan mendukung gaya hidup yang lebih ramah lingkungan.
                </p>
            </div>
        </div>
    </div>

    
    <div class="row justify-content-center">
        <div class="col-md-8">

            
            <div class="about-card about-card-visi">
                <h2 class="text-center mb-4 about-heading" style="color: #6A8EAE;">Visi</h2>
                <p class="about-quote mb-0">
                    "Menjadi platform penjualan pakaian preloved yang terpercaya dan membantu meningkatkan kesadaran masyarakat tentang pentingnya fashion berkelanjutan."
                </p>
            </div>

            
            <div class="about-card about-card-misi">
                <h2 class="text-center mb-4 about-heading" style="color: #E7998B;">Misi</h2>
                <ol class="custom-ol">
                    <li>Menyediakan pakaian preloved berkualitas dengan harga terjangkau.</li>
                    <li>Memberikan alternatif fashion yang lebih ramah lingkungan.</li>
                    <li>Membantu memperpanjang siklus penggunaan pakaian agar tidak terbuang sia-sia.</li>
                    <li>Memberikan pengalaman belanja online yang mudah dan nyaman.</li>
                </ol>
            </div>

            
            <div class="about-card about-card-kenapa">
                <h2 class="text-center mb-4 about-heading" style="color: #47510B;">Kenapa Memilih LoopWear?</h2>
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
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/about.blade.php ENDPATH**/ ?>