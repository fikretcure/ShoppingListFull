<?php

use App\Http\Controllers\v1\authController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("jwt")->group(function () {
    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('/login', [authController::class, "login"])->name("login");
    });
});
