<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AutenticacionController extends Controller {
    public function registro(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'usuario',
        ]);

        return response()->json([
            'mensaje' => 'Usuario registrado con éxito',
            'token' => $usuario->createToken('token_auth')->plainTextToken,
            'usuario' => $usuario
        ], 201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = User::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return response()->json(['mensaje' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'mensaje' => 'Inicio de sesión exitoso',
            'token' => $usuario->createToken('token_auth')->plainTextToken,
            'usuario' => $usuario
        ]);
    }
}