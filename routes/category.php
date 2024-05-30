<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('index', [CategoryController::class, 'index'])->name('index');
    Route::get('show/{id}', [CategoryController::class, 'show'])->name('show');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});
