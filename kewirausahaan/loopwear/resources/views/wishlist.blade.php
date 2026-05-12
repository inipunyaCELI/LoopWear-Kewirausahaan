@extends('layout.main')

@section('konten')
<div class="container py-5">
    <h2 class="text-center mb-5" style="color:#E7998B; font-family: 'Fredoka One', cursive;">My Wishlist ❤️</h2>

    <div class="row">
        {{-- Menggunakan $id => $item supaya sistem tahu kunci barangnya --}}
        @forelse($wishlist as $id => $item)
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px;">
                    <div class="product-img-wrapper" style="height: 250px; overflow: hidden; border-radius: 15px;">
                        <img src="{{ asset('images/' . ($item['gambar'] ?? 'default.jpg')) }}" 
                             class="img-fluid w-100 h-100" 
                             style="object-fit: cover;">
                    </div>

                    <div class="card-body px-0 text-center">
                        <h6 style="font-weight: 800; color: #47510B;">{{ $item['nama'] }}</h6>
                        <p style="color: #47510B;">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>

                        {{-- Tombol Add to Cart --}}
                        <form action="{{ route('cart.add', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning w-100 mb-2" style="border-radius: 12px; font-weight: bold;">
                                Add To Cart 🛒
                            </button>
                        </form>

                        {{-- Tombol Hapus --}}
                        <a href="{{ route('wishlist.remove', $id) }}" 
                           class="text-decoration-none d-block mt-2" 
                           style="color: #47510B; font-size: 0.8rem; font-weight: bold; opacity: 0.6;">
                           ✕ Hapus Barang
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p>Wishlist kamu masih kosong nih...</p>
                <a href="/products" class="btn btn-sm btn-outline-secondary">Cari Baju Lucu</a>
            </div>
        @endforelse
    </div>
</div>
@endsection