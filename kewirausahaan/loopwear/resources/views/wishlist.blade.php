@extends('layout.main')

@section('konten')
<div class="container py-5">
    <h2 class="text-center mb-5" style="color:#E7998B; font-family: 'Fredoka One', cursive;">My Wishlist ❤️</h2>

    <div class="row">
        {{-- Menggunakan $id => $item supaya sistem tahu kunci barangnya --}}
        @forelse($wishlist as $id => $item)
            <div class="col-6 col-md-3 mb-4">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                    <div class="product-img-wrapper" style="height: 220px; overflow: hidden; border-radius: 15px; position: relative;">
                        <img src="{{ asset('images/' . ($item['gambar'] ?? 'default.jpg')) }}" 
                             class="img-fluid w-100 h-100" 
                             style="object-fit: cover;"
                             onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                    </div>

                    <div class="card-body px-0 text-center d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <h6 style="font-weight: 800; color: #47510B; min-height: 40px;" class="text-truncate-2">{{ $item['nama'] ?? $item['nama_barang'] }}</h6>
                            <p class="fw-bold mb-0" style="color: #47510B;">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                        </div>

                        <div>
                            {{-- Tombol Add to Cart --}}
                            <form action="{{ route('cart.add', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100 mb-2" style="border-radius: 12px; font-weight: bold; background-color: #E7998B; border-color: #E7998B; color: white;">
                                    Add To Cart 🛒
                                </button>
                            </form>

                            {{-- Tombol Hapus (Diubah menjadi FORM POST/DELETE demi keamanan) --}}
                            <form action="{{ route('wishlist.remove', $id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini dari wishlist?');">
                                @csrf
                                @method('DELETE') {{-- Ubah atau hapus baris ini jika route di web.php Anda menggunakan Route::post --}}
                                <button type="submit" class="btn btn-link text-decoration-none p-0 w-100" style="color: #47510B; font-size: 0.8rem; font-weight: bold; opacity: 0.6;">
                                    ✕ Hapus Barang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5" style="font-family: 'Quicksand', sans-serif;">
                <p class="text-muted fs-5">Wishlist kamu masih kosong nih... 🥺</p>
                <a href="/products" class="btn rounded-pill px-4 py-2 fw-bold" style="background-color: #47510B; color: #fffacf;">Cari Baju Lucu</a>
            </div>
        @endforelse
    </div>
</div>

<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>
@endsection