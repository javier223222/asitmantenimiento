<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImagenProductoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MantenimientoController;

// Rutas para los roles
Route::resource('roles', RolController::class);

// Rutas para las categorias
Route::resource('categorias', CategoriaController::class);

// Rutas para los usuarios
Route::resource('usuarios', UsuarioController::class);

// Rutas para las imagenes de producto
Route::resource('imagenes', ImagenProductoController::class);

// Rutas para los productos
Route::resource('productos', ProductoController::class);

// Rutas para los mantenimientos
Route::resource('mantenimientos', MantenimientoController::class);

// Ruta de ejemplo protegida por autenticación
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
