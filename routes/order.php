<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('index', [OrderController::class, 'index'])->name('index');
    Route::get('show/{id}', [OrderController::class, 'show'])->name('show');
    Route::post('store', [OrderController::class, 'store'])->name('store');
    Route::put('update/{id}', [OrderController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [OrderController::class, 'destroy'])->name('destroy');
});
