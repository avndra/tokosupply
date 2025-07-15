<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Resource routes
Route::resource('cities', App\Http\Controllers\CityController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('suppliers', App\Http\Controllers\SupplierController::class);
Route::resource('tokos', App\Http\Controllers\TokoController::class);
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('orders', App\Http\Controllers\OrderController::class);
