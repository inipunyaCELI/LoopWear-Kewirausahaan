<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoopWear - Preloved Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background-color: #fff; }
        .navbar { background-color: #F8F79D !important; padding: 15px 0; }
        .navbar-brand { font-family: 'Fredoka One'; color: #E7998B !important; font-size: 1.8rem; }
        .nav-link { color: #E7998B !important; font-weight: bold; margin: 0 10px; }
        .nav-link:hover { color: #4A4A4A !important; }
        .sticky-top { position: sticky; top: 0; z-index: 1020; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Loop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#review">Review</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
            <div class="d-flex gap-3">
                <a href="#" class="text-decoration-none">❤️</a>
                <a href="#" class="text-decoration-none">🛒</a>
                <a href="/login" class="text-decoration-none">👤</a>
            </div>
        </div>
    </div>
</nav>

@yield('konten')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>