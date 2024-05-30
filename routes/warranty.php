<?php

use App\Http\Controllers\WarrantyController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'warranties', 'as' => 'warranties.'], function () {
    Route::get('index', [WarrantyController::class, 'index'])->name('index');
    Route::get('show/{id}', [WarrantyController::class, 'show'])->name('show');
    Route::post('store', [WarrantyController::class, 'store'])->name('store');
    Route::put('update/{id}', [WarrantyController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [WarrantyController::class, 'destroy'])->name('destroy');
});
