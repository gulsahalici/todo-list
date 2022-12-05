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

Route::get('/hello-inertia', function() {
    return Inertia::render('Welcome', [
        'name' => 'Gülşah'
    ]);
});

Route::get('/settings', function() {
    sleep(2);
    return Inertia::render('Settings');
});

Route::get('/users', function() {
    return Inertia::render('Users');
});

Route::get('/login', App\Http\Controllers\Web\Auth\LoginController::class)->name('login')->middleware('guest');
Route::get('/register', App\Http\Controllers\Web\Auth\RegisterController::class)->name('register')->middleware('guest');
Route::get('/', App\Http\Controllers\Web\DashboardController::class)->middleware('auth:sanctum');
