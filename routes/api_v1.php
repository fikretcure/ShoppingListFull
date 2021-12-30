<?php

use App\Http\Controllers\v1\authController;
use App\Http\Controllers\v1\InBasketsController;
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
    Route::post('/check', [authController::class, "check"])->name("check");
});
/*  */
Route::name('products.')->prefix('products')->group(function () {
    Route::get('/filtered', [ProductsController::class, "filtered"])->name("filtered");
    Route::get('/group_color', [ProductsController::class, "group_color"])->name("group_color");
});
Route::name('inbaskets.')->prefix('inbaskets')->group(function () {
    Route::delete('/clear', [InBasketsController::class, "clear"])->name("clear");
});
Route::apiResources([
    'products' => ProductsController::class,
    'inbaskets' => InBasketsController::class,
]);
/*  */
