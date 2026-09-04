<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\Admin\DashboardController;
Route::get('/admin/dashboard', [DashboardController::class, 'index']);

use App\Http\Controllers\Admin\ReporteController as AdminReporte;
Route::get('/admin/reportes', [AdminReporte::class, 'index']);
Route::get('/admin/reportes/{id}', [AdminReporte::class, 'ver']);
Route::post('/admin/reportes/{id}/estado', [AdminReporte::class, 'actualizarEstado']);


use App\Http\Controllers\Admin\UsuarioController;
Route::get('/admin/usuarios', [UsuarioController::class, 'index']);
Route::post('/admin/usuarios/{id}/estado', [UsuarioController::class, 'cambiarEstado']);


use App\Http\Controllers\Web\AutenticacionWebController;
// Rutas públicas
Route::get('/login', [AutenticacionWebController::class, 'showLogin'])->name('login');
Route::post('/login', [AutenticacionWebController::class, 'login']);
Route::get('/logout', [AutenticacionWebController::class, 'logout']);

// Dashboard para el usuario normal (vacio por ahora)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return "Bienvenido Vecino: " . auth()->user()->name;
    });
});


Route::middleware(['auth', \App\Http\Middleware\EsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/reportes', [AdminReporte::class, 'index']);
    Route::get('/reportes/{id}', [AdminReporte::class, 'ver']);
    Route::post('/reportes/{id}/estado', [AdminReporte::class, 'actualizarEstado']);
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::post('/usuarios/{id}/estado', [UsuarioController::class, 'cambiarEstado']);
});



