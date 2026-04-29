@extends('layout.main')

@section('konten')
<section id="hero-section" style="background-color: #F8F79D; transition: 0.5s; min-height: 100vh;">
    <div class="container pt-5">
        <div class="row align-items-center" style="min-height: 80vh;">
            <div class="col-md-6">
                <h1 id="hero-title" class="display-3 fw-bold mb-3" style="font-family: 'Fredoka One', cursive; color: #E7998B;">
                    Hijab LoopWear
                </h1>
                <p id="hero-desc" class="lead mb-4 text-muted">
                    Hijab premium, lembut, siap bikin outfit makin glowing.
                </p>
                <div class="d-flex gap-3 mb-5">
                    <a href="#products" class="btn btn-warning rounded-pill px-4 py-2 fw-bold shadow-sm" style="background-color: #F8F79D; border: 2px solid #E7998B;">ORDER NOW</a>
                    <a href="#products" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">VIEW MENU</a>
                </div>

                <div class="d-flex gap-3">
                    <img src="{{ asset('images/hijab_pink.jpg') }}" onclick="changeHero('hijab')" class="img-thumbnail rounded-3" style="width: 60px; cursor: pointer;">
                    <img src="{{ asset('images/baju.jpg') }}" onclick="changeHero('baju')" class="img-thumbnail rounded-3" style="width: 60px; cursor: pointer;">
                    <img src="{{ asset('images/celana.jpg') }}" onclick="changeHero('celana')" class="img-thumbnail rounded-3" style="width: 60px; cursor: pointer;">
                    <img src="{{ asset('images/sepatu.jpg') }}" onclick="changeHero('sepatu')" class="img-thumbnail rounded-3" style="width: 60px; cursor: pointer;">
                </div>
            </div>

            <div class="col-md-6 text-center position-relative">
                <div id="hero-glow" class="position-absolute top-50 start-50 translate-middle" 
                     style="width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%); z-index: 1;">
                </div>
                <img id="hero-img" src="img/main-hijab.png" class="img-fluid position-relative" style="z-index: 2; max-height: 500px;" alt="">
            </div>
        </div>
    </div>
</section>

<div id="products" class="container mt-5">
    <h2 class="text-center mb-4">Our Collections</h2>
    <div class="row">
        @foreach($items as $item)
        <div class="col-md-3 mb-4">
            </div>
        @endforeach
    </div>
</div>

<script>
    function changeHero(category) {
        const title = document.getElementById('hero-title');
        const desc = document.getElementById('hero-desc');
        const img = document.getElementById('hero-img');
        const section = document.getElementById('hero-section');

        // Gunakan path /images/ dan ekstensi .jpg sesuai folder kamu
        if (category === 'hijab') {
            title.innerText = "Hijab LoopWear";
            desc.innerText = "Hijab premium, lembut, siap bikin outfit makin glowing.";
            img.src = "{{ asset('images/hijab_pink.jpg') }}"; 
            section.style.backgroundColor = "#F8F79D"; 
        } else if (category === 'baju') {
            title.innerText = "Baju LoopWear";
            desc.innerText = "Blouse, kemeja, dan kaos ternyaman yang siap nemenin ootd harianmu.";
            img.src = "{{ asset('images/baju.jpg') }}"; 
            section.style.backgroundColor = "#FDE2E2"; 
        } else if (category === 'celana') {
            title.innerText = "Celana LoopWear";
            desc.innerText = "Cari jeans vintage atau culotte santai? Temukan fitting terbaikmu di sini.";
            img.src = "{{ asset('images/celana.jpg') }}"; 
            section.style.backgroundColor = "#C3C7F4"; 
        } else if (category === 'sepatu') {
            title.innerText = "Sepatu LoopWear";
            desc.innerText = "Step up your look! Sneakers & heels preloved tapi tetap kece.";
            img.src = "{{ asset('images/sepatu.jpg') }}"; 
            section.style.backgroundColor = "#A7B896";
        }
    }
</script>
@endsection