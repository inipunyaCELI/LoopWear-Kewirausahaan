@extends('layout.main')

@section('konten')

<div class="container py-5 text-center">

    <h2 class="title-main mb-4">
        {{ ucfirst($kategori) }} LoopWear
    </h2>

    <div class="row g-4">

        @forelse($items as $item)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="text-center">

                <div class="product-img-wrapper">
                    <img src="{{ asset('images/'.$item->gambar) }}" class="product-img">
                </div>

                <h6 class="product-name">{{ $item->nama_barang }}</h6>

                <div class="product-meta">
                    <span class="price">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </span>

                    <span class="divider">|</span>

                    <form action="{{ route('wishlist.add', $item->id_barang) }}" method="POST">
                        @csrf
                        <button class="icon love">❤️</button>
                    </form>

                    <form action="{{ route('cart.add', $item->id_barang) }}" method="POST">
                        @csrf
                        <button class="icon cart">🛒</button>
                    </form>
                </div>

            </div>
        </div>

        @empty
        <p class="text-muted">Produk belum tersedia</p>
        @endforelse

    </div>

</div>

@endsection