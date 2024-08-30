<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\UsuarioController;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('usuarios', [UsuarioController::class, 'index']);
Route::post('register', [UsuarioController::class, 'register']);
Route::post('login', [UsuarioController::class, 'login']);

Route::get('tipo', [TipoProductoController::class, 'index']);
Route::post('tipo', [TipoProductoController::class, 'create']);

Route::get('producto', [ProductoController::class, 'index']);
Route::get('producto/{id}', [ProductoController::class, 'show']);
Route::post('producto', [ProductoController::class, 'create']);
Route::put('producto/{id}', [ProductoController::class, 'update']);
Route::delete('producto/{id}', [ProductoController::class, 'destroy']);