@extends('layout.main')

@section('konten')
<div class="container py-5">
    <h2>Checkout</h2>

    <form action="{{ route('checkout.store') }}" method="POST">
    @csrf

    @foreach($selected as $id)
        <input type="hidden" name="selected[]" value="{{ $id }}">
    @endforeach

    <input type="text" name="nama" class="form-control mb-3" placeholder="Nama" required>
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <textarea name="alamat" class="form-control mb-3" placeholder="Alamat" required></textarea>

    <button class="btn btn-success">Lanjut Bayar</button>

    </form>
</div>
@endsection