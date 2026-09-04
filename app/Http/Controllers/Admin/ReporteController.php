<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller {
    public function index() {
        // Traemos los reportes del más reciente al más antiguo
        $reportes = Reporte::with(['usuario', 'categoria'])->latest()->get();
        return view('admin.reportes.index', compact('reportes'));
    }
}