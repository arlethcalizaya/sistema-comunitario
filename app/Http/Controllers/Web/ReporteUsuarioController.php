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
    // 1. Reglas de validación
    $reglas = [
        'categoria_id' => 'required',
        'titulo'       => 'required|max:100',
        'descripcion'  => 'required',
        'latitud'      => 'required',
        'longitud'     => 'required',
    ];

    // 2. Mensajes en ESPAÑOL
    $mensajes = [
        'categoria_id.required' => 'Debes seleccionar una categoría.',
        'titulo.required'       => 'El título es obligatorio.',
        'titulo.max'            => 'El título no puede tener más de 100 caracteres.',
        'descripcion.required'  => 'La descripción del problema es necesaria.',
        'latitud.required'      => 'Por favor, selecciona la ubicación en el mapa.',
        'longitud.required'     => 'Por favor, selecciona la ubicación en el mapa.',
    ];

    // 3. Ejecutar validación con los mensajes en español
    $request->validate($reglas, $mensajes);

    // 4. Si pasa, guardamos
    Reporte::create([
        'user_id'      => auth()->id(),
        'categoria_id' => $request->categoria_id,
        'zona_id'      => $request->zona_id,
        'titulo'       => $request->titulo,
        'descripcion'  => $request->descripcion,
        'latitud'      => $request->latitud,
        'longitud'     => $request->longitud,
        'direccion'    => $request->direccion,
        'prioridad'    => 'baja',
        'estado'       => 'pendiente',
    ]);

    return redirect('/dashboard')->with('reporte_exitoso', '¡Tu reporte ha sido enviado!');
}
}