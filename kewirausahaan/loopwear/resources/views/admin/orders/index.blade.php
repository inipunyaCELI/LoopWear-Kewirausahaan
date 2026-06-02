@extends('layout.main')

@section('konten')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0" style="color: #4A4A4A;">Kelola Pesanan</h3>
        <a href="/dashboard" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3 mb-4 d-flex align-items-center gap-2">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Order ID</th>
                            <th>Pembeli</th>
                            <th>Tanggal</th>
                            <th>Total Belanja</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $index => $order)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="fw-bold text-primary">{{ $order->order_number }}</td>
                            <td>
                                <div class="fw-bold">{{ $order->user->name ?? 'Guest' }}</div>
                                <small class="text-muted">{{ $order->user->email ?? '-' }}</small>
                            </td>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="fw-bold text-danger">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                @if($order->status_payment == 'success')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Sukses</span>
                                @elseif($order->status_payment == 'pending')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Pending</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ $order->status_payment }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    <!-- Lihat Detail -->
                                    <a href="{{ route('admin.orders.detail', $order->id) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3 shadow-sm">
                                        🔍 Detail
                                    </a>

                                    @if($order->status_payment == 'success')
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm" target="_blank">
                                            🖨️ Cetak
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-secondary rounded-pill px-3" disabled>Belum Lunas</button>
                                    @endif

                                    @if($order->status_payment != 'dibatalkan' && $order->status_delivery != 'dibatalkan')
                                        <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm">
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted fst-italic">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
