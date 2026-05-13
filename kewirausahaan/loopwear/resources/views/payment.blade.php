@extends('layout.main')

@section('konten')
<style>
    body { background-color: #f8f9fa; }
    .payment-page { font-family: 'Quicksand', sans-serif; max-width: 550px; margin: 0 auto; padding-bottom: 50px; }
    
    .payment-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        padding: 50px 30px;
        margin-top: 60px;
        text-align: center;
    }

    .text-orange { color: #ee4d2d !important; }
    
    /* Tombol Midtrans Custom */
    .btn-midtrans { 
        background: #556B2F; /* Grassy Green */
        color: white; 
        border: none; 
        padding: 14px 30px; 
        border-radius: 8px; 
        font-weight: bold; 
        font-size: 1.1rem;
        transition: 0.3s; 
        width: 100%; 
        margin-top: 25px; 
    }
    .btn-midtrans:hover { background: #425522; color: #fff; }

    /* Badge Order ID */
    .order-id {
        background: #f1f1f1;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        color: #555;
        display: inline-block;
        margin-bottom: 25px;
    }
</style>

<div class="payment-page pt-4">
    <div class="payment-card">
        
        <div style="font-size: 4.5rem; margin-bottom: 10px;">💳</div>
        <h3 class="fw-bold mb-3" style="color: #333;">Menunggu Pembayaran</h3>
        
        <div class="order-id">Order ID: <strong>{{ $order->order_number }}</strong></div>

        <p class="text-muted mb-4">
            Total tagihan belanja kamu:
            <br>
            <span class="text-orange fs-2 fw-bold d-block mt-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </p>

        <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
            Jendela pembayaran akan terbuka secara otomatis.<br>
            Jika jendela tidak muncul atau tidak sengaja tertutup, silakan klik tombol di bawah ini.
        </p>

        {{-- Tombol utama untuk Pelanggan --}}
        <button id="pay-button" class="btn-midtrans">Selesaikan Pembayaran</button>
        
        <div class="mt-4">
            <a href="{{ route('cart.index') }}" style="color: #999; text-decoration: none; font-size: 0.9rem;">← Batalkan & Kembali ke Keranjang</a>
        </div>
    </div>
</div>

{{-- SCRIPT MIDTRANS SNAP --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    // 1. Fungsi bawaan Midtrans saat tombol diklik
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('checkout.success') }}";
            },
            onPending: function(result){
                window.location.href = "{{ route('checkout.success') }}"; 
            },
            onError: function(result){
                alert("Pembayaran gagal! Silakan coba lagi.");
            },
            onClose: function(){
                // Dibiarkan kosong agar pelanggan tetap di halaman ini jika pop-up ditutup
            }
        });
    };

    // 2. OTOMATIS BUKA POP-UP SAAT HALAMAN DIMUAT
    window.onload = function() {
        // Beri sedikit jeda 500ms agar halaman tampil cantik dulu, baru pop-up muncul
        setTimeout(function() {
            document.getElementById('pay-button').click();
        }, 500);
    };
</script>

@endsection