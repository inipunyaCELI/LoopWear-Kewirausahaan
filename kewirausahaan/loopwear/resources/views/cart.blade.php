@extends('layout.main')

@section('konten')
<div class="container py-5">
    <h2>Your Cart</h2>

    @php $total = 0; @endphp

    @foreach($cart as $id => $item)
        @php 
            $subtotal = $item['harga'] * $item['qty']; 
            $total += $subtotal; 
        @endphp

        <div class="row mb-3 align-items-center">
            <div class="col-md-2">
                <img src="{{ asset('images/'.$item['gambar']) }}" width="80">
            </div>

            <div class="col-md-3">{{ $item['nama'] }}</div>
            <div class="col-md-2">Rp {{ number_format($item['harga'],0,',','.') }}</div>
            <div class="col-md-2">Qty: {{ $item['qty'] }}</div>
            <div class="col-md-2 text-danger">
                Rp {{ number_format($subtotal,0,',','.') }}
            </div>

            <div class="col-md-1">
                <a href="{{ route('cart.remove', $id) }}">X</a>
            </div>
        </div>
    @endforeach

    <h4>Total: Rp {{ number_format($total,0,',','.') }}</h4>

    <a href="{{ route('checkout.index') }}" class="btn btn-danger">
    Checkout
    </a>
</div>
@endsection