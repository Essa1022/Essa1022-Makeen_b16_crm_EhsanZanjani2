<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

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
     // Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
    // Route::resource('orders', OrderController::class);
    // Users Rooutes
Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
    Route::get('index{id?}', [UserController::class, 'index'])->name('index');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::put('update{id}', [UserController::class, 'update'])->name('update');
    Route::delete('delete{id}', [UserController::class, 'destroy'])->name('destroy');
});

// Product Routes
Route::group(['prefix' => 'products', 'as' => 'products.'], function(){
    Route::get('index{id?}', [ProductController::class, 'index'])->name('index');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::put('update{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('delete{id}', [ProductController::class, 'destroy'])->name('destroy');
});

// Orders Routes
Route::group(['prefix' => 'orders', 'as' => 'orders.'], function(){
    Route::get('index{id?}', [OrderController::class, 'index'])->name('index');
    Route::post('store', [OrderController::class, 'store'])->name('store');
    Route::put('update{id}', [OrderController::class, 'update'])->name('update');
    Route::delete('delete{id}', [OrderController::class, 'destroy'])->name('destroy');
});
// });

