<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('index', [ProductController::class, 'index'])->name('index');
    Route::get('show/{id}', [ProductController::class, 'show'])->name('show');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::put('update/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
});
