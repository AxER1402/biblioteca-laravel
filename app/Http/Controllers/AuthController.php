<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // Buscar usuario con la contraseña sin encriptar
        $usuario = Usuario::where('correo', $credentials['correo'])
            ->where('password', $credentials['password'])
            ->first();

        if ($usuario) {
            Auth::login($usuario);
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'correo' => 'Credenciales incorrectas.',
        ])->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|email|unique:usuarios',
        'password' => 'required|min:6|confirmed',
        'tipo' => 'required|in:alumno,profesor'
    ]);

    $data['password'] = $data['password']; // sin encriptar (como lo tienes)

    Usuario::create($data);

    // En lugar de redirigir, volvemos a la vista con mensaje
    return back()->with('success', 'Usuario creado con éxito.');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

