<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//USERS
Route::resource('users', UserController::class);
Route::get('/users', [UserController::class, 'index'])->name('users.index');

//STOCK
Route::resource('stock', StockController::class);
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');

//Categrories
Route::resource('category', CategoryController::class);
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

//Articles
Route::resource('articles', ArticlesController::class);
Route::get('/articles', [ArticlesController::class, 'index'])->name('article.index');

//Basket
Route::resource('basket', BasketController::class);
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::delete('/basket/{basketid}/{userid}', [BasketController::class, 'destroy'])->name('basket.destroy');
Route::get('/basket/create/{userid}', [BasketController::class, 'create'])->name('basket.create');

//Orders

Route::resource('order', OrdersController::class);
Route::get('/order', [OrdersController::class, 'index'])->name('order.index');
Route::get('/order/create/{userid}', [OrdersController::class, 'create'])->name('order.create');
