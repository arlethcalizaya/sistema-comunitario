<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}