<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

Route::group(['prefix' => 'teams', 'as' => 'teams.'], function () {
    Route::get('index', [TeamController::class, 'index'])->name('index');
    Route::get('show/{id}', [TeamController::class, 'show'])->name('show');
    Route::post('store', [TeamController::class, 'store'])->name('store');
    Route::put('update/{id}', [TeamController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [TeamController::class, 'destroy'])->name('destroy');
});
