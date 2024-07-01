<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'cors'], function() {
    Route::middleware('api')->group(function () {
        Route::get('wa/{number}', [ApiController::class, 'wa']);
        Route::get('kategori', [ApiController::class, 'kategori']);
        Route::prefix('order')->group(function () {
            Route::post('/', [ApiController::class, 'order']);
            Route::put('cekout', [ApiController::class, 'order_cekout']);
            Route::get('history/{id}', [ApiController::class, 'order_history']);
        });
        Route::prefix('history')->group(function () {
            Route::get('{id}', [ApiController::class, 'history_show']);
            Route::post('/', [ApiController::class, 'history_add']);
        });
        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthController::class,'login']);
            Route::post('register', [AuthController::class,'register']);
            Route::get('logout', [AuthController::class,'logout']);
            Route::get('me', [AuthController::class,'me']);
            Route::post('refresh', [AuthController::class,'refresh']);
        });
        Route::prefix('profile')->group(function () {
            Route::put('{id}', [ApiController::class, 'edit_profile']);
            Route::get('{id}', [ApiController::class, 'profile_show']);
        });
        Route::prefix('produk')->group(function () {
            Route::get('/', [ApiController::class, 'produk']);
            Route::get('{id}', [ApiController::class,'produk_detail']);
        });
    });
});
