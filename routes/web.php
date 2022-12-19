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
    Route::get('/login', App\Http\Controllers\Auth\Login\CreateController::class)->name('login');
    Route::post('/login', App\Http\Controllers\Auth\Login\StoreController::class)->name('login.store');

    Route::get('/register', App\Http\Controllers\Auth\Register\CreateController::class)->name('register');
    Route::post('/register', App\Http\Controllers\Auth\Register\StoreController::class)->name('register.store');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', App\Http\Controllers\DashboardController::class)->name('dashboard');

    Route::get('/tasks', App\Http\Controllers\Task\IndexController::class)->name('tasks');
    Route::post('/tasks', App\Http\Controllers\Task\StoreController::class)->name('task.store');
    Route::put('/tasks/{task}', App\Http\Controllers\Task\UpdateController::class)->name('task.update');
    Route::delete('/tasks/{task}', App\Http\Controllers\Task\DeleteController::class)->name('task.delete');

    Route::post('/logout', App\Http\Controllers\Auth\Logout\DestroyController::class)->name('logout');
});
