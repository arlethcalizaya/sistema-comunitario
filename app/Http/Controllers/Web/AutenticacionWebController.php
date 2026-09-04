<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AutenticacionWebController extends Controller
{
    // Muestra la página de Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            $usuario = Auth::user();

            if ($usuario->rol === 'administrador') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        return back()->with('error', 'El correo o la contraseña no coinciden.');
    }

    // Muestra la página de Registro
    public function showRegistro()
    {
        return view('auth.registro');
    }

    // Procesa la creación de un nuevo usuario
    public function registro(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'rol' => 'usuario',
            'estado' => 'activo',
        ]);

        Auth::login($usuario);

        return redirect('/dashboard');
    }

    // Cierra la sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}