<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Mostrar la vista del login
    public function index()
    {
        return view('login');
    }

    // Procesar la contraseña
    public function procesarLogin(Request $request)
    {
        // Validar que el campo no venga vacío
        $request->validate([
            'password' => 'required'
        ]);

        // Define aquí tu contraseña maestra temporal
        $contrasenaMaestra = 'bombas123'; 

        if ($request->password === $contrasenaMaestra) {
            // Si es correcta, creamos una variable de sesión
            session(['admin_logeado' => true]);
            
            // Redirigimos al dashboard (asegúrate de que esta ruta coincida con tu panel)
            return redirect('/barratareas');
        }

        // Si es incorrecta, lo regresamos con un error
        return back()->with('error', 'Contraseña incorrecta. Inténtalo de nuevo.');
    }

    // Cerrar sesión
    public function logout()
    {
        session()->forget('admin_logeado');
        return redirect('/login');
    }
}