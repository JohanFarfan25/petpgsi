<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\AgendaFacadeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|
*/

//RUTAS PÚBLICAS (no requieren token)
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

//RUTAS PRIVADAS (requieren token JWT)
Route::middleware('auth:api')->group(function () {

    // -----------------------------
    //Autenticación y perfil
    // -----------------------------
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    // -----------------------------
    // Módulo de Mascotas
    // -----------------------------
    Route::get('mascotas', [MascotaController::class, 'index']);      // listar todas las mascotas del usuario
    Route::get('mascotas/{id}', [MascotaController::class, 'show']);  // ver una mascota
    Route::post('mascotas', [MascotaController::class, 'store']);     // crear una mascota
    Route::put('mascotas/{id}', [MascotaController::class, 'update']); // actualizar
    Route::delete('mascotas/{id}', [MascotaController::class, 'destroy']); // eliminar

    // -----------------------------
    // Módulo de Servicios
    // -----------------------------
    Route::get('servicios', [ServicioController::class, 'index']);      // listar servicios
    Route::get('servicios/{id}', [ServicioController::class, 'show']);  // ver un servicio
    Route::post('servicios', [ServicioController::class, 'store']);     // crear servicio (admin)
    Route::put('servicios/{id}', [ServicioController::class, 'update']); // actualizar servicio
    Route::delete('servicios/{id}', [ServicioController::class, 'destroy']); // eliminar servicio

    // -----------------------------
    //Módulo de Citas (Facade)
    // -----------------------------
    Route::get('citas', [AgendaFacadeController::class, 'index']);     // listar citas del usuario
    Route::post('citas', [AgendaFacadeController::class, 'store']);    // crear cita
    Route::put('citas/{id}', [AgendaFacadeController::class, 'update']); // modificar cita
    Route::delete('citas/{id}', [AgendaFacadeController::class, 'destroy']); // cancelar cita
});
