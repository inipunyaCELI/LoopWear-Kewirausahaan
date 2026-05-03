<?php $__env->startSection('konten'); ?>
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
        min-height: 550px;
    }

    .auth-title {
        color: #FFB6A9;
        font-family: 'Fredoka One', cursive;
        margin-bottom: 20px;
        font-size: 2.2rem;
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
        position: absolute;
        top: 0;
        width: 50%;
        transition: all 0.6s ease-in-out;
    }

    /* Input Style */
    .auth-container input {
        background-color: #F0F4F8; 
        border: 1px solid #E1E8F0;
        border-radius: 8px;
        padding: 14px 15px;
        margin-bottom: 15px;
        width: 90%;
        font-family: 'Quicksand', sans-serif;
        font-weight: 600;
        color: #47510B;
    }

    .auth-container a.forgot-pass-trigger {
        color: #47510B;
        font-size: 14px;
        text-decoration: underline;
        margin-bottom: 20px;
        font-weight: 600;
        cursor: pointer;
    }

    /* Button Styles */
    .btn-auth {
        border-radius: 50px;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 0.1s, background-color 0.3s;
        cursor: pointer;
        font-family: 'Quicksand', sans-serif;
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

    .btn-outline {
        background-color: transparent;
        border: 2px solid #47510B; 
        color: #47510B;
        padding: 12px 45px;
        font-size: 14px;
        transition: all 0.3s ease; /* Biar perubahan warnanya nggak kaku */
    }
   
    .btn-outline:hover {
        background-color: #47510B; /* Berubah jadi Grassy Green penuh */
        color: #fff24d;           /* Teks berubah jadi Kuning */
        border-color: #47510B;
    }

    /* --- POSISI FORM --- */
    .sign-in-form { left: 0; z-index: 2; }
    .sign-up-form { left: 0; opacity: 0; z-index: 1; }
    .forgot-form { left: 0; opacity: 0; z-index: 1; }

    /* --- ANIMASI GESER --- */
    /* State: Sign Up Aktif */
    .auth-container.right-panel-active .sign-in-form { transform: translateX(100%); opacity: 0; }
    .auth-container.right-panel-active .sign-up-form { transform: translateX(100%); opacity: 1; z-index: 5; }
    .auth-container.right-panel-active .forgot-form { transform: translateX(100%); opacity: 0; }

    /* State: Forgot Password Aktif */
    .auth-container.forgot-panel-active .sign-in-form { opacity: 0; }
    .auth-container.forgot-panel-active .sign-up-form { opacity: 0; }
    .auth-container.forgot-panel-active .forgot-form { opacity: 1; z-index: 5; }

    /* --- OVERLAY KUNING --- */
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

    .auth-container.right-panel-active .overlay-container { transform: translateX(-100%); }

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

    .auth-container.right-panel-active .overlay { transform: translateX(50%); }

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
        transition: transform 0.6s ease-in-out;
    }

    .overlay-panel h2 {
        font-family: 'Fredoka One', cursive;
        color: #47510B;
        font-size: 2.2rem;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .overlay-panel p {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 30px;
        font-weight: 500;
    }

    .overlay-left { transform: translateX(-20%); }
    .auth-container.right-panel-active .overlay-left { transform: translateX(0); }
    .overlay-right { right: 0; }
</style>

<div class="container auth-page-wrapper">
    <div class="auth-container" id="auth-container">
        
        
        <form action="<?php echo e(url('/register')); ?>" method="POST" class="sign-up-form">
            <?php echo csrf_field(); ?>
            <h2 class="auth-title">CREATE ACCOUNT</h2>
            <input type="text" name="name" placeholder="NAME" required />
            <input type="email" name="email" placeholder="EMAIL" required />
            <input type="password" name="password" placeholder="PASSWORD" required />
            <button type="submit" class="btn-auth btn-solid">SIGN UP</button>
        </form>

        
        <form action="<?php echo e(url('/login')); ?>" method="POST" class="sign-in-form" id="login-form">
            <?php echo csrf_field(); ?>
            <h2 class="auth-title">LOG IN TO LOOP WEAR</h2>
            <input type="email" name="email" placeholder="EMAIL" required />
            <input type="password" name="password" placeholder="PASSWORD" required />
            <a class="forgot-pass-trigger" id="toForgotBtn">Forgot your password?</a>
            <button type="submit" class="btn-auth btn-solid">SIGN IN</button>
        </form>

        
        <form action="#" method="POST" class="forgot-form" id="forgot-form">
            <?php echo csrf_field(); ?>
            <h2 class="auth-title">RESET PASSWORD</h2>
            <p style="color: #47510B; margin-bottom: 20px;">We will send you an email to reset your password</p>
            <input type="email" name="email" placeholder="EMAIL" required />
            <button type="submit" class="btn-auth btn-solid">SUBMIT</button>
            <a class="forgot-pass-trigger" id="backToLoginBtn" style="margin-top: 15px;">Back to Login</a>
        </form>

        
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h2>WELCOME BACK!</h2>
                    <p>To keep connected with us please login with your personal info</p>
                    <button type="button" class="btn-auth btn-outline" id="signInBtn">SIGN IN</button>
                </div>
                
                <div class="overlay-panel overlay-right">
                    <h2>HELLO, FRIEND!</h2>
                    <p>Enter your personal details<br>and start your journey with us</p>
                    <button type="button" class="btn-auth btn-outline" id="signUpBtn">SIGN UP</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const container = document.getElementById('auth-container');
    const signUpButton = document.getElementById('signUpBtn');
    const signInButton = document.getElementById('signInBtn');
    const toForgotBtn = document.getElementById('toForgotBtn');
    const backToLoginBtn = document.getElementById('backToLoginBtn');

    signUpButton.addEventListener('click', () => {
        container.classList.remove("forgot-panel-active");
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
        container.classList.remove("forgot-panel-active");
    });

    toForgotBtn.addEventListener('click', () => {
        container.classList.add("forgot-panel-active");
    });

    backToLoginBtn.addEventListener('click', () => {
        container.classList.remove("forgot-panel-active");
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\loopwear\resources\views/auth/login.blade.php ENDPATH**/ ?>