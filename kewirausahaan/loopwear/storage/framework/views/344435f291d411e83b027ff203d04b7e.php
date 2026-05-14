<?php $__env->startSection('konten'); ?>

<style>
    .hero-section {
        transition: background-color 0.8s ease-in-out;
        overflow: hidden; /* Mencegah gambar tumpah ke luar section */
    }

    #hero-title, #order-btn {
        transition: color 0.5s ease, background-color 0.5s ease;
    }

    /* --- THUMBNAIL (PURE OBJEK & BERBAYANG) --- */
    .hero-thumbs img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: transparent;
        border: none;
        /* Bayangan bawaan saat tidak aktif */
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.15)) grayscale(30%);
    }

    .hero-thumbs img.active {
        transform: scale(1.25) translateY(-8px);
        /* Bayangan makin tebal saat dipencet */
        filter: drop-shadow(0 12px 18px rgba(0,0,0,0.3)) grayscale(0%);
    }

    /* --- KOLOM KANAN --- */
    .hero-right-col {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 500px;
    }

    /* --- GAMBAR UTAMA --- */
    .main-hero-img {
        z-index: 10;
        /* Kunci agar lebarnya maksimal 60% dari kolom, sisa ruang untuk floater */
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

    /* --- OBJEK MELAYANG (FLOATERS) --- */
    .floater {
        position: absolute;
        z-index: 5;
        max-width: 65px; /* Objek melayang diperkecil sedikit */
        object-fit: contain;
        transition: all 0.8s ease-in-out;
        animation: floatAnimation 3s infinite ease-in-out alternate;
        filter: drop-shadow(0 8px 12px rgba(0,0,0,0.2));
    }

    /* Posisi Floater dijauhkan ke sudut-sudut agar tidak ditabrak gambar utama */
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
        border: 2px solid #47510B; /* Warna outline default (Grassy Green) */
        color: #47510B;
        transition: all 0.3s ease;
    }

    /* Efek saat di-hover atau dipencet (Fill) */
    #view-menu-btn:hover, #view-menu-btn:active {
        background-color: #47510B; /* Warna fill saat dipencet */
        color: #fffacf;           /* Warna teks saat dipencet */
        border-color: #47510B;
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
                    <a href="#products" id="order-btn" class="btn rounded-pill px-4 py-2 fw-bold shadow border-0">ORDER NOW</a>
                    <a href="#products" id="view-menu-btn" class="btn rounded-pill px-4 py-2 fw-bold">VIEW PRODUCTS</a>
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


<div id="products" class="container mt-5">
    <h2 class="text-center mb-4">Our Collections</h2>
    <div class="row">
        
    </div>
</div>

<script>
    // Konfigurasi lengkap koleksi LoopWear
    const heroData = {
        hijab: {
            title: "Hijab LoopWear",
            desc: "Hijab premium, lembut, siap bikin outfit makin glowing.",
            bgColor: "#fffacf",       // Kuning terang
            glowColor: "#FFFFFF",     // Putih
            titleColor: "#F29C9C",    // Pink/Peach
            btnBg: "#F29C9C",         // Pink/Peach
            btnText: "#FFFFFF",       // Putih
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
            bgColor: "#FDFDFD",       // Putih cerah
            glowColor: "#FAD8D8",     // Pink muda
            titleColor: "#F29C9C",    // Pink/Peach
            btnBg: "#C44131",         // Merah gelap
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
            bgColor: "#cedcfb",       // Biru Celana
            glowColor: "#314896",     // Biru Gelap
            titleColor: "#F7B0A1",    // Peach
            btnBg: "#415AAB",         // Biru Dongker
            btnText: "#F7B0A1",       // Peach
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
            bgColor: "#ebfacc",       // Hijau Sepatu
            glowColor: "#8c9a76",     // Hijau Gelap
            titleColor: "#F7B0A1",    // Peach
            btnBg: "#4A5828",         // Hijau Tua
            btnText: "#F7B0A1",       // Peach
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

        // 1. Update Thumbnail Aktif
        if (elementClicked) {
            document.querySelectorAll('.hero-thumbs img').forEach(thumb => thumb.classList.remove('active'));
            elementClicked.classList.add('active');
        }

        // 2. Update Teks & Tombol Order
        const titleEl = document.getElementById('hero-title');
        titleEl.innerText = data.title;
        titleEl.style.color = data.titleColor;

        document.getElementById('hero-desc').innerText = data.desc;

        const btnEl = document.getElementById('order-btn');
        btnEl.style.backgroundColor = data.btnBg;
        btnEl.style.color = data.btnText;

        // 3. Update Background & Glow
        document.getElementById('hero-section').style.backgroundColor = data.bgColor;
        document.getElementById('hero-glow').style.background = `radial-gradient(circle, ${data.glowColor} 0%, rgba(255,255,255,0) 65%)`;

        // 4. Update Gambar Utama
        const mainImg = document.getElementById('hero-img');
        mainImg.classList.remove('img-fade-in');
        void mainImg.offsetWidth; 
        mainImg.src = data.mainImg;
        mainImg.classList.add('img-fade-in');

        // 5. Update Floaters
        document.getElementById('floater-1').src = data.floaters[0];
        document.getElementById('floater-2').src = data.floaters[1];
        document.getElementById('floater-3').src = data.floaters[2];

        // 6. Update Tombol VIEW MENU (Outline & Hover Dinamis)
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

    // --- LOGIKA AUTO SLIDE & EVENT ---
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

    // Jalankan saat load
    window.addEventListener('load', function() {
        const firstThumb = document.querySelectorAll('.hero-thumbs img')[0];
        changeHero('hijab', firstThumb);
        startAutoSlide();
    });

    // Reset interval kalau user klik manual
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
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\KULIAH\SEMESTER 2\KEWIR\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/welcome.blade.php ENDPATH**/ ?>