<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use Illuminate\Support\Facades\Auth;

class UsuarioDashboardController extends Controller {
    public function index() {
        $user_id = Auth::id();
        
        // Estadísticas solo de este usuario
        $total = Reporte::where('user_id', $user_id)->count();
        $resueltos = Reporte::where('user_id', $user_id)->where('estado', 'resuelto')->count();
        $pendientes = Reporte::where('user_id', $user_id)->where('estado', 'pendiente')->count();
        
        // Sus últimos 3 reportes
        $ultimosReportes = Reporte::where('user_id', $user_id)->latest()->take(3)->get();

        return view('usuario.dashboard', compact('total', 'resueltos', 'pendientes', 'ultimosReportes'));
    }
}