<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FactorController;

Route::group(['prefix' => 'factors', 'as' => 'factors.'], function () {
    Route::get('index', [FactorController::class, 'index'])->name('index');
    Route::get('show/{id}', [FactorController::class, 'show'])->name('show');
    Route::post('store', [FactorController::class, 'store'])->name('store');
    Route::put('update/{id}', [FactorController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [FactorController::class, 'destroy'])->name('destroy');
});
