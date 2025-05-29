<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\AdminController;

// Ruta pública
Route::get('/', function () {
    return view('home/index');
});

// Página de inicio general (puede mostrar algo según el rol)
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// ✅ Perfil accesible con solo estar autenticado (sin verificar el correo)
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.guardar');
    // In routes/web.php
Route::post('/perfil', [PerfilController::class, 'guardar'])->name('perfil.guardar');
Route::put('/perfil/credenciales', [PerfilController::class, 'actualizarCredenciales'])->name('perfil.actualizar_credenciales');
});

// ✅ Rutas que requieren autenticación Y verificación de correo
Route::middleware(['auth', 'verified'])->group(function () {

    // 👤 Rutas exclusivas para usuarios normales (level = 0)
    Route::middleware(['user'])->group(function () {
        // Vehículos
        Route::resource('vehiculos', VehiculoController::class);
        Route::get('/vehiculos/{id}/generar-duplicado', [VehiculoController::class, 'generarDuplicado'])->name('vehiculos.generarDuplicado');

        // Documentación
        Route::resource('documentacion', DocumentacionController::class);
        Route::get('documentacion/create/{vehiculo}', [DocumentacionController::class, 'create'])->name('documentacion.create');
        Route::get('/documentacion/{id}/edit', [DocumentacionController::class, 'edit'])->name('documento.edit');
        Route::put('/documentacion/{id}', [DocumentacionController::class, 'update'])->name('documento.update');
        Route::delete('/documentacion/{id}', [DocumentacionController::class, 'destroy'])->name('documentacion.destroy');

        // Licencias
        Route::resource('licencias', LicenciaController::class);
        Route::put('licencias/{id}', [LicenciaController::class, 'update'])->name('licencias.update');
        Route::get('/licencias/{id}/generar-duplicado', [LicenciaController::class, 'generarDuplicado'])->name('licencias.generarDuplicado');
        Route::get('/licencias', [LicenciaController::class, 'index'])->name('licencias.index');
    });

    // 🛡️ Rutas exclusivas para administradores (level = 10)
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Dashboard accesible para ambos (user y admin) si están verificados
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ✅ Logout (accesible si está autenticado y verificado)
Route::get('/logout', [LogoutController::class, 'logout'])->middleware(['auth']);

require __DIR__.'/auth.php';
