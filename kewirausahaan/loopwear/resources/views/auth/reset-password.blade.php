@extends('layout.main')

@section('konten')
<div class="container" style="max-width:480px; margin:80px auto;">
    <div class="card border-0 shadow-sm p-4" style="border-radius:20px;">
        <h2 style="font-family:'Fredoka One',cursive; color:#E7998B; text-align:center; margin-bottom:24px;">Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" readonly required style="border-radius:10px; padding:12px; font-family:'Quicksand',sans-serif; background-color: #f8f9fa;">
                @error('email') 
                    <div style="color:red; font-size:0.8rem; margin-top:4px;">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password baru" required style="border-radius:10px; padding:12px; font-family:'Quicksand',sans-serif;">
                @error('password') 
                    <div style="color:red; font-size:0.8rem; margin-top:4px;">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-4">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru" required style="border-radius:10px; padding:12px; font-family:'Quicksand',sans-serif;">
            </div>

            <button type="submit" style="width:100%; background:#47510B; color:#fff24d; border:none; border-radius:999px; padding:12px; font-weight:800; font-family:'Quicksand',sans-serif; cursor:pointer;">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection