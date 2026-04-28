@extends('layout.main')
@section('konten')
<style>
    body {background-color: #FDFAD8; }
    .auth-container {
        max-width: 850px;
        margin: 50px auto;
        border-radius: 30px;
        overflow: hidden;
        background: #FFFFFF;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
    }

    .auth-yellow-side {
        background-color: #fff24d;
        padding: 60px 40px;
    }

    .auth-form-side {
        padding: 60px 50px;
        background-color: #FFFFFF;
    }

    .auth-title {
        color: #ffb6a9;
        font-family: 'Fredoka One', cursive;
    }

    .btn-auth-outline {
        border: 2px solid #333;
        border-radius: 50px;
        padding: 10px 40px;
        font-weight: bold;
        color: #333;
        transition: 0.3s;
    }

    .btn-auth-outline:hover {
        background: #333;
        color: #fff24d;
    }

    .btn-auth-solid {
        background-color: #fff24d;
        border: none;
        border-radius: 50px;
        padding: 12px;
        font-weight: bold;
        width: 100%;
    }

    .form-control {
        border-radius: 12px;
        background-color: #FDFAD8;
        border: 1px solid #E3E1C3;
        padding: 14px;
    }
</style>
<div class="auth-container">
    <div class="row g-0">
        <div class="col-md-7 auth-form-side">
            <div class="text-center mb-4">
                <h2 class="auth-title fw-bold">CREATE ACCOUNT</h2>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="NAME" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="EMAIL" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="PASSWORD" required>
                </div>
                <button type="submit" class="btn btn-auth-solid shadow-sm">SIGN UP</button>
            </form>
        </div>
        <div class="col-md-5 auth-yellow-side d-flex flex-column justify-content-center align-items-center text-center">
            <h2 class="fw-bold mb-3">HELLO, FRIEND!</h2>
            <p class="mb-4 small">Enter your personal details and start your journey with us</p>
            <a href="{{ route('login') }}" class="btn btn-auth-outline">SIGN IN</a>
        </div>
    </div>
</div>

@endsection