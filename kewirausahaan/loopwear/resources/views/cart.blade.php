@extends('layout.main')

@section('konten')
<div class="container py-5">
    <h2>Your Cart</h2>

    @foreach($cart as $id => $item)
    <div class="row mb-3 align-items-center border p-2 rounded">

        <div class="col-md-1">
            <input type="checkbox"
                   class="item-check"
                   name="selected[]"
                   value="{{ $id }}"
                   data-price="{{ $item['harga'] }}"
                   data-qty="{{ $item['qty'] }}"
                   checked
                   form="formCheckout">
        </div>

        <div class="col-md-2">
            <img src="{{ asset('images/'.$item['gambar']) }}" width="80">
        </div>

        <div class="col-md-2">
            {{ $item['nama'] }}
        </div>

        <div class="col-md-2">
            Rp {{ number_format($item['harga'],0,',','.') }}
        </div>

        <div class="col-md-2">
            <form action="{{ route('cart.update', $id) }}" method="POST">
                @csrf
                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" style="width:60px">
                <button type="submit" class="btn btn-sm btn-primary">OK</button>
            </form>
        </div>

        <div class="col-md-2 text-danger">
            Rp {{ number_format($item['harga'] * $item['qty'],0,',','.') }}
        </div>

        <div class="col-md-1">
            <a href="{{ route('cart.remove', $id) }}">X</a>
        </div>

    </div>
    @endforeach

    <hr>

    <h4>Total: Rp <span id="totalHarga">0</span></h4>

    <form id="formCheckout" action="{{ route('checkout.index') }}" method="GET">
        <button type="submit" class="btn btn-success">
            Checkout
        </button>
    </form>

</div>

<script>
function hitungTotal() {
    let total = 0;

    document.querySelectorAll('.item-check:checked').forEach(item => {
        let price = parseInt(item.dataset.price);
        let qty = parseInt(item.dataset.qty);
        total += price * qty;
    });

    document.getElementById('totalHarga').innerText =
        total.toLocaleString('id-ID');
}

hitungTotal();

document.querySelectorAll('.item-check').forEach(el => {
    el.addEventListener('change', hitungTotal);
});
</script>

@endsection