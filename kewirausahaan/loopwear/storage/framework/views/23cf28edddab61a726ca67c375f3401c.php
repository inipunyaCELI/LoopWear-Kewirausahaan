<?php $__env->startSection('konten'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* =========================================
       0. GLOBAL STYLING
       ========================================= */
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Quicksand', sans-serif;
        color: #333;
    }

    .section-title {
        font-family: 'Fredoka One', cursive;
        color: #333;
        font-size: 1.8rem;
    }

    /* =========================================
       1. HERO SECTION STYLING (Pertahankan)
       ========================================= */
    .hero-section {
        transition: background-color 0.8s ease-in-out;
        overflow: hidden; 
    }

    #hero-title, #order-btn {
        transition: color 0.5s ease, background-color 0.5s ease;
    }

    .hero-thumbs img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: transparent;
        border: none;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.15)) grayscale(30%);
    }

    .hero-thumbs img.active {
        transform: scale(1.25) translateY(-8px);
        filter: drop-shadow(0 12px 18px rgba(0,0,0,0.3)) grayscale(0%);
    }

    .hero-right-col {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 500px;
    }

    .main-hero-img {
        z-index: 10;
        max-width: 60%; 
        max-height: 380px;
        object-fit: contain;
        transition: opacity 0.4s ease, transform 0.5s ease;
        filter: drop-shadow(0 15px 25px rgba(0,0,0,0.25));
    }

    .img-fade-in {
        animation: fadeInZoom 0.6s ease forwards;
    }

    @keyframes fadeInZoom {
        0% { opacity: 0; transform: scale(0.85); }
        100% { opacity: 1; transform: scale(1); }
    }

    .floater {
        position: absolute;
        z-index: 5;
        max-width: 65px; 
        object-fit: contain;
        transition: all 0.8s ease-in-out;
        animation: floatAnimation 3s infinite ease-in-out alternate;
        filter: drop-shadow(0 8px 12px rgba(0,0,0,0.2));
    }

    .floater-1 { top: 5%; left: 5%; animation-delay: 0s; }
    .floater-2 { bottom: 10%; left: 10%; animation-delay: 1s; }
    .floater-3 { bottom: 10%; right: 5%; animation-delay: 0.5s; }

    @keyframes floatAnimation {
        0% { transform: translateY(0px) rotate(0deg); }
        100% { transform: translateY(-15px) rotate(5deg); }
    }

    #hero-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 450px;
        height: 450px;
        z-index: 1;
        transition: background 0.8s ease;
        border-radius: 50%;
    }

    #view-menu-btn {
        background-color: transparent;
        border: 2px solid #47510B; 
        color: #47510B;
        transition: all 0.3s ease;
    }

    #view-menu-btn:hover, #view-menu-btn:active {
        background-color: #47510B; 
        color: #fffacf; 
        border-color: #47510B;
    }

    /* =========================================
       3. more-ways-to-save STYLING (Carousel Poster)
       ========================================= */
    .save-carousel {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }
    
    .save-poster {
        background-color: #fdf5e6; /* Krem pastel */
        min-height: 150px; /* Lebih pendek dari banner utama */
        display: flex;
        align-items: center;
        padding: 20px 40px;
    }

    .save-text h3 {
        font-weight: 800;
        color: #e27d60; 
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .save-text p {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 10px;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        opacity: 0.7;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(1); /* Bikin panahnya jadi gelap */
    }

    /* =========================================
       4. most-wanted-picks STYLING (Best Sellers Grid)
       ========================================= */
    .best-seller-section {
        background-color: #e6eeb1; /* Hijau Pastel Zalora */
        border-radius: 15px;
        padding: 40px 20px;
    }

    .section-thrift-edit {
        background-color: #b8cc58;
        border-radius: 15px;
        padding: 50px 30px;
        color: white;
        text-align: center;
    }

    .just-for-you-section {
        background-color: #ffe5e5;
        border-radius: 15px;
        padding: 40px 20px;
    }

    /* Komponen Produk Proper Ala Zalora */
    .product-grid-card {
        border: none;
        background: transparent;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .product-img-box {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 30px 20px;
        position: relative;
        text-align: center;
        margin-bottom: 15px;
        transition: box-shadow 0.3s ease;
        height: 200px; /* Tinggi fix agar seragam */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-grid-card:hover .product-img-box {
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    .grid-img {
        height: 100%;
        max-height: 160px;
        object-fit: contain;
    }

    .btn-wishlist-grid {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 1.2rem;
        color: #bbb;
        transition: color 0.2s ease, transform 0.2s ease;
        cursor: pointer;
        padding: 0;
        line-height: 1;
    }

    .btn-wishlist-grid:hover {
        color: #F29C9C;
        transform: scale(1.2);
    }

    /* State aktif: sudah masuk wishlist */
    .btn-wishlist-grid.wishlisted,
    .btn-wishlist-grid.wishlisted:hover {
        color: #e74c3c;
    }

    /* Form wishlist tidak menggeser layout */
    .product-img-box form[action*="wishlist"] {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        line-height: 0;
    }

    .product-brand {
        font-weight: 800;
        font-size: 0.9rem;
        margin-bottom: 2px;
        color: #333;
    }

    .product-name {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-price-discount {
        color: #c9302c; /* Merah Bold */
        font-weight: 800;
        font-size: 1.1rem;
        margin-right: 8px;
    }

    .product-price-ori {
        text-decoration: line-through;
        color: #999;
        font-size: 0.85rem;
    }

    .btn-grid-action {
        width: 100%;
        background-color: transparent;
        border: 1px solid #ccc;
        color: #333;
        padding: 8px;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        margin-top: auto; /* Tombol selalu di paling bawah */
        cursor: pointer;
    }

    .btn-grid-action:hover {
        border-color: #47510B;
        background-color: #47510B;
        color: white;
    }

    /* Form keranjang agar full width */
    .product-grid-card > form {
        width: 100%;
    }

    /* Animasi Toast Notifikasi */
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeOut {
        from { opacity: 1; }
        to   { opacity: 0; transform: translateY(10px); }
    }

</style>

<section id="hero-section" class="hero-section" style="min-height: 100vh;">
    <div class="container pt-5">
        <div class="row align-items-center" style="min-height: 80vh;">
            
            
            <div class="col-md-6">
                <h1 id="hero-title" class="display-3 fw-bold mb-3" style="font-family: 'Fredoka One', cursive;">
                    Hijab LoopWear
                </h1>
                <p id="hero-desc" class="lead mb-4 text-dark" style="opacity: 0.8;">
                    Hijab premium, lembut, siap bikin outfit makin glowing.
                </p>
                <div class="d-flex gap-3 mb-5">
                    <a href="#products-start" id="order-btn" class="btn rounded-pill px-4 py-2 fw-bold shadow border-0">ORDER NOW</a>
                    <a href="#products-start" id="view-menu-btn" class="btn rounded-pill px-4 py-2 fw-bold">VIEW PRODUCTS</a>
                </div>

                
                <div class="d-flex gap-4 hero-thumbs align-items-center">
                    <img src="<?php echo e(asset('images/hijab_pink.png')); ?>" onclick="changeHero('hijab', this)" class="active">
                    <img src="<?php echo e(asset('images/baju.png')); ?>" onclick="changeHero('baju', this)">
                    <img src="<?php echo e(asset('images/celana.png')); ?>" onclick="changeHero('celana', this)">
                    <img src="<?php echo e(asset('images/sepatu.png')); ?>" onclick="changeHero('sepatu', this)">
                </div>
            </div> 

            
            <div class="col-md-6 hero-right-col">
                
                <div id="hero-glow"></div>

                
                <img id="floater-1" src="" class="floater floater-1">
                <img id="floater-2" src="" class="floater floater-2">
                <img id="floater-3" src="" class="floater floater-3">

                
                <img id="hero-img" src="" class="position-relative main-hero-img" alt="Produk Utama">
            </div> 

        </div> 
    </div> 
</section>

<div id="products-start"></div>

<div class="container mt-5 pt-4">
    <h3 class="text-center section-title mb-4"></h3>
    
    <div id="saveCarousel" class="carousel slide save-carousel shadow-sm" data-bs-ride="carousel">
        <div class="carousel-inner">
            
            <div class="carousel-item active">
                <div class="save-poster">
                    <div class="row align-items-center w-100">
                        <div class="col-md-2 p-0">
                             <img src="<?php echo e(asset('images/jenius.png')); ?>" alt="Jenius" class="img-fluid" style="max-height: 50px;">
                        </div>
                        <div class="col-md-6 save-text px-md-4">
                            <h3>TUMPUK PROMO 50 RIBU</h3>
                            <p class="mb-0">Pakai kartu Jenius, potongan langsung + voucher.</p>
                            <small class="text-muted" style="font-size: 0.75rem;">Periode: 1 - 31 Des 2023</small>
                        </div>
                        <div class="col-md-4 text-md-end p-0">
                            <a href="#" class="btn btn-outline-dark rounded-0 px-4 py-2 fw-bold" style="font-size: 0.85rem;">KLAIM VOUCHER ></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="carousel-item">
                <div class="save-poster" style="background-color: #eaf4f4;">
                    <div class="row align-items-center w-100">
                        <div class="col-md-8 save-text">
                            <h3 style="color: #47510B;">GAJIAN SURPRISE!</h3>
                            <p class="mb-0">Potongan harga otomatis di keranjang untuk koleksi tertentu.</p>
                            <small class="text-muted" style="font-size: 0.75rem;">Tanpa Kode Voucher</small>
                        </div>
                        <div class="col-md-4 text-md-end p-0">
                             <img src="<?php echo e(asset('images/baju.png')); ?>" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="save-poster" style="background-color: #fffaf0;">
                    <div class="row align-items-center w-100">
                        <div class="col-md-3 p-0">
                             <img src="<?php echo e(asset('images/sepatu.png')); ?>" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                        </div>
                        <div class="col-md-9 save-text px-md-4">
                            <h3>NEW ARRIVAL: SNEAKERS SERIES</h3>
                            <p class="mb-0">Koleksi sepatu preloved hits, rilis malam ini.</p>
                            <a href="#" class="text-dark fw-bold text-decoration-underline" style="font-size: 0.85rem;">BELI SEKARANG ></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#saveCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#saveCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>



<div class="container mt-5 pt-4">
    <div class="best-seller-section shadow">
        <h3 class="text-center section-title mb-5">Most Wanted Picks</h3>
        <div class="row g-4">

            <?php $__empty_1 = true; $__currentLoopData = $most_wanted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-6 col-md-3">
                <div class="product-grid-card">
                    <div class="product-img-box">
                        
                        <form action="<?php echo e(route('wishlist.add', $item->id_barang)); ?>" method="POST" style="display:inline; position:absolute; top:15px; right:15px; z-index:10;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-wishlist-grid <?php echo e(isset(session('wishlist')[$item->id_barang]) ? 'wishlisted' : ''); ?>" title="Tambah ke Wishlist">
                                <i class="<?php echo e(isset(session('wishlist')[$item->id_barang]) ? 'fas' : 'far'); ?> fa-heart"></i>
                            </button>
                        </form>
                        <img src="<?php echo e(asset('images/' . $item->gambar)); ?>"
                             class="grid-img"
                             alt="<?php echo e($item->nama_barang); ?>"
                             onerror="this.onerror=null;this.src='<?php echo e(asset('images/no-image.png')); ?>';">
                    </div>
                    <div class="product-info mb-3 px-1">
                        <div class="product-brand"><?php echo e(strtoupper($item->kategori)); ?></div>
                        <div class="product-name"><?php echo e($item->nama_barang); ?></div>
                        <div>
                            <span class="product-price-discount">Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></span>
                        </div>
                    </div>
                    
                    <form action="<?php echo e(route('cart.add', $item->id_barang)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-grid-action">Masukkan dalam keranjang</button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center text-muted fst-italic py-4">Belum ada produk tersedia.</div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- THE THRIFT EDIT -->
<div class="container mt-5 pt-4">
    <div class="section-thrift-edit shadow-sm">
        <i class="fas fa-leaf mb-3" style="font-size: 2.5rem; color: white;"></i>
        <h2 class="fw-bold mb-3" style="font-family: 'Fredoka One', cursive; letter-spacing: 1px;">THE THRIFT EDIT</h2>
        <p class="mb-0 mx-auto" style="max-width: 600px; font-weight: 500;">
            Look good and feel good with our curated preloved collection.<br>
            Explore fashion picks carefully crafted to help reduce impact on our planet.
        </p>
    </div>
</div>

<div class="container mt-5 pt-4 mb-5">
    <div class="just-for-you-section shadow">
        <h3 class="text-center section-title mb-5" style="color: #c9302c;">Just For You</h3>
        <div class="row g-4">

        <?php $__empty_1 = true; $__currentLoopData = $just_for_you; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-6 col-md-3">
            <div class="product-grid-card">
                <div class="product-img-box">
                    
                    <form action="<?php echo e(route('wishlist.add', $item->id_barang)); ?>" method="POST" style="display:inline; position:absolute; top:15px; right:15px; z-index:10;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-wishlist-grid <?php echo e(isset(session('wishlist')[$item->id_barang]) ? 'wishlisted' : ''); ?>" title="Tambah ke Wishlist">
                            <i class="<?php echo e(isset(session('wishlist')[$item->id_barang]) ? 'fas' : 'far'); ?> fa-heart"></i>
                        </button>
                    </form>
                    <img src="<?php echo e(asset('images/' . $item->gambar)); ?>"
                         class="grid-img"
                         alt="<?php echo e($item->nama_barang); ?>"
                         onerror="this.onerror=null;this.src='<?php echo e(asset('images/no-image.png')); ?>';">
                </div>
                <div class="product-info mb-3 px-1">
                    <div class="product-brand"><?php echo e(strtoupper($item->kategori)); ?></div>
                    <div class="product-name"><?php echo e($item->nama_barang); ?></div>
                    <div>
                        <span class="product-price-discount">Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></span>
                    </div>
                </div>
                
                <form action="<?php echo e(route('cart.add', $item->id_barang)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-grid-action">Masukkan dalam keranjang</button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center text-muted fst-italic py-4">Belum ada produk tersedia.</div>
        <?php endif; ?>

        </div>
    </div>

    <div class="text-center mt-5">
        <a href="/products" class="btn btn-outline-dark rounded-pill px-5 py-2 fw-bold" style="border-width: 2px;">Lihat Semua Produk</a>
    </div>
</div>


<?php if(session('success')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.createElement('div');
        toast.innerHTML = `
            <div id="toast-notif" style="
                position: fixed; bottom: 30px; right: 30px; z-index: 9999;
                background: #47510B; color: white;
                padding: 14px 22px; border-radius: 12px;
                font-family: 'Quicksand', sans-serif; font-weight: 700;
                box-shadow: 0 8px 24px rgba(0,0,0,0.2);
                display: flex; align-items: center; gap: 10px;
                animation: slideIn 0.4s ease;
            ">
                <i class="fas fa-heart" style="color:#F29C9C; font-size:1.2rem;"></i>
                <?php echo e(session('success')); ?>

            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            const el = document.getElementById('toast-notif');
            if (el) el.style.animation = 'fadeOut 0.5s ease forwards';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    });
</script>
<?php endif; ?>

<?php if(session('success_cart')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.createElement('div');
        toast.innerHTML = `
            <div id="toast-cart" style="
                position: fixed; bottom: 30px; right: 30px; z-index: 9999;
                background: #2c7a7b; color: white;
                padding: 14px 22px; border-radius: 12px;
                font-family: 'Quicksand', sans-serif; font-weight: 700;
                box-shadow: 0 8px 24px rgba(0,0,0,0.2);
                display: flex; align-items: center; gap: 10px;
                animation: slideIn 0.4s ease;
            ">
                <i class="fas fa-shopping-cart" style="color:#b2f5ea; font-size:1.2rem;"></i>
                <?php echo e(session('success_cart')); ?>

            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            const el = document.getElementById('toast-cart');
            if (el) el.style.animation = 'fadeOut 0.5s ease forwards';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    });
</script>
<?php endif; ?>


<script>
    /* =========================================
       HERO SCRIPT (Pertahankan Logika)
       ========================================= */
    const heroData = {
        hijab: {
            title: "Hijab LoopWear",
            desc: "Hijab premium, lembut, siap bikin outfit makin glowing.",
            bgColor: "#fffacf",       
            glowColor: "#FFFFFF",     
            titleColor: "#F29C9C",    
            btnBg: "#F29C9C",         
            btnText: "#FFFFFF",       
            mainImg: "<?php echo e(asset('images/hijab_pink.png')); ?>",
            floaters: [
                "<?php echo e(asset('images/baju.png')); ?>",
                "<?php echo e(asset('images/celana.png')); ?>",
                "<?php echo e(asset('images/sepatu.png')); ?>"
            ]
        },
        baju: {
            title: "Baju LoopWear",
            desc: "Blouse, kemeja, & kaos ternyaman untuk OOTD harianmu.",
            bgColor: "#FDFDFD",       
            glowColor: "#FAD8D8",     
            titleColor: "#F29C9C",    
            btnBg: "#C44131",         
            btnText: "#FFFFFF",
            mainImg: "<?php echo e(asset('images/baju.png')); ?>",
            floaters: [
                "<?php echo e(asset('images/hijab_pink.png')); ?>",
                "<?php echo e(asset('images/celana.png')); ?>",
                "<?php echo e(asset('images/sepatu.png')); ?>"
            ]
        },
        celana: {
            title: "Celana LoopWear",
            desc: "Jeans vintage atau culotte? Temukan fitting terbaikmu di sini.",
            bgColor: "#cedcfb",       
            glowColor: "#314896",     
            titleColor: "#F7B0A1",    
            btnBg: "#415AAB",         
            btnText: "#F7B0A1",       
            mainImg: "<?php echo e(asset('images/celana.png')); ?>",
            floaters: [
                "<?php echo e(asset('images/baju.png')); ?>",
                "<?php echo e(asset('images/hijab_pink.png')); ?>",
                "<?php echo e(asset('images/sepatu.png')); ?>"
            ]
        },
        sepatu: {
            title: "Sepatu LoopWear",
            desc: "Step up your look! Sneakers & heels preloved tapi tetap kece.",
            bgColor: "#ebfacc",       
            glowColor: "#8c9a76",     
            titleColor: "#F7B0A1",    
            btnBg: "#4A5828",         
            btnText: "#F7B0A1",       
            mainImg: "<?php echo e(asset('images/sepatu.png')); ?>",
            floaters: [
                "<?php echo e(asset('images/baju.png')); ?>",
                "<?php echo e(asset('images/hijab_pink.png')); ?>",
                "<?php echo e(asset('images/celana.png')); ?>"
            ]
        }
    };

    function changeHero(category, elementClicked) {
        const data = heroData[category];
        if (!data) return;

        if (elementClicked) {
            document.querySelectorAll('.hero-thumbs img').forEach(thumb => thumb.classList.remove('active'));
            elementClicked.classList.add('active');
        }

        const titleEl = document.getElementById('hero-title');
        titleEl.innerText = data.title;
        titleEl.style.color = data.titleColor;

        document.getElementById('hero-desc').innerText = data.desc;

        const btnEl = document.getElementById('order-btn');
        btnEl.style.backgroundColor = data.btnBg;
        btnEl.style.color = data.btnText;

        document.getElementById('hero-section').style.backgroundColor = data.bgColor;
        document.getElementById('hero-glow').style.background = `radial-gradient(circle, ${data.glowColor} 0%, rgba(255,255,255,0) 65%)`;

        const mainImg = document.getElementById('hero-img');
        mainImg.classList.remove('img-fade-in');
        void mainImg.offsetWidth; 
        mainImg.src = data.mainImg;
        mainImg.classList.add('img-fade-in');

        document.getElementById('floater-1').src = data.floaters[0];
        document.getElementById('floater-2').src = data.floaters[1];
        document.getElementById('floater-3').src = data.floaters[2];

        const viewMenuBtn = document.getElementById('view-menu-btn');
        viewMenuBtn.style.borderColor = data.btnBg;
        viewMenuBtn.style.color = data.btnBg;

        viewMenuBtn.onmouseover = function() {
            this.style.backgroundColor = data.btnBg;
            this.style.color = data.btnText;
        };
        viewMenuBtn.onmouseout = function() {
            this.style.backgroundColor = "transparent";
            this.style.color = data.btnBg;
        };
    }

    let currentCategoryIndex = 0;
    const categories = ['hijab', 'baju', 'celana', 'sepatu'];
    let autoSlideInterval;

    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            currentCategoryIndex = (currentCategoryIndex + 1) % categories.length;
            const nextCategory = categories[currentCategoryIndex];
            const nextThumb = document.querySelectorAll('.hero-thumbs img')[currentCategoryIndex];
            changeHero(nextCategory, nextThumb);
        }, 5000);
    }

    window.addEventListener('load', function() {
        const firstThumb = document.querySelectorAll('.hero-thumbs img')[0];
        changeHero('hijab', firstThumb);
        startAutoSlide();
    });

    document.querySelectorAll('.hero-thumbs img').forEach((thumb, index) => {
        thumb.onclick = function() {
            clearInterval(autoSlideInterval);
            currentCategoryIndex = index;
            changeHero(categories[index], this);
            startAutoSlide();
        };
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/welcome.blade.php ENDPATH**/ ?>