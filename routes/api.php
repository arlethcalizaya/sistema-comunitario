<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\Api\AutenticacionController;


Route::post('/registro', [AutenticacionController::class, 'registro']);
Route::post('/login', [AutenticacionController::class, 'login']);



use App\Http\Controllers\Api\ReporteController;

// Estas rutas solo funcionan si el usuario envía su TOKEN
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/reportes', [ReporteController::class, 'crear']);
    Route::get('/mis-reportes', [ReporteController::class, 'misReportes']);
    Route::get('/reportes', [ReporteController::class, 'listarTodos']);
});


Route::get('/mapa/reportes', [ReporteController::class, 'paraMapa']);