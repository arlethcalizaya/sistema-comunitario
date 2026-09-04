<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use App\Models\User;

class DashboardController extends Controller {
    public function index() {
        $totalReportes = Reporte::count();
        $pendientes = Reporte::where('estado', 'pendiente')->count();
        $resueltos = Reporte::where('estado', 'resuelto')->count();
        $totalUsuarios = User::count();

        return view('admin.dashboard', compact('totalReportes', 'pendientes', 'resueltos', 'totalUsuarios'));
    }
}