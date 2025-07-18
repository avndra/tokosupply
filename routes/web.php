<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Auth\LoginController;

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

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboard::class, 'index'])->name('user.dashboard');
});

use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
