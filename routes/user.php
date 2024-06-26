<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('index', [UserController::class, 'index'])->name('index');
    Route::get('show/{id}', [UserController::class, 'show'])->name('show');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::put('update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
});
Route::post('login', [UserController::class, 'login'])->name('login')->withoutMiddleware('auth:sanctum');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
