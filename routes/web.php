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

Route::get('/login', App\Http\Controllers\Web\Auth\Login\CreateController::class)->name('login')->middleware('guest');
Route::post('/login', App\Http\Controllers\Web\Auth\Login\StoreController::class)->name('login.store')->middleware('guest');

Route::get('/register', App\Http\Controllers\Web\Auth\Register\CreateController::class)->name('register')->middleware('guest');
Route::post('/register', App\Http\Controllers\Web\Auth\Register\StoreController::class)->name('register.store')->middleware('guest');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', App\Http\Controllers\Web\DashboardController::class)->name('dashboard');

    /*Route::get('/users', App\Http\Controllers\Api\User\IndexController::class);

    Route::get('/tasks', App\Http\Controllers\Api\Task\IndexController::class);
    Route::post('/tasks', App\Http\Controllers\Api\Task\StoreController::class);
    Route::put('/tasks/{task}', App\Http\Controllers\Api\Task\UpdateController::class);
    Route::delete('/tasks/{task}', App\Http\Controllers\Api\Task\DeleteController::class);
*/
    Route::post('/logout', App\Http\Controllers\Web\Auth\Logout\DestroyController::class)->name('logout');
});




//Route::get('/login', App\Http\Controllers\Web\Auth\LoginController::class)->name('login')->middleware('guest');
//Route::get('/register', App\Http\Controllers\Web\Auth\RegisterController::class)->name('register')->middleware('guest');
//Route::get('/', App\Http\Controllers\Web\DashboardController::class)->middleware('auth:sanctum');
