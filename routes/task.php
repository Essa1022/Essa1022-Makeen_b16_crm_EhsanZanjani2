<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {
    Route::get('index', [TaskController::class, 'index'])->name('index');
    Route::get('show/{id}', [TaskController::class, 'show'])->name('show');
    Route::post('store', [TaskController::class, 'store'])->name('store');
    Route::put('update/{id}', [TaskController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [TaskController::class, 'destroy'])->name('destroy');
});
