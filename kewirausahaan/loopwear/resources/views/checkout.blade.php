@extends('layout.main')
@section('konten')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="card-body p-5 text-center">
                    <h3 class="fw-bold mb-4">Finalisasi Pesanan</h3>
                    <hr>
                    <div class="text-start mb-4">
                        <p><strong>Order ID:</strong> {{ $order->order_number }}</p>
                        <p><strong>Total Bayar:</strong> <span class="text-danger fw-bold">Rp {{ number_format($order->total_price) }}</span></p>
                    </div>

                    <button id="pay-button" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
                        Bayar Sekarang 💸
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snap_token }}', {
            onSuccess: function(result){
                alert("Pembayaran Berhasil!"); 
                window.location.href = "{{ route('checkout.finish') }}";
                console.log(result);
            },
            onPending: function(result){
                alert("Menunggu pembayaranmu!"); 
                console.log(result);
            },
            onError: function(result){
                alert("Pembayaran gagal!"); 
                console.log(result);
            },
            onClose: function(){
                alert('Kamu menutup layar pembayaran sebelum selesai.');
            }
        });
    });
</script>
@endsection