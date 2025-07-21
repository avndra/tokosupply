<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderedItemController;

// AUTH
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.sanctum');

// USER: CRUD pesanan sendiri
Route::middleware(['auth.sanctum', 'role:user'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index']); // daftar pesanan user
    Route::post('/orders', [OrderController::class, 'store']); // checkout
    Route::get('/orders/{order}', [OrderController::class, 'show']); // detail pesanan user
    Route::get('/orders/{order}/items', [OrderedItemController::class, 'index']); // produk yang dipesan
});

// ADMIN: lihat & update semua pesanan
Route::middleware(['auth.sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'adminIndex']); // semua pesanan
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus']); // ubah status pesanan
    Route::get('/admin/orders/{order}', [OrderController::class, 'adminShow']); // detail pesanan
    Route::get('/admin/orders/{order}/items', [OrderedItemController::class, 'adminIndex']); // produk dipesan (admin)
});
