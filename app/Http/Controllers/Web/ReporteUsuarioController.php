<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use App\Models\Categoria;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteUsuarioController extends Controller {
    
    public function crear() {
        $categorias = Categoria::all();
        $zonas = Zona::all();
        return view('usuario.reportes.crear', compact('categorias', 'zonas'));
    }

 

public function guardar(Request $request) {
    // 1. Añadimos 'foto' a la validación obligatoria
    $request->validate([
        'categoria_id' => 'required',
        'titulo'       => 'required|max:100',
        'descripcion'  => 'required',
        'latitud'      => 'required',
        'longitud'     => 'required',
        'foto'         => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
    ], [
        'foto.required' => 'La fotografía es obligatoria para validar el problema.',
        'foto.image'    => 'El archivo debe ser una imagen.',
    ]);

    // 2. Crear el reporte primero
    $reporte = Reporte::create([
        'user_id'      => auth()->id(),
        'categoria_id' => $request->categoria_id,
        'zona_id'      => $request->zona_id,
        'titulo'       => $request->titulo,
        'descripcion'  => $request->descripcion,
        'latitud'      => $request->latitud,
        'longitud'     => $request->longitud,
        'prioridad'    => 'baja',
        'estado'       => 'pendiente',
    ]);

    // 3. Procesar y guardar la foto
    if ($request->hasFile('foto')) {
        $archivo = $request->file('foto');
        $nombreFoto = time() . '_' . $archivo->getClientOriginalName();
        // Guardar en storage/app/public/reportes
        $ruta = $archivo->storeAs('reportes', $nombreFoto, 'public');

        // Guardar la ruta en la base de datos
        \App\Models\ImagenReporte::create([
            'reporte_id' => $reporte->id,
            'ruta'       => '/storage/' . $ruta
        ]);
    }

    return redirect('/dashboard')->with('reporte_exitoso', '¡Tu reporte con foto ha sido enviado!');
}
}