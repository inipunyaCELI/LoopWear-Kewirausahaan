<?php $__env->startSection('konten'); ?>

<style>
    .review-page { min-height: 80vh; }
    .star-display { color: #f5c518; font-size: 1.2rem; letter-spacing: 2px; }
    .review-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 18px rgba(0,0,0,0.07);
        transition: transform 0.2s ease;
    }
    .review-card:hover { transform: translateY(-4px); }
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #E7998B, #fff24d);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }
    .review-header-section {
        background: linear-gradient(135deg, #fff24d 0%, #ffe88a 100%);
        padding: 60px 0 40px;
        text-align: center;
    }
    .review-header-section h1 {
        font-family: 'Fredoka One', cursive;
        color: #E7998B;
        font-size: 2.8rem;
    }
</style>

<div class="review-header-section">
    <h1>❤️ Ulasan Pelanggan</h1>
    <p class="text-muted fw-bold" style="font-size: 1.1rem;">Apa kata mereka tentang LoopWear?</p>
</div>

<div class="container review-page py-5">

    <?php if(session('success_review')): ?>
        <div class="alert alert-success rounded-3 mb-4"><?php echo e(session('success_review')); ?></div>
    <?php endif; ?>

    <?php if($reviews->isEmpty()): ?>
        <div class="text-center py-5">
            <h4 class="text-muted">Belum ada ulasan.</h4>
            <p class="text-muted">Jadilah yang pertama memberikan ulasan setelah berbelanja!</p>
            <a href="/products" class="btn btn-warning rounded-pill px-4 fw-bold mt-2">Mulai Belanja</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="card review-card h-100 p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="avatar">
                            <?php echo e(strtoupper(substr($review->user->name ?? 'U', 0, 1))); ?>

                        </div>
                        <div>
                            <h6 class="fw-bold mb-0"><?php echo e($review->user->name ?? 'Anonim'); ?></h6>
                            <small class="text-muted"><?php echo e($review->created_at->format('d M Y')); ?></small>
                        </div>
                    </div>

                    <div class="star-display mb-2">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <?php if($i <= $review->rating): ?> ★ <?php else: ?> ☆ <?php endif; ?>
                        <?php endfor; ?>
                        <small class="text-muted ms-1" style="font-size: 0.8rem;"><?php echo e($review->rating); ?>/5</small>
                    </div>

                    <p class="mb-0" style="color: #555; font-size: 0.95rem; line-height: 1.6;">
                        <?php echo e($review->komentar ?? 'Pelanggan ini tidak meninggalkan komentar.'); ?>

                    </p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/review.blade.php ENDPATH**/ ?>