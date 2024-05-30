<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function () {
    Route::get('index', [TicketController::class, 'index'])->name('index');
    Route::get('show/{id}', [TicketController::class, 'show'])->name('show');
    Route::post('store', [TicketController::class, 'store'])->name('store');
    Route::put('update/{id}', [TicketController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [TicketController::class, 'destroy'])->name('destroy');
});
