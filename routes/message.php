<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
    Route::get('index', [MessageController::class, 'index'])->name('index');
    Route::get('show/{id}', [MessageController::class, 'show'])->name('show');
    Route::post('store', [MessageController::class, 'store'])->name('store');
    Route::put('update/{id}', [MessageController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [MessageController::class, 'destroy'])->name('destroy');
});
