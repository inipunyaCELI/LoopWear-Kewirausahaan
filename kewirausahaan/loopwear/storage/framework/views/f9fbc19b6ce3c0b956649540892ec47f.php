<?php $__env->startSection('konten'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap');

    .contact-page {
        font-family: 'Quicksand', sans-serif;
        background-color: #fff;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    /* RUMUS KESEJAJARAN (Tinggi 45px, Jarak 20px) */
    .info-item {
        display: flex;
        align-items: center;
        height: 45px; /* Tinggi disamakan dengan input form */
        margin-bottom: 20px; /* Jarak bawah disamakan dengan form */
        color: #555;
    }
    
    .info-icon {
        font-size: 1.5rem;
        width: 40px;
        color: #333; 
    }
    
    .info-text {
        display: flex;
        align-items: baseline;
        gap: 8px;
    }
    
    .info-text h6 {
        font-size: 0.85rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.5px;
        color: #8A9E71; 
    }
    
    .info-text p {
        font-size: 0.85rem;
        margin: 0;
        color: #666;
    }

    /* Garis Pembatas Vertikal */
    .vertical-divider {
        border-left: 2px solid #8A9E71; 
        height: 100%;
        min-height: 350px; 
        margin: 0 auto;
        width: 1px;
    }

    /* Styling Form Input */
    .custom-input {
        background-color: #EBEBEB; 
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        height: 45px; /* Tinggi fix agar sejajar Info Kiri */
        font-weight: 700;
        font-size: 0.85rem;
        color: #777;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.05); 
        margin-bottom: 20px; /* Jarak fix agar sejajar Info Kiri */
        width: 100%;
    }
    
    .custom-input::placeholder {
        color: #A9A9A9;
        letter-spacing: 1px;
    }
    
    .custom-input:focus {
        background-color: #E2E2E2;
        outline: none;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Khusus Kotak Pesan (Digabung 2 Baris) */
    textarea.custom-input {
        /* Tinggi 2 Input (45+45) + 1 Jarak (20) = 110px */
        height: 110px; 
        resize: none;
        padding-top: 12px;
    }

    /* Tombol Submit */
    .btn-submit {
        background-color: transparent;
        color: #47510B; 
        font-weight: 600;
        border-radius: 25px;
        padding: 0 30px;
        height: 45px; /* Tinggi disamakan dengan Facebook di kiri */
        border: 1px solid #47510B; 
        transition: all 0.3s ease;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-submit:hover {
        background-color: #47510B; 
        color: #ffffff; 
        transform: translateY(-2px);
    }

    /* Efek glow di belakang logo */
    .logo-wrapper {
        position: relative;
    }
    
    .logo-wrapper::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 350px; 
        height: 350px; 
        background: radial-gradient(circle, rgba(250,237,75,0.15) 0%, rgba(255,255,255,0) 70%);
        z-index: -1;
    }
</style>

<div class="container contact-page py-5">
    <div class="row w-100 align-items-center justify-content-center">
        
        <!-- Bagian Kiri: Logo -->
        <div class="col-md-4 text-center mb-4 mb-md-0 logo-wrapper">
            <img src="<?php echo e(asset('images/logo_loop.png')); ?>" alt="LoopWear Logo" class="img-fluid" style="max-width: 380px;">
        </div>

        <!-- Bagian Tengah: Info Kontak -->
        <div class="col-md-4 col-lg-3 mb-4 mb-md-0 ps-md-4">
            
            <!-- Baris 1 -->
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-store"></i></div>
                <div class="info-text">
                    <h6>NAME :</h6>
                    <p>LoopWear Official</p>
                </div>
            </div>

            <!-- Baris 2 -->
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                <div class="info-text">
                    <h6>E-MAIL :</h6>
                    <p>hello@loopwear.com</p>
                </div>
            </div>
            
            <!-- Baris 3 -->
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                <div class="info-text">
                    <h6>PHONE :</h6>
                    <p>0812-3456-7890</p>
                </div>
            </div>

            <!-- Baris 4 (Sejajar Atas Textarea) -->
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="info-text">
                    <h6>ADDRESS :</h6>
                    <p>Banjarmasin, Indonesia</p>
                </div>
            </div>

            <!-- Baris 5 (Sejajar Bawah Textarea) -->
            <div class="info-item">
                <div class="info-icon"><i class="fab fa-instagram"></i></div>
                <div class="info-text">
                    <h6>INSTAGRAM :</h6>
                    <p>@LoopWear.official</p>
                </div>
            </div>

            <!-- Baris 6 (Sejajar Tombol) - Margin 0 -->
            <div class="info-item mb-0">
                <div class="info-icon"><i class="fab fa-facebook-f"></i></div>
                <div class="info-text">
                    <h6>FACEBOOK :</h6>
                    <p>LoopWear.id</p>
                </div>
            </div>
        </div>

        <!-- Garis Pembatas (Desktop) -->
        <div class="col-md-1 d-none d-md-flex justify-content-center">
            <div class="vertical-divider"></div>
        </div>

        <!-- Bagian Kanan: Form -->
        <div class="col-md-3 col-lg-4">
            <form action="#" method="POST" class="m-0">
                <!-- Baris 1 -->
                <input type="text" class="form-control custom-input" placeholder="NAME">
                
                <!-- Baris 2 -->
                <input type="text" class="form-control custom-input" placeholder="PHONE">
                
                <!-- Baris 3 -->
                <input type="email" class="form-control custom-input" placeholder="EMAIL">
                
                <!-- Baris 4 & 5 (Tinggi 2x lipat) -->
                <textarea class="form-control custom-input" placeholder="MESSAGE"></textarea>
                
                <!-- Baris 6 -->
                <button type="submit" class="btn btn-submit">SUBMIT</button>
            </form>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/contact.blade.php ENDPATH**/ ?>