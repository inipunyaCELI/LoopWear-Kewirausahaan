<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cbarang;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/', [Cbarang::class, 'katalog']); 

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
Route::resource('barang', Cbarang::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
});