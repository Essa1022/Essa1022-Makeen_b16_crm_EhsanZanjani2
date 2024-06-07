<?php

use App\Jobs\CreateProductJob;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
// */
Route::get('test', function (){})->name('test');
Route::middleware('auth:sanctum')->group(function(){

    require __DIR__ . '/team.php';
    require __DIR__ . '/user.php';
    require __DIR__ . '/order.php';
    require __DIR__ . '/brand.php';
    require __DIR__ . '/category.php';
    require __DIR__ . '/product.php';
    require __DIR__ . '/warranty.php';
    require __DIR__ . '/factor.php';
    require __DIR__ . '/task.php';
    require __DIR__ . '/label.php';
    require __DIR__ . '/ticket.php';
    require __DIR__ . '/message.php';
    require __DIR__ . '/role.php';
    require __DIR__ . '/media.php';
    require __DIR__ . '/province.php';
});
