@extends('layout.main')

@section('konten')
<div class="container py-5">
    <div class="text-center mb-5 mt-4">
        <img src="{{ asset('images/logo_loop.jpeg') }}" alt="Loop Logo" style="max-width: 300px;" class="mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="lead text-muted" style="line-height: 1.8;">
                    <strong>LoopWear</strong> adalah usaha yang bergerak di bidang penjualan pakaian preloved berkualitas yang masih layak pakai dan tetap stylish. LoopWear hadir dengan tujuan memberikan kesempatan kedua bagi pakaian agar tetap bisa digunakan dan tidak terbuang sia-sia.
                </p>
                <p class="text-muted">
                    Kami percaya bahwa fashion tidak harus selalu baru untuk tetap terlihat menarik. Dengan memilih pakaian preloved, kita tidak hanya bisa mendapatkan pakaian dengan harga yang lebih terjangkau, tetapi juga ikut berkontribusi dalam mengurangi limbah fashion dan mendukung gaya hidup yang lebih ramah lingkungan.
                </p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center pt-5">
        <div class="col-md-8">
            <h2 class="text-center fw-bold mb-4" style="color: #6A8EAE; font-family: 'Fredoka One';">Visi</h2>
            <p class="text-center mb-5 italic">"Menjadi platform penjualan pakaian preloved yang terpercaya dan membantu meningkatkan kesadaran masyarakat tentang pentingnya fashion berkelanjutan."</p>

            <h2 class="text-center fw-bold mb-4" style="color: #E7998B; font-family: 'Fredoka One';">Misi</h2>
            <ol class="list-group list-group-flush mb-5" style="background: transparent;">
                <li class="list-group-item border-0 text-center">1. Menyediakan pakaian preloved berkualitas dengan harga terjangkau.</li>
                <li class="list-group-item border-0 text-center">2. Memberikan alternatif fashion yang lebih ramah lingkungan.</li>
                <li class="list-group-item border-0 text-center">3. Membantu memperpanjang siklus penggunaan pakaian agar tidak terbuang sia-sia.</li>
                <li class="list-group-item border-0 text-center">4. Memberikan pengalaman belanja online yang mudah dan nyaman.</li>
            </ol>

            <h2 class="text-center fw-bold mb-4" style="color: #FFB6A9; font-family: 'Fredoka One';">Kenapa Memilih LoopWear?</h2>
            <ul class="list-unstyled text-center">
                <li class="mb-2">✓ Pakaian preloved yang masih berkualitas</li>
                <li class="mb-2">✓ Harga lebih terjangkau dibanding pakaian baru</li>
                <li class="mb-2">✓ Mendukung sustainable fashion</li>
                <li class="mb-2">✓ Produk dipilih dengan seleksi yang teliti</li>
            </ul>
        </div>
    </div>
</div>
@endsection