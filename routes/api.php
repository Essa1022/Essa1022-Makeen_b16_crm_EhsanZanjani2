<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('logout', [UserController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::post('login', [UserController::class, 'login'])->name('login');
// Route::middleware('auth:sanctum')->group(function(){
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
// });


