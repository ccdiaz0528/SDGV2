<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home/index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.guardar');

// Rutas de vehículos
Route::resource('vehiculos', VehiculoController::class)->middleware('auth');
Route::get('/vehiculos/{id}/edit', [VehiculoController::class, 'edit'])->name('vehiculos.edit');
Route::put('/vehiculos/{id}', [VehiculoController::class, 'update'])->name('vehiculos.update');
Route::get('/vehiculos/{id}/generar-duplicado', [VehiculoController::class, 'generarDuplicado'])->name('vehiculos.generarDuplicado');

// Rutas de documentación
Route::resource('documentacion', DocumentacionController::class);
Route::get('documentacion/create/{vehiculo}', [DocumentacionController::class, 'create'])->name('documentacion.create');
Route::get('/documentacion/{id}/edit', [DocumentacionController::class, 'edit'])->name('documento.edit');
Route::put('/documentacion/{id}', [DocumentacionController::class, 'update'])->name('documento.update');
Route::delete('/documentacion/{id}', [DocumentacionController::class, 'destroy'])->name('documentacion.destroy');

// Rutas de licencias
Route::resource('licencias', LicenciaController::class);
Route::put('licencias/{id}', [LicenciaController::class, 'update'])->name('licencias.update');
Route::get('/licencias/{id}/generar-duplicado', [LicenciaController::class, 'generarDuplicado'])->name('licencias.generarDuplicado');

// Rutas de administración
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/licencias', [LicenciaController::class, 'index'])->name('licencias.index');
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
});


Route::get('/logout', [LogoutController::class, 'logout']);


require __DIR__.'/auth.php';
