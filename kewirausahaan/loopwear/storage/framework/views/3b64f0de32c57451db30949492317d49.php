<?php $__env->startSection('konten'); ?>
<div class="container" style="max-width:480px; margin:80px auto;">
    <div class="card border-0 shadow-sm p-4" style="border-radius:20px;">
        <h2 style="font-family:'Fredoka One',cursive; color:#E7998B; text-align:center; margin-bottom:24px;">Reset Password</h2>

        <form method="POST" action="<?php echo e(route('password.update')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="token" value="<?php echo e($token); ?>">

            <div class="mb-3">
                <input type="email" name="email" class="form-control" value="<?php echo e($email ?? old('email')); ?>" readonly required style="border-radius:10px; padding:12px; font-family:'Quicksand',sans-serif; background-color: #f8f9fa;">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                    <div style="color:red; font-size:0.8rem; margin-top:4px;"><?php echo e($message); ?></div> 
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password baru" required style="border-radius:10px; padding:12px; font-family:'Quicksand',sans-serif;">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                    <div style="color:red; font-size:0.8rem; margin-top:4px;"><?php echo e($message); ?></div> 
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru" required style="border-radius:10px; padding:12px; font-family:'Quicksand',sans-serif;">
            </div>

            <button type="submit" style="width:100%; background:#47510B; color:#fff24d; border:none; border-radius:999px; padding:12px; font-weight:800; font-family:'Quicksand',sans-serif; cursor:pointer;">
                Reset Password
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\OneDrive\Documents\Kuliah\Semester 2\Kewirausahaan\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>