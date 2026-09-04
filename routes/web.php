<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\Admin\DashboardController;
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
