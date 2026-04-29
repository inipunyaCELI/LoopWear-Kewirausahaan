@extends('layout.main')

@section('konten')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600&display=swap');
    
    .product-page { font-family: 'Quicksand', sans-serif; background-color: #fff; }
    .title-kategori { font-family: 'Fredoka One', cursive; color: #4A4A4A; }
    .card-product { border: none; transition: 0.3s; border-radius: 20px; }
    .card-product:hover { transform: translateY(-5px); }
    .btn-view-all { border-radius: 50px; font-weight: bold; border: 2px solid #4A4A4A; color: #4A4A4A; }
</style>

<div class="container product-page py-5">
    <div class="text-center mb-5">
        <h1 class="title-kategori" style="color: #E7998B; font-size: 3rem;">CATEGORIES PRODUCTS</h1>
    </div>

    @foreach(['hijab' => 'Hijab LoopWear', 'baju' => 'Baju LoopWear', 'celana' => 'Celana LoopWear', 'sepatu' => 'Sepatu LoopWear'] as $key => $title)
    <section id="{{ $key }}" class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-kategori">{{ $title }}</h2>
            <button class="btn btn-view-all px-4">VIEW ALL</button>
        </div>

        <div class="row g-4">
            @forelse($data[$key] as $item)
            <div class="col-md-3">
                <div class="card card-product shadow-sm">
                    <div class="p-3">
                        <img src="{{ asset('images/' . $item->gambar) }}" class="card-img-top shadow-sm" 
                             style="border-radius: 15px; height: 250px; object-fit: cover;" 
                             onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                    </div>
                    <div class="card-body text-center pt-0">
                        <h6 class="fw-bold mb-1">{{ $item->nama_barang }}</h6>
                        <p class="text-danger fw-bold mb-2">Rp {{ number_format($item->harga) }}</p>
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-outline-secondary btn-sm rounded-circle">❤️</button>
                            <a href="{{ route('user.products.detail', $item->id_barang) }}" class="btn btn-dark btn-sm rounded-pill px-4">🛒 +</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted italic">Koleksi belum tersedia.</div>
            @endforelse
        </div>
    </section>
    <hr class="my-5" style="border-top: 2px dashed #FFB6A9; opacity: 0.5;">
    @endforeach
</div>
@endsection