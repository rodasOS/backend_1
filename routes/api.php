<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('usuarios', [UsuarioController::class, 'index']);
Route::post('register', [UsuarioController::class, 'register']);
Route::post('login', [UsuarioController::class, 'login']);