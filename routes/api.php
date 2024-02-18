<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\UserController;
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
*/

Route::controller(UserController::class)->group(function () {
    Route::post('user/login', 'login');
    Route::get('user/me', 'me');
});

Route::middleware(['auth:api'])->group(function () {
    Route::controller(BeerController::class)->group(function () {
        Route::get('beers', 'index');
        Route::get('beers/{id}', 'show');
    });
});
