<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\AgendaFacadeController;
use App\Http\Controllers\UserController;

// ---------- PÁGINAS PÚBLICAS ----------
Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');

// ---------- LOGIN / REGISTRO POST ----------
Route::post('/login', [AuthController::class, 'loginWeb'])->name('auth.login.post');
Route::post('/register', [AuthController::class, 'registerWeb'])->name('auth.register.post');

// ---------- RUTAS PROTEGIDAS POR JWT WEB ----------
Route::middleware('jwt.web')->group(function () {

    Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('auth.logout');

    // Rutas de usuario
    Route::prefix('user')->group(function () {
        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.edit-profile');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.update-profile');
        Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('user.change-password');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change-password');
        Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
        Route::put('/settings', [UserController::class, 'updateSettings'])->name('user.update-settings');
    });

    // Mascotas
    Route::get('/mascotas', [MascotaController::class, 'indexWeb'])->name('mascotas.index');
    Route::get('/mascotas/create', [MascotaController::class, 'create'])->name('mascotas.create');
    Route::post('/mascotas', [MascotaController::class, 'storeWeb'])->name('mascotas.store');
    Route::get('/mascotas/{id}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit');
    Route::put('/mascotas/{id}', [MascotaController::class, 'updateWeb'])->name('mascotas.update');
    Route::delete('/mascotas/{id}', [MascotaController::class, 'destroyWeb'])->name('mascotas.destroy');

    // Servicios
    Route::get('/servicios', [ServicioController::class, 'indexWeb'])->name('servicios.index');
    Route::get('/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
    Route::post('/servicios', [ServicioController::class, 'storeWeb'])->name('servicios.store');
    Route::get('/servicios/{id}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
    Route::put('/servicios/{id}', [ServicioController::class, 'updateWeb'])->name('servicios.update');
    Route::delete('/servicios/{id}', [ServicioController::class, 'destroyWeb'])->name('servicios.destroy');

    // Citas - RUTA EDIT AGREGADA
    Route::get('/citas', [AgendaFacadeController::class, 'indexWeb'])->name('citas.index');
    Route::get('/citas/create', [AgendaFacadeController::class, 'createWeb'])->name('citas.create');
    Route::post('/citas', [AgendaFacadeController::class, 'storeWeb'])->name('citas.store');
    Route::get('/citas/{id}/edit', [AgendaFacadeController::class, 'editWeb'])->name('citas.edit');
    Route::put('/citas/{id}', [AgendaFacadeController::class, 'updateWeb'])->name('citas.update');
    Route::delete('/citas/{id}', [AgendaFacadeController::class, 'destroyWeb'])->name('citas.destroy');
});
