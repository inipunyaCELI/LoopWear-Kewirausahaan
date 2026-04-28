@extends('layout.main')
@section('konten')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between bg-white">
        <h5>Koleksi Barang</h5>
        <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $b)
                <tr>
                    <td><img src="{{ asset('images/'.$b->gambar) }}" width="60" class="rounded"></td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>Rp {{ number_format($b->harga) }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $b->id_barang) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('barang.destroy', $b->id_barang) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection