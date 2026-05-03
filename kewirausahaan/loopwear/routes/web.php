<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cbarang;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;

use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'auth']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
Route::resource('barang', Cbarang::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
});

Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/finish', function() {
    return view('checkout_finish');
})->name('checkout.finish');

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'center'])->name('user.products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('user.products.detail');

Route::get('/about', function() {
    return view('about');
})->name('user.about');

Route::get('/products', [ProductController::class, 'center'])->name('user.products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('user.products.detail');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::get('/category/{kategori}', [ProductController::class, 'category'])->name('category.show');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', function () {
    return view('checkout_success');
})->name('checkout.success');