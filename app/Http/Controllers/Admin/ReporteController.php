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

    public function ver($id) {
        $reporte = Reporte::with(['usuario', 'categoria', 'zona'])->findOrFail($id);
        return view('admin.reportes.ver', compact('reporte'));
    }

    public function actualizarEstado(Request $request, $id) {
        $reporte = Reporte::findOrFail($id);
        $reporte->estado = $request->estado;
        $reporte->save();

        return back()->with('success', 'Estado del reporte actualizado correctamente.');
    }
}