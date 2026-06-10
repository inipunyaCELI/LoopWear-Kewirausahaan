<?php $__env->startSection('konten'); ?>
<style>
    .profile-wrapper {
        max-width: 640px;
        margin: 2.5rem auto;
        padding: 0 1rem 3rem;
    }

    .profile-heading {
        font-family: 'Fredoka One', cursive;
        font-size: 1.8rem;
        color: #E7998B;
        margin-bottom: 1.5rem;
    }

    .profile-card {
        background: #fff;
        border-radius: 20px;
        border: 1.5px solid #f0f0f0;
        padding: 1.75rem 2rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }

    .profile-card-title {
        font-weight: 800;
        font-size: 1rem;
        color: #333;
        margin-bottom: 0.2rem;
    }

    .profile-card-sub {
        font-size: 0.8rem;
        color: #aaa;
        margin-bottom: 1.25rem;
    }

    .profile-divider {
        border: none;
        border-top: 1px solid #f0f0f0;
        margin: 1rem 0 1.25rem;
    }

    .avatar-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .avatar-circle {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        border: 3px solid #E7998B;
        background: #fff24d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Fredoka One';
        font-size: 1.6rem;
        color: #E7998B;
        overflow: hidden;
        flex-shrink: 0;
    }

    .avatar-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-name {
        font-weight: 800;
        font-size: 0.95rem;
        color: #333;
        margin-bottom: 2px;
    }

    .avatar-role {
        font-size: 0.78rem;
        color: #aaa;
        margin-bottom: 6px;
    }

    .btn-ganti-foto {
        font-size: 0.78rem;
        padding: 5px 14px;
        border: 1.5px solid #E7998B;
        color: #E7998B;
        background: transparent;
        border-radius: 999px;
        cursor: pointer;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        transition: background 0.2s;
    }

    .btn-ganti-foto:hover { background: #fff0ee; }

    .section-label {
        font-size: 0.72rem;
        font-weight: 800;
        color: #bbb;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin: 1rem 0 0.75rem;
    }

    .profile-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        color: #666;
        margin-bottom: 5px;
    }

    .profile-input {
        width: 100%;
        padding: 10px 14px;
        font-size: 0.875rem;
        font-family: 'Quicksand', sans-serif;
        font-weight: 600;
        border: 1.5px solid #e8e8e8;
        border-radius: 12px;
        background: #fff;
        color: #333;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .profile-input:focus {
        outline: none;
        border-color: #E7998B;
        box-shadow: 0 0 0 3px rgba(231,153,139,0.15);
    }

    .profile-input.is-invalid {
        border-color: #e24b4a;
    }

    .error-msg {
        font-size: 0.75rem;
        color: #a32d2d;
        margin-top: 4px;
    }

    .btn-simpan {
        background: #47510B;
        color: #fff24d;
        border: none;
        border-radius: 999px;
        padding: 10px 28px;
        font-size: 0.875rem;
        font-weight: 800;
        font-family: 'Quicksand', sans-serif;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
    }

    .btn-simpan:hover { background: #333c07; }
    .btn-simpan:active { transform: scale(0.97); }

    .btn-batal {
        background: transparent;
        color: #aaa;
        border: 1.5px solid #e8e8e8;
        border-radius: 999px;
        padding: 10px 20px;
        font-size: 0.875rem;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        cursor: pointer;
        margin-left: 8px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-batal:hover { background: #f5f5f5; color: #aaa; }

    @media (max-width: 520px) {
        .form-row-2 { flex-direction: column; }
        .profile-card { padding: 1.25rem; }
    }
</style>

<div class="profile-wrapper">
    <h1 class="profile-heading">Edit Profil</h1>

    <div class="profile-card">
        <p class="profile-card-title">Informasi Profil</p>
        <p class="profile-card-sub">Perbarui nama, foto, dan informasi kontak kamu.</p>

        <div class="avatar-row">
            <div class="avatar-circle" id="avatarCircle">
                <?php if(auth()->user()->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" alt="Foto profil">
                <?php else: ?>
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                <?php endif; ?>
            </div>
            <div>
                <p class="avatar-name"><?php echo e(auth()->user()->username ?? auth()->user()->name); ?></p>
                <p class="avatar-role">Member LoopWear</p>
                <label for="avatarInput" class="btn-ganti-foto">Ganti foto</label>
            </div>
        </div>

        <hr class="profile-divider">

        <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display:none;" onchange="previewAvatar(this)">

            <p class="section-label">Informasi dasar</p>

            <div class="d-flex gap-3 form-row-2">
                <div class="mb-3 flex-fill">
                    <label class="profile-label" for="name">Nama lengkap</label>
                    <input class="profile-input <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" id="name" name="name" value="<?php echo e(old('name', auth()->user()->name)); ?>">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-msg"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3 flex-fill">
                    <label class="profile-label" for="username">Username</label>
                    <input class="profile-input <?php echo e($errors->has('username') ? 'is-invalid' : ''); ?>" type="text" id="username" name="username" value="<?php echo e(old('username', auth()->user()->username)); ?>">
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-msg"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="profile-label" for="email">Email</label>
                <input class="profile-input" type="email" id="email" name="email" value="<?php echo e(auth()->user()->email); ?>" readonly style="background-color: #f4f4f2; cursor: not-allowed; color: #888;" title="Email tidak dapat diubah">
                <small style="font-size: 0.7rem; color: #aaa; margin-top: 4px; display: block;">*Email tidak dapat diubah karena terhubung dengan akun Anda.</small>
            </div>

            <div class="mb-3">
                <label class="profile-label" for="phone">Nomor HP</label>
                <input class="profile-input" type="tel" id="phone" name="phone" placeholder="Contoh: 08123456789" value="<?php echo e(old('phone', auth()->user()->phone)); ?>">
            </div>

            <p class="section-label">Alamat pengiriman</p>

            <div class="mb-3">
                <label class="profile-label" for="address">Alamat</label>
                <input class="profile-input" type="text" id="address" name="address" placeholder="Jl. Merdeka No. 10..." value="<?php echo e(old('address', auth()->user()->address)); ?>">
            </div>

            <div class="d-flex gap-3 form-row-2">
                <div class="mb-3 flex-fill">
                    <label class="profile-label" for="city">Kota</label>
                    <input class="profile-input" type="text" id="city" name="city" placeholder="Pontianak" value="<?php echo e(old('city', auth()->user()->city)); ?>">
                </div>
                <div class="mb-3 flex-fill">
                    <label class="profile-label" for="postal_code">Kode pos</label>
                    <input class="profile-input" type="text" id="postal_code" name="postal_code" placeholder="78111" value="<?php echo e(old('postal_code', auth()->user()->postal_code)); ?>">
                </div>
            </div>

            <button type="submit" class="btn-simpan">Simpan perubahan</button>
            <a href="/" class="btn-batal">Batal</a>
        </form>
    </div>

    <div class="profile-card">
        <p class="profile-card-title">Ubah Password</p>
        <p class="profile-card-sub">Gunakan password yang kuat untuk keamanan akun kamu.</p>

        <?php if($errors->has('current_password')): ?>
            <div class="alert alert-danger rounded-3 py-2 px-3" style="font-size:0.85rem;">
                <?php echo e($errors->first('current_password')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('profile.password')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="profile-label" for="current_password">Password lama</label>
                <input class="profile-input <?php echo e($errors->has('current_password') ? 'is-invalid' : ''); ?>" type="password" id="current_password" name="current_password" placeholder="••••••••">
            </div>

            <div class="d-flex gap-3 form-row-2">
                <div class="mb-3 flex-fill">
                    <label class="profile-label" for="password">Password baru</label>
                    <input class="profile-input <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>" type="password" id="password" name="password" placeholder="••••••••">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-msg"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3 flex-fill">
                    <label class="profile-label" for="password_confirmation">Konfirmasi password</label>
                    <input class="profile-input" type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="btn-simpan">Ubah password</button>
        </form>
    </div>
</div>

<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarCircle').innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/edit.blade.php ENDPATH**/ ?>