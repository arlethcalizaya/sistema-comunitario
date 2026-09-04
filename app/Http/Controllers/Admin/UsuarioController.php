<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller {
    public function index() {
        // Traemos todos los usuarios ordenados por fecha
        $usuarios = User::latest()->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function cambiarEstado($id) {
        $usuario = User::findOrFail($id);
        
        // Si está activo lo ponemos inactivo, y viceversa
        $usuario->estado = ($usuario->estado == 'activo') ? 'inactivo' : 'activo';
        $usuario->save();

        return back()->with('success', 'Estado del usuario actualizado correctamente.');
    }
}