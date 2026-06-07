@if($orders->isEmpty())
    <div class="text-center py-5">
        <h5 class="text-muted">Belum ada pesanan di kategori ini.</h5>
        <a href="{{ route('user.products') }}" class="btn btn-outline-primary mt-3" style="border-radius: 20px;">Mulai Belanja</a>
    </div>
@else
    @foreach($orders as $order)
        <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; background-color: #F8F9FA;">
            <div class="card-header bg-white d-flex justify-content-between align-items-center" style="border-bottom: 2px dashed #EBEBEB; border-radius: 12px 12px 0 0;">
                <div>
                    <span class="fw-bold" style="color: #4A4A4A;">{{ $order->order_number }}</span>
                    <span class="ms-2 text-muted" style="font-size: 0.85rem;">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div>
                    @if($order->status_payment == 'pending')
                        <span class="badge bg-warning text-dark px-3 py-2" style="border-radius: 20px;">Menunggu Pembayaran</span>
                    @elseif($order->status_payment == 'dibatalkan' || $order->status_delivery == 'dibatalkan')
                        <span class="badge bg-danger px-3 py-2" style="border-radius: 20px;">Dibatalkan</span>
                    @elseif($order->status_payment == 'success')
                        <span class="badge bg-success px-3 py-2" style="border-radius: 20px;">Dibayar</span>
                    @endif

                    @if($order->status_delivery == 'pending' && $order->status_payment == 'success')
                        <span class="badge bg-info text-dark px-3 py-2" style="border-radius: 20px;">Dikemas</span>
                    @elseif($order->status_delivery == 'dikirim')
                        <span class="badge bg-primary px-3 py-2" style="border-radius: 20px;">Dikirim</span>
                    @elseif($order->status_delivery == 'selesai')
                        <span class="badge bg-success px-3 py-2" style="border-radius: 20px;">Selesai</span>
                    @endif
                </div>
            </div>
            
            <div class="card-body">
                @foreach($order->orderItems as $item)
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2" style="border-bottom: 1px solid #EBEBEB;">
                        <div>
                            <p class="mb-0 fw-bold">{{ $item->nama_barang }}</p>
                            <small class="text-muted">{{ $item->qty }} x Rp {{ number_format($item->harga, 0, ',', '.') }}</small>
                        </div>
                        <div class="fw-bold">
                            Rp {{ number_format($item->qty * $item->harga, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
                
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2">
                    <div>
                        <span class="text-muted">Total Belanja:</span>
                        <h5 class="fw-bold text-danger mb-0">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h5>
                    </div>
                    @if($order->status_payment == 'pending')
                        <div class="d-flex gap-2">
                            <form action="{{ route('pesanan.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger fw-bold rounded-pill px-4">
                                    Batalkan
                                </button>
                            </form>

                            <button class="btn btn-warning fw-bold text-dark rounded-pill px-4" onclick="retryPayment('{{ $order->snap_token }}')">
                                ⚡ Lanjutkan Pembayaran
                            </button>
                        </div>
                    @elseif($order->status_delivery == 'dikirim')
                        <div class="d-flex gap-2">
                            <form action="{{ route('pesanan.complete', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin pesanan telah diterima dengan baik?');">
                                @csrf
                                <button type="submit" class="btn btn-success fw-bold text-white rounded-pill px-4">
                                    ✅ Pesanan Selesai
                                </button>
                            </form>
                        </div>
                    @elseif($order->status_payment != 'pending' && $order->status_delivery != 'dibatalkan' && $order->status_delivery != 'selesai')
                        <small class="text-muted fst-italic">Ingin membatalkan pesanan? <a href="/contact" class="text-decoration-none">Hubungi Admin</a></small>
                    @endif

                    @if($order->status_delivery == 'selesai')
                        @php
                            $sudahUlasan = \App\Models\Review::where('user_id', auth()->id())->where('order_id', $order->id)->exists();
                        @endphp
                        @if(!$sudahUlasan)
                            <button class="btn btn-outline-success fw-bold rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $order->id }}">
                                ⭐ Beri Ulasan
                            </button>

                            <div class="modal fade" id="reviewModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="border-radius: 15px;">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title fw-bold">Beri Ulasan Pesanan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('review.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="modal-body">
                                                <p class="text-muted mb-3">Order: <strong>{{ $order->order_number }}</strong></p>
                                                
                                                <div class="mb-3 text-center">
                                                    <label class="form-label fw-bold">Rating Bintang</label>
                                                    <div class="d-flex justify-content-center gap-2 fs-3" id="stars-{{ $order->id }}">
                                                        @for($i = 1; $i <= 5; $i++)
                                                        <span class="star-btn" data-value="{{ $i }}" data-order="{{ $order->id }}" style="cursor:pointer; color:#ccc; transition:color 0.2s;">★</span>
                                                        @endfor
                                                    </div>
                                                    <input type="hidden" name="rating" id="ratingInput-{{ $order->id }}" value="5">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Komentar <span class="text-muted fw-normal">(Opsional)</span></label>
                                                    <textarea name="komentar" class="form-control" rows="3" style="border-radius:10px;" placeholder="Tulis pengalamanmu di sini..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">Kirim Ulasan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="badge bg-secondary px-3 py-2 rounded-pill">✅ Sudah Diulas</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <script>
    document.querySelectorAll('.star-btn').forEach(function(star) {
        star.addEventListener('mouseover', function() {
            var orderId = this.dataset.order;
            var val = parseInt(this.dataset.value);
            document.querySelectorAll('#stars-' + orderId + ' .star-btn').forEach(function(s) {
                s.style.color = parseInt(s.dataset.value) <= val ? '#f5c518' : '#ccc';
            });
        });
        star.addEventListener('mouseout', function() {
            var orderId = this.dataset.order;
            var selected = parseInt(document.getElementById('ratingInput-' + orderId).value);
            document.querySelectorAll('#stars-' + orderId + ' .star-btn').forEach(function(s) {
                s.style.color = parseInt(s.dataset.value) <= selected ? '#f5c518' : '#ccc';
            });
        });
        star.addEventListener('click', function() {
            var orderId = this.dataset.order;
            var val = parseInt(this.dataset.value);
            document.getElementById('ratingInput-' + orderId).value = val;
            document.querySelectorAll('#stars-' + orderId + ' .star-btn').forEach(function(s) {
                s.style.color = parseInt(s.dataset.value) <= val ? '#f5c518' : '#ccc';
            });
        });
    });
    
    document.querySelectorAll('.star-btn[data-value="5"]').forEach(function(s) {
        s.click();
    });
    </script>
@endif