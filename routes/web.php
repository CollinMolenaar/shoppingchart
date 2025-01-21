<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
