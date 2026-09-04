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