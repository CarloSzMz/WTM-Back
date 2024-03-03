<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

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
