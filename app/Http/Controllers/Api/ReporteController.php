<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller {
    public function crear(Request $request) {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'latitud' => 'required',
            'longitud' => 'required',
        ]);

        $reporte = Reporte::create([
            'user_id' => auth()->id(), // El ID sale automáticamente de la "llave" (token)
            'categoria_id' => $request->categoria_id,
            'zona_id' => $request->zona_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'direccion' => $request->direccion,
            'prioridad' => 'baja',
            'estado' => 'pendiente',
        ]);

        return response()->json([
            'mensaje' => 'Reporte creado con éxito',
            'reporte' => $reporte
        ], 201);
    }

    public function listarTodos() {
        // Trae todos los reportes con la info de quién lo hizo y su categoría
        return Reporte::with(['usuario', 'categoria'])->get();
    }

    public function misReportes() {
        // Solo los reportes del usuario que tiene la sesión iniciada
        return Reporte::where('user_id', auth()->id())->get();
    }
}