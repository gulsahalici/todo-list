<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', App\Http\Controllers\Web\Auth\LoginController::class)->name('login')->middleware('guest');
Route::get('/register', App\Http\Controllers\Web\Auth\RegisterController::class)->name('register')->middleware('guest');
Route::get('/', App\Http\Controllers\Web\DashboardController::class)->middleware('auth:sanctum');
