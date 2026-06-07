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
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'auth']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

Route::get('/reset-password/{token}', function (Illuminate\Http\Request $request, $token) {
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->query('email')
    ]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('barang', Cbarang::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}/detail', [OrderController::class, 'detail'])->name('admin.orders.detail');
    Route::post('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan/{id}/cancel', [PesananController::class, 'cancel'])->name('pesanan.cancel');
    Route::post('/pesanan/{id}/complete', [PesananController::class, 'complete'])->name('pesanan.complete');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::post('/checkout/voucher', [CartController::class, 'applyVoucherCheckout'])->name('checkout.voucher'); // ← TAMBAH DI SINI
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', function () { return view('checkout_success'); })->name('checkout.success');
    Route::get('/checkout/finish', function() { return view('checkout_finish'); })->name('checkout.finish');
});

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/about', function() { return view('about'); })->name('user.about');
Route::get('/contact', function () { return view('contact'); })->name('contact');

Route::post('/contact', function (Request $request) {
    try {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->with('error', 'Eits, formnya nggak boleh dikosongin ya! Isi dulu dong 🥺');
    }

    $isiPesan = "Ada pesan masuk dari form Contact Us LoopWear!\n\n" .
                "Nama: {$request->nama}\n" .
                "Telepon: {$request->telepon}\n" .
                "Email: {$request->email}\n\n" .
                "Isi Pesan:\n{$request->pesan}";

    try {
        Mail::raw($isiPesan, function ($message) use ($request) {
            $message->to('loopweaar@gmail.com')
                    ->subject('Pesan dari ' . $request->nama);
        });
        
        return back()->with('success', 'Pesan kamu berhasil dikirim ke Admin! ✨');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal mengirim pesan. Periksa koneksi internetmu. 😥');
    }
});

Route::get('/products', [ProductController::class, 'center'])->name('user.products');
Route::get('/category/{kategori}', [ProductController::class, 'category'])->name('category.show');
Route::get('/products/{id}', [ProductController::class, 'showDetail'])->name('user.products.detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/remove-selected', [CartController::class, 'removeSelected'])->name('cart.remove_selected');
Route::post('/cart/voucher', [CartController::class, 'applyVoucher'])->name('cart.voucher');
Route::get('/cart/voucher/remove', [CartController::class, 'removeVoucher'])->name('cart.voucher.remove');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::get('/review', [ReviewController::class, 'index'])->name('review.index');

Route::get('/admin/vouchers', [VoucherController::class, 'index'])->name('admin.vouchers.index');
Route::post('/admin/vouchers', [VoucherController::class, 'store'])->name('admin.vouchers.store');
Route::get('/admin/vouchers/{id}/toggle', [VoucherController::class, 'toggle'])->name('admin.vouchers.toggle');
Route::delete('/admin/vouchers/{id}', [VoucherController::class, 'destroy'])->name('admin.vouchers.destroy');
