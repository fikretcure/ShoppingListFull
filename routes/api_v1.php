<?php

use App\Http\Controllers\v1\authController;
use App\Http\Controllers\v1\ProductsController;
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

Route::name('auth.')->prefix('auth')->group(function () {
    Route::post('/login', [authController::class, "login"])->name("login");
    Route::post('/logout', [authController::class, "logout"])->name("logout");
});
Route::apiResources([
    'products' => ProductsController::class,
]);
