@extends('layout.main')

@section('konten')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;500;600;700&display=swap');

    .auth-page-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 40px 0;
        font-family: 'Quicksand', sans-serif;
    }

    .auth-container {
        background-color: #FFFFFF;
        border-radius: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
        position: relative;
        overflow: hidden;
        width: 850px;
        max-width: 100%;
        min-height: 520px;
    }

    /* --- STYLE JUDUL DISAMAKAN (CAPSLOCK & UKURAN SAMA) --- */
    .auth-title {
        color: #FFB6A9; /* Petal Pink */
        font-family: 'Fredoka One', cursive;
        margin-bottom: 20px;
        font-size: 2.2rem; /* Ukuran sama persis */
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .auth-container form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        height: 100%;
        text-align: center;
    }

    /* --- STYLE INPUT DISAMAKAN --- */
    .auth-container input {
        background-color: #F0F4F8; 
        border: 1px solid #E1E8F0;
        border-radius: 8px;
        padding: 14px 15px;
        margin-bottom: 15px;
        width: 90%;
        font-family: 'Quicksand', sans-serif;
        font-weight: 600;
        color: #47510B; /* Grassy Green */
        transition: all 0.3s;
    }

    .auth-container input:focus {
        outline: none;
        border-color: #FFB6A9;
    }

    /* Teks tambahan khusus halaman forgot password */
    .forgot-desc {
        font-size: 14px;
        color: #47510B;
        font-weight: 500;
        margin-bottom: 25px;
    }

    .cancel-link {
        color: #47510B;
        font-size: 14px;
        text-decoration: underline;
        margin-top: 15px;
        font-weight: 600;
        transition: color 0.3s;
    }

    .cancel-link:hover {
        color: #FFB6A9;
    }

    /* --- STYLE TOMBOL DISAMAKAN --- */
    .btn-auth {
        border-radius: 50px;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 0.1s, background-color 0.3s;
        cursor: pointer;
        font-family: 'Quicksand', sans-serif;
    }

    .btn-auth:active {
        transform: scale(0.95);
    }

    .btn-solid {
        background-color: #fff24d; 
        border: none;
        color: #47510B; 
        width: 90%;
        padding: 13px 0;
        font-size: 15px;
        box-shadow: 0 6px 15px rgba(255, 242, 77, 0.4);
    }

    .btn-solid:hover {
        background-color: #e6da45;
    }

    .btn-outline {
        background-color: transparent;
        border: 2px solid #47510B; 
        color: #47510B;
        padding: 12px 45px;
        font-size: 14px;
        text-decoration: none;
        display: inline-block; /* Penting untuk tag <a> yang dibentuk jadi tombol */
    }

    .btn-outline:hover {
        background-color: #47510B;
        color: #fff24d;
    }

    /* --- LOGIKA ANIMASI SLIDING (SAMA PERSIS DENGAN LOGIN) --- */
    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .auth-container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .auth-container.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {
        0%, 49.99% { opacity: 0; z-index: 1; }
        50%, 100% { opacity: 1; z-index: 5; }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .auth-container.right-panel-active .overlay-container {
        transform: translateX(-100%);
    }

    .overlay {
        background-color: #fff24d;
        color: #47510B;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .auth-container.right-panel-active .overlay {
        transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-panel h2 {
        font-family: 'Fredoka One', cursive;
        color: #47510B;
        font-size: 2.2rem;
        margin-bottom: 15px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .overlay-panel p {
        font-size: 14px;
        color: #47510B;
        line-height: 1.6;
        margin-bottom: 30px;
        padding: 0 20px;
        font-weight: 500;
    }

    .overlay-left {
        transform: translateX(-20%);
    }

    .auth-container.right-panel-active .overlay-left {
        transform: translateX(0);
    }

    .overlay-right {
        right: 0;
        transform: translateX(0);
    }

    .auth-container.right-panel-active .overlay-right {
        transform: translateX(20%);
    }
</style>

<div class="container auth-page-wrapper">
    <div class="auth-container" id="auth-container">
        
        {{-- PANEL KIRI SAAT DIGESER: FORM REGISTER --}}
        <div class="form-container sign-up-container">
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <h2 class="auth-title">CREATE ACCOUNT</h2>
                <input type="text" name="name" placeholder="NAME" required />
                <input type="email" name="email" placeholder="EMAIL" required />
                <input type="password" name="password" placeholder="PASSWORD" required />
                <button type="submit" class="btn-auth btn-solid">SIGN UP</button>
            </form>
        </div>

        {{-- PANEL KIRI AWAL: FORM FORGOT PASSWORD --}}
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                @csrf
                <h2 class="auth-title">RESET YOUR PASSWORD</h2>
                <p class="forgot-desc">We will send you an email to reset your password</p>
                <input type="email" name="email" placeholder="EMAIL" required />
                <button type="submit" class="btn-auth btn-solid">SUBMIT</button>
                <a href="{{ url('/login') }}" class="cancel-link">Cancel</a>
            </form>
        </div>

        {{-- KOTAK KUNING BERGESER --}}
        <div class="overlay-container">
            <div class="overlay">
                {{-- Overlay Kiri (Tampil saat Sign Up terbuka) --}}
                <div class="overlay-panel overlay-left">
                    <h2>WELCOME BACK!</h2>
                    <p>Already remembered your password? Login with your personal info</p>
                    {{-- Tombol ini mengembalikan user ke halaman login --}}
                    <a href="{{ url('/login') }}" class="btn-auth btn-outline">SIGN IN</a>
                </div>
                
                {{-- Overlay Kanan (Tampil di awal) --}}
                <div class="overlay-panel overlay-right">
                    <h2>HELLO, FRIEND!</h2>
                    <p>Enter your personal details<br>and start your journey with us</p>
                    {{-- TOMBOL INI SEKARANG BUTTON MURNI UNTUK MENGGESER ANIMASI --}}
                    <button type="button" class="btn-auth btn-outline" id="signUpBtn">SIGN UP</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const signUpButton = document.getElementById('signUpBtn');
    const container = document.getElementById('auth-container');

    // Memicu animasi geser kotak kuning ke kiri tanpa pindah halaman
    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });
</script>
@endsection