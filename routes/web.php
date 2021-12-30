<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name("home");
Route::get('/login', function () {
    return view('pages.login');
});
Route::get('/products', function () {
    return view('pages.products');
})->name("products");;
Route::get('/products/filtered', function () {
    return view('pages.products_filtered');
})->name("products.filtered");;
