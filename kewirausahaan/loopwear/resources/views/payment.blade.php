@extends('layout.main')

@section('konten')

<div class="container mt-5 text-center">

    <h3>Finalisasi Pesanan</h3>

    <p>Order ID: {{ $order->id }}</p>
    <p>Total: Rp {{ number_format($order->total_price) }}</p>

    <button id="pay-button" class="btn btn-primary">
        Bayar Sekarang
    </button>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
snap.pay('{{ $snapToken }}');
</script>

@endsection