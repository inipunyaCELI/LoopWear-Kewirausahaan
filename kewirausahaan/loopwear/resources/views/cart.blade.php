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

        <div class="row mb-3 align-items-center border p-2 rounded">

            <!-- CHECKBOX -->
            <div class="col-md-1">
                <input type="checkbox" name="selected[]" value="{{ $id }}" checked>
            </div>

            <!-- IMAGE -->
            <div class="col-md-2">
                <img src="{{ asset('images/'.$item['gambar']) }}" width="80">
            </div>

            <!-- NAME -->
            <div class="col-md-2">
                {{ $item['nama'] }}
            </div>

            <!-- PRICE -->
            <div class="col-md-2">
                Rp {{ number_format($item['harga'],0,',','.') }}
            </div>

            <!-- QTY FORM (ISOLATED) -->
            <div class="col-md-2">
                <form action="{{ route('cart.update', $id) }}" method="POST">
                    @csrf
                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" style="width:60px">

                    <button type="submit" class="btn btn-sm btn-primary">
                        OK
                    </button>
                </form>
            </div>

            <!-- SUBTOTAL -->
            <div class="col-md-2 text-danger">
                Rp {{ number_format($subtotal,0,',','.') }}
            </div>

            <!-- REMOVE -->
            <div class="col-md-1">
                <a href="{{ route('cart.remove', $id) }}">X</a>
            </div>

        </div>
    @endforeach

    <hr>

    <h4>Total: Rp {{ number_format($total,0,',','.') }}</h4>

    <!-- CHECKOUT BUTTON (NO FORM WRAPPER!) -->
    <a href="{{ route('checkout.index') }}" class="btn btn-success">
        Checkout
    </a>

</div>
@endsection