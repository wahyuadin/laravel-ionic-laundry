<?php

use App\Http\Controllers\AuthentifikasiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () { return redirect()->route('login'); });
Route::prefix('login')->group(function () {
    Route::get('/', [AuthentifikasiController::class, 'login'])->name('login');
    Route::post('proses', [AuthentifikasiController::class, 'proses'])->name('login.proses');
});
Route::get('/logout', [AuthentifikasiController::class, 'logout'])->name('logout');
Route::middleware('middleware')->group(function () {
    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');
    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori');
        Route::post('/tambah', [KategoriController::class, 'kategori_tambah'])->name('kategori.tambah');
        Route::put('{id}', [KategoriController::class, 'kategori_edit'])->name('kategori.edit');
        Route::delete('{id}', [KategoriController::class, 'kategori_hapus'])->name('kategori.hapus');
    });
    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('produk');
        Route::post('/tambah', [ProdukController::class, 'produk_tambah'])->name('produk.tambah');
        Route::put('{id}', [ProdukController::class, 'produk_edit'])->name('produk.edit');
        Route::delete('{id}', [ProdukController::class, 'produk_hapus'])->name('produk.hapus');
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order');
        Route::put('accept/{id}', [OrderController::class, 'order_accept'])->name('order.accept');
        Route::put('reject/{id}', [OrderController::class, 'order_reject'])->name('order.reject');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [DataUserController::class, 'index'])->name('user');
        Route::put('{id}', [DataUserController::class, 'user_edit'])->name('user.edit');
        Route::delete('{id}', [DataUserController::class, 'user_hapus'])->name('user.hapus');
    });
});


