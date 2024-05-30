<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;

Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
    Route::get('show/{modelType}/{modelId}/{mediaId}', [MediaController::class, 'show'])->name('show');
    Route::post('store/{modelType}/{modelId}', [MediaController::class, 'store'])->name('store');
    Route::post('update/{modelType}/{modelId}', [MediaController::class, 'update'])->name('update');
    Route::delete('destroy/{modelType}/{modelId}/{mediaId}', [MediaController::class, 'destroy'])->name('destroy');
    Route::post('download/{modelType}/{modelId}/{mediaId}', [MediaController::class, 'download'])->name('download');
});
