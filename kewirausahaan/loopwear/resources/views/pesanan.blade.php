@extends('layout.main')

@section('konten')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-3" style="color: #4A4A4A;">Pesanan Saya</h3>
            
            <div class="alert alert-warning d-flex align-items-center" role="alert" style="border-radius: 10px;">
                <div class="me-3 fs-3">⚠️</div>
                <div>
                    <strong>Pemberitahuan:</strong><br>
                    Untuk <strong>Dibatalkan</strong> atau jika ingin <strong>Membatalkan Pesanan</strong>, harap hubungi admin di kontak: <strong>0812-3456-7890</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm" style="border-radius: 15px; border: none;">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-fill" id="pesananTabs" role="tablist" style="border-bottom: 2px solid #EBEBEB;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark py-3" id="semua-tab" data-bs-toggle="tab" data-bs-target="#semua" type="button" role="tab">Semua</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark py-3" id="dikemas-tab" data-bs-toggle="tab" data-bs-target="#dikemas" type="button" role="tab">Dikemas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark py-3" id="dikirim-tab" data-bs-toggle="tab" data-bs-target="#dikirim" type="button" role="tab">Dikirim</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark py-3" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai" type="button" role="tab">Selesai</button>
                </li>
            </ul>

            <div class="tab-content p-4" id="pesananTabsContent">
                <div class="tab-pane fade show active" id="semua" role="tabpanel">
                    @include('components.order_list', ['orders' => $semua])
                </div>
                
                <div class="tab-pane fade" id="dikemas" role="tabpanel">
                    @include('components.order_list', ['orders' => $dikemas])
                </div>
                
                <div class="tab-pane fade" id="dikirim" role="tabpanel">
                    @include('components.order_list', ['orders' => $dikirim])
                </div>
                
                <div class="tab-pane fade" id="selesai" role="tabpanel">
                    @include('components.order_list', ['orders' => $selesai])
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-link {
        border: none;
        color: #777 !important;
        border-bottom: 3px solid transparent;
    }
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #E7998B !important;
    }
    .nav-tabs .nav-link.active {
        color: #E7998B !important;
        background-color: transparent;
        border-bottom: 3px solid #E7998B;
    }
</style>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
function retryPayment(snapToken) {
    if (!snapToken) {
        alert("Token pembayaran tidak ditemukan. Harap hubungi admin.");
        return;
    }
    
    snap.pay(snapToken, {
        onSuccess: function(result){
            window.location.reload();
        },
        onPending: function(result){
            window.location.reload();
        },
        onError: function(result){
            alert("Gagal memproses pembayaran.");
            window.location.reload();
        },
        onClose: function(){
            alert('Kamu menutup popup tanpa menyelesaikan pembayaran.');
        }
    });
}
</script>
@endsection