<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CityController;

Route::get('provinces/index', [ProvinceController::class, 'index'])->name('provinces.index')->withoutMiddleware('auth:sanctum');
Route::get('cities/index', [CityController::class, 'index'])->name('cities.index')->withoutMiddleware('auth:sanctum');
