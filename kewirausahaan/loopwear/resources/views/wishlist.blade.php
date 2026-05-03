@extends('layout.main')

@section('konten')
<div class="container text-center py-5">
    <h2 style="color:#E7998B;">My Wishlist ❤️</h2>

    <div class="row mt-4">
        @foreach($wishlist as $id => $item)
        <div class="col-md-4">
            <img src="{{ asset('images/'.$item['gambar']) }}" class="img-fluid">

            <p>{{ $item['nama'] }}</p>
            <p>Rp {{ number_format($item['harga'],0,',','.') }}</p>

            <form action="{{ route('cart.add', $id) }}" method="POST">
                @csrf
                <button class="btn btn-warning">Add To Cart 🛒</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection