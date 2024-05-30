<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
    Route::get('index', [BrandController::class, 'index'])->name('index');
    Route::get('show/{id}', [BrandController::class, 'show'])->name('show');
    Route::post('store', [BrandController::class, 'store'])->name('store');
    Route::put('update/{id}', [BrandController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [BrandController::class, 'destroy'])->name('destroy');
});
