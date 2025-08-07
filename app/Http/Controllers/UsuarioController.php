<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Importar para encriptar contraseña

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:usuarios',
            'role' => 'required|in:admin,maestro,alumno',
            'password' => 'required|min:6',
        ]);

        $data = $request->only('nombre', 'correo', 'role');
        $data['password'] = Hash::make($request->password);

        Usuario::create($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
{
    $request->validate([
        'nombre' => 'required',
        'correo' => 'required|email|unique:usuarios,correo,'.$usuario->id,
        'role' => 'required|in:admin,maestro,alumno',
        'password' => 'nullable',
    ]);

    $data = $request->only(['nombre', 'correo', 'role']);

    if ($request->filled('password')) {
        $data['password'] = $request->password; // sin hash, tal cual
    }

    $usuario->update($data);

    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
}

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
