<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login() 
    {
        return view('auth.login');
    }

    public function auth(Request $request) 
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9.]+@gmail\.com$/'],
            'password' => 'required'
        ], [
            'email.regex' => 'Format email salah! Gunakan hanya huruf, angka, dan wajib diakhiri @gmail.com'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard'); 
            }

            return redirect('/'); 
        }

        return back()->with('loginError', 'Email atau password salah!');
    }

    public function register() 
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request) 
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users', 'regex:/^[a-zA-Z0-9.]+@gmail\.com$/'],
            'password' => 'required|min:5'
        ], [
            'email.regex' => 'Email hanya boleh berisi huruf/angka dan wajib berakhiran @gmail.com'
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'user';

        User::create($data);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('loopwear123'), 
                    'role' => 'user',
                ]);
            
                usleep(500000); 
            } else {
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->id]);
                }
            }

            Auth::loginUsingId($user->id);
        
            request()->session()->regenerate();
            request()->session()->save();
        
            return redirect()->route('home');
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google');
        }
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email ini belum terdaftar di LoopWear!'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password berhasil dikirim! Cek inbox/spam Gmail kamu ya. ✨');
        }

        return back()->with('error', 'Waduh, gagal ngirim link. Coba lagi nanti ya.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password baru tidak cocok!'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect('/login')->with('success', 'Password kamu berhasil diubah! Silakan login kembali dengan password baru. 🎉');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}