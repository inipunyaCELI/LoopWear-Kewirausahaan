@extends('layout.main')
@section('konten')
<div class="container mt-5">
    <h3>Daftar Pesanan Masuk</h3>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>No. Pesanan</th>
                <th>Pelanggan</th>
                <th>Total Bayar</th>
                <th>Status Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->user->name }}</td>
                <td>Rp {{ number_format($order->total_price) }}</td>
                <td>
                    <span class="badge {{ $order->status_payment == 'success' ? 'bg-success' : 'bg-warning' }}">
                        {{ strtoupper($order->status_payment) }}
                    </span>
                </td>
                <td>
                    <a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-info text-white">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada pesanan masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection