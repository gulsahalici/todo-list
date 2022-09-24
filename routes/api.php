<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', App\Http\Controllers\Api\Task\IndexController::class);
    Route::post('/tasks', App\Http\Controllers\Api\Task\StoreController::class);
    Route::put('/tasks/{task}', App\Http\Controllers\Api\Task\UpdateController::class);
    Route::delete('/tasks/{task}', App\Http\Controllers\Api\Task\DeleteController::class);

    Route::post('/auth/logout', App\Http\Controllers\Api\Auth\LogoutController::class)->name('logout');
});


Route::post('/auth/register', App\Http\Controllers\Api\Auth\RegisterController ::class);
Route::post('/auth/login', App\Http\Controllers\Api\Auth\LoginController::class);