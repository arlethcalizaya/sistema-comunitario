<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;



class AutenticacionWebController extends Controller {
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            $usuario = Auth::user();

            // REDIRECCIÓN SEGÚN ROL
            if ($usuario->rol === 'administrador') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/dashboard'); // Dashboard de usuario normal
            }
        }

        return back()->with('error', 'El correo o la contraseña no coinciden.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Agrega estas líneas arriba, debajo de las otras "use"

// ... dentro de la clase ...

public function showRegistro() {
    return view('auth.registro');
}

public function registro(Request $request) {
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
        'rol' => 'usuario', // Por defecto todos son usuarios
        'estado' => 'activo',
    ]);

    Auth::login($usuario); // Inicia sesión automáticamente al registrarse

    return redirect('/dashboard');
}
}