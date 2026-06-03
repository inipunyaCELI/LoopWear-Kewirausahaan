<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cbarang;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // <-- Tambahan untuk menangkap data form
use Illuminate\Support\Facades\Mail; // <-- Tambahan untuk mengirim email

// --- AUTENTIKASI ---
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'auth']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

// --- GOOGLE OAUTH ---
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// --- ADMIN AREA ---
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('barang', Cbarang::class);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin Orders
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}/detail', [OrderController::class, 'detail'])->name('admin.orders.detail');
    Route::post('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
});

// --- USER AUTHENTICATED AREA ---
Route::middleware(['auth'])->group(function () {
    // Pesanan user
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan/{id}/cancel', [PesananController::class, 'cancel'])->name('pesanan.cancel');
    Route::post('/pesanan/{id}/complete', [PesananController::class, 'complete'])->name('pesanan.complete');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// --- HALAMAN UTAMA & INFO ---
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/about', function() { return view('about'); })->name('user.about');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// --- FUNGSI BARU: PENANGKAP FORM CONTACT (ANTI KOSONG) ---
Route::post('/contact', function (Request $request) {
    
    // 1. SATPAM BACKEND: Cek kalau ada kotak yang kosong
    if (empty($request->nama) || empty($request->telepon) || empty($request->email) || empty($request->pesan)) {
        // Kalau kosong, tolak dan kembalikan dengan pesan error!
        return back()->with('error', 'Eits, formnya nggak boleh dikosongin ya! Isi dulu dong 🥺');
    }

    // 2. Rangkai isi pesannya (kalau sudah lolos satpam)
    $isiPesan = "Ada pesan masuk dari form Contact Us LoopWear!\n\n";
    $isiPesan .= "Nama: " . $request->nama . "\n";
    $isiPesan .= "Telepon: " . $request->telepon . "\n";
    $isiPesan .= "Email: " . $request->email . "\n\n";
    $isiPesan .= "Isi Pesan:\n" . $request->pesan;

    try {
        // 3. Kirim emailnya
        Mail::raw($isiPesan, function ($message) use ($request) {
            $message->to('loopweaar@gmail.com')
                    ->subject('Pesan dari ' . $request->nama);
        });
        
        // 4. Kembalikan ke halaman semula dengan pop-up sukses!
        return back()->with('success', 'Pesan kamu berhasil dikirim ke Admin! ✨');
        
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal mengirim pesan. Periksa koneksi internetmu. 😥');
    }
});

// --- PRODUK & REVIEW (DETAIL) ---
Route::get('/products', [ProductController::class, 'center'])->name('user.products');
Route::get('/category/{kategori}', [ProductController::class, 'category'])->name('category.show');
Route::get('/products/{id}', [ProductController::class, 'showDetail'])->name('user.products.detail');

// --- KERANJANG (CART) ---
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// --- WISHLIST (LIKE) ---
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

// --- CHECKOUT ---
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', function () { return view('checkout_success'); })->name('checkout.success');
Route::get('/checkout/finish', function() { return view('checkout_finish'); })->name('checkout.finish');

// --- REVIEW ---
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');