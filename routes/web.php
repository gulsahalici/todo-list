<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', App\Http\Controllers\Web\Auth\Login\CreateController::class)->name('login');
    Route::post('/login', App\Http\Controllers\Web\Auth\Login\StoreController::class)->name('login.store');

    Route::get('/register', App\Http\Controllers\Web\Auth\Register\CreateController::class)->name('register');
    Route::post('/register', App\Http\Controllers\Web\Auth\Register\StoreController::class)->name('register.store');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', App\Http\Controllers\Web\DashboardController::class)->name('dashboard');

    Route::post('/logout', App\Http\Controllers\Web\Auth\Logout\DestroyController::class)->name('logout');
});
