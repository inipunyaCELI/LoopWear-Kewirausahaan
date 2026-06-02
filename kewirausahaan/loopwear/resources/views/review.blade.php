@extends('layout.main')

@section('konten')

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

    @if(session('success_review'))
        <div class="alert alert-success rounded-3 mb-4">{{ session('success_review') }}</div>
    @endif

    @if($reviews->isEmpty())
        <div class="text-center py-5">
            <h4 class="text-muted">Belum ada ulasan.</h4>
            <p class="text-muted">Jadilah yang pertama memberikan ulasan setelah berbelanja!</p>
            <a href="/products" class="btn btn-warning rounded-pill px-4 fw-bold mt-2">Mulai Belanja</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($reviews as $review)
            <div class="col-md-6 col-lg-4">
                <div class="card review-card h-100 p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="avatar">
                            {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $review->user->name ?? 'Anonim' }}</h6>
                            <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                        </div>
                    </div>

                    <div class="star-display mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating) ★ @else ☆ @endif
                        @endfor
                        <small class="text-muted ms-1" style="font-size: 0.8rem;">{{ $review->rating }}/5</small>
                    </div>

                    <p class="mb-0" style="color: #555; font-size: 0.95rem; line-height: 1.6;">
                        {{ $review->komentar ?? 'Pelanggan ini tidak meninggalkan komentar.' }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
