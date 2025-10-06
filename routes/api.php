<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\AgendaFacadeController;

// RUTAS PÚBLICAS
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

// RUTAS PROTEGIDAS CON JWT
Route::middleware('auth:api')->group(function () {

    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    // Mascotas
    Route::get('mascotas', [MascotaController::class, 'index']);
    Route::get('mascotas/{id}', [MascotaController::class, 'show']);
    Route::post('mascotas', [MascotaController::class, 'store']);
    Route::put('mascotas/{id}', [MascotaController::class, 'update']);
    Route::delete('mascotas/{id}', [MascotaController::class, 'destroy']);

    // Servicios
    Route::get('servicios', [ServicioController::class, 'index']);
    Route::get('servicios/{id}', [ServicioController::class, 'show']);
    Route::post('servicios', [ServicioController::class, 'store']);
    Route::put('servicios/{id}', [ServicioController::class, 'update']);
    Route::delete('servicios/{id}', [ServicioController::class, 'destroy']);

    // Citas
    Route::get('citas', [AgendaFacadeController::class, 'index']);
    Route::post('citas', [AgendaFacadeController::class, 'store']);
    Route::put('citas/{id}', [AgendaFacadeController::class, 'update']);
    Route::delete('citas/{id}', [AgendaFacadeController::class, 'destroy']);
});
