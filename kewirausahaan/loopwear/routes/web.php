<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cbarang;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);

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
