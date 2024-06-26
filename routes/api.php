<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//usuarios
Route::get('users', [AuthController::class, 'users']);

//articulos
Route::post('productos', [AuthController::class, 'productos']);
Route::get('Detalleproducto', [AuthController::class, 'Detalleproducto']);

Route::group([
    "middleware" => ["auth:api"]
], function () {
    Route::get('get_user', [AuthController::class, 'get_user']);
    Route::get('ver_carrito', [AuthController::class, 'ver_carrito']);
    Route::post('add_carrito', [AuthController::class, 'add_carrito']);
    Route::put('update_carrito', [AuthController::class, 'update_carrito']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::put('update_user', [AuthController::class, 'update_user']);
    Route::delete('eliminarProdCarrito', [AuthController::class, 'eliminarProdCarrito']);
    Route::get('ver_pedidos', [AuthController::class, 'ver_pedidos']);
    Route::get('ver_Detalle_pedido', [AuthController::class, 'ver_Detalle_pedido']);
    Route::post('create_pedido', [AuthController::class, 'create_pedido']);
    Route::post('ver_pedido_especifico', [AuthController::class, 'ver_pedido_especifico']);
});
