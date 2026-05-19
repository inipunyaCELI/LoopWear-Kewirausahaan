<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function auth(Request $request) {
        // Tambahkan regex dan custom message
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

    public function register() {
        return view('auth.register');
    }

    public function storeRegister(Request $request) {
        // Samakan regex di registrasi agar data yang masuk juga valid
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

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function redirectToGoogle(){
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
}