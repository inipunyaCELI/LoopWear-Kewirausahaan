@extends('layout.main')

@section('konten')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap');

    .contact-page {
        font-family: 'Quicksand', sans-serif;
        background-color: #fff;
        min-height: 80vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    /* Dekorasi background subtle */
    .contact-page::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(250, 237, 75, 0.18) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    .contact-page::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -60px;
        width: 260px;
        height: 260px;
        background: radial-gradient(circle, rgba(138, 158, 113, 0.13) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    .contact-page .row {
        position: relative;
        z-index: 1;
    }

    /* === LOGO === */
    .logo-wrapper {
        position: relative;
        animation: fadeInLeft 0.7s ease both;
    }

    .logo-wrapper::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(250, 237, 75, 0.18) 0%, rgba(255,255,255,0) 70%);
        z-index: -1;
    }

    .logo-wrapper img {
        transition: transform 0.4s ease;
    }

    .logo-wrapper img:hover {
        transform: scale(1.04) rotate(-1deg);
    }

    /* === INFO ITEMS === */
    .info-col {
        animation: fadeInUp 0.7s ease 0.15s both;
    }

    .info-item {
        display: flex;
        align-items: center;
        height: 45px;
        margin-bottom: 20px;
        color: #555;
        border-radius: 10px;
        padding: 0 8px;
        transition: background 0.25s ease, transform 0.25s ease;
        cursor: default;
    }

    .info-item:hover {
        background: rgba(138, 158, 113, 0.08);
        transform: translateX(5px);
    }

    .info-icon {
        font-size: 1.3rem;
        width: 40px;
        color: #8A9E71;
        transition: color 0.25s ease, transform 0.25s ease;
    }

    .info-item:hover .info-icon {
        color: #47510B;
        transform: scale(1.2);
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
        transition: color 0.25s ease;
    }

    .info-item:hover .info-text h6 {
        color: #47510B;
    }

    .info-text p {
        font-size: 0.85rem;
        margin: 0;
        color: #666;
    }

    /* === DIVIDER === */
    .vertical-divider {
        border-left: 2px solid transparent;
        border-image: linear-gradient(to bottom, transparent, #8A9E71 30%, #8A9E71 70%, transparent) 1;
        height: 100%;
        min-height: 350px;
        margin: 0 auto;
        width: 1px;
    }

    /* === FORM === */
    .form-col {
        animation: fadeInRight 0.7s ease 0.3s both;
    }

    .custom-input {
        background-color: #F4F4F2;
        border: 1.5px solid transparent;
        border-radius: 10px;
        padding: 10px 16px;
        height: 45px;
        font-weight: 600;
        font-size: 0.85rem;
        color: #555;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 16px;
        width: 100%;
        transition: background 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease, transform 0.2s ease;
    }

    .custom-input::placeholder {
        color: #B0B0B0;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .custom-input:focus {
        background-color: #fff;
        border-color: #8A9E71;
        outline: none;
        box-shadow: 0 0 0 3px rgba(138, 158, 113, 0.15), 0 2px 8px rgba(0,0,0,0.06);
        transform: translateY(-1px);
    }

    textarea.custom-input {
        height: 110px;
        resize: none;
        padding-top: 12px;
    }

    /* === BUTTON === */
    .btn-submit {
        background-color: transparent;
        color: #47510B;
        font-weight: 700;
        border-radius: 25px;
        padding: 0 32px;
        height: 45px;
        border: 1.5px solid #47510B;
        transition: all 0.3s ease;
        letter-spacing: 1.5px;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        inset: 0;
        background: #47510B;
        border-radius: 25px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.35s ease;
        z-index: 0;
    }

    .btn-submit span {
        position: relative;
        z-index: 1;
        transition: color 0.35s ease;
    }

    .btn-submit i {
        position: relative;
        z-index: 1;
        transition: color 0.35s ease, transform 0.35s ease;
    }

    .btn-submit:hover::before {
        transform: scaleX(1);
    }

    .btn-submit:hover span,
    .btn-submit:hover i {
        color: #fff;
    }

    .btn-submit:hover i {
        transform: translateX(4px);
    }

    /* === ANIMASI === */
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-30px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(30px); }
        to   { opacity: 1; transform: translateX(0); }
    }
</style>

<div class="container contact-page py-5">
    <div class="row w-100 align-items-center justify-content-center">

        <div class="col-md-4 text-center mb-4 mb-md-0 logo-wrapper">
            <img src="{{ asset('images/logo_loop.png') }}" alt="LoopWear Logo" class="img-fluid" style="max-width: 380px;">
        </div>

        <div class="col-md-4 col-lg-3 mb-4 mb-md-0 ps-md-4 info-col">

            <div class="info-item">
                <div class="info-icon"><i class="fas fa-store"></i></div>
                <div class="info-text">
                    <h6>NAME :</h6>
                    <p>LoopWear Official</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                <div class="info-text">
                    <h6>E-MAIL :</h6>
                    <p>hello@loopwear.com</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                <div class="info-text">
                    <h6>PHONE :</h6>
                    <p>0812-3456-7890</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="info-text">
                    <h6>ADDRESS :</h6>
                    <p>Banjarmasin, Indonesia</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fab fa-instagram"></i></div>
                <div class="info-text">
                    <h6>INSTAGRAM :</h6>
                    <p>@LoopWear.official</p>
                </div>
            </div>

            <div class="info-item mb-0">
                <div class="info-icon"><i class="fab fa-facebook-f"></i></div>
                <div class="info-text">
                    <h6>FACEBOOK :</h6>
                    <p>LoopWear.id</p>
                </div>
            </div>
        </div>

        <div class="col-md-1 d-none d-md-flex justify-content-center">
            <div class="vertical-divider"></div>
        </div>

        <div class="col-md-3 col-lg-4 form-col">
            {{-- Form action sudah diubah ke /contact dan ditambah method POST --}}
            <form action="/contact" method="POST" class="m-0">
                @csrf
                {{-- name="..." dan required sudah ditambahkan --}}
                <input type="text" name="nama" class="form-control custom-input" placeholder="NAME" required>
                <input type="text" name="telepon" class="form-control custom-input" placeholder="PHONE" required>
                <input type="email" name="email" class="form-control custom-input" placeholder="EMAIL" required>
                <textarea name="pesan" class="form-control custom-input" placeholder="MESSAGE" required></textarea>
                
                <button type="submit" class="btn btn-submit">
                    <span>SUBMIT</span>
                    <i class="fas fa-arrow-right" style="font-size: 0.75rem;"></i>
                </button>
            </form>
        </div>

    </div>
</div>
@endsection