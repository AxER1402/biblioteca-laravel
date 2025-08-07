<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::all();
        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        return view('libros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'categoria' => 'required',
            'disponible' => 'required|boolean',
        ]);

        Libro::create($request->all());
        return redirect()->route('libros.index')->with('success', 'Libro creado con éxito.');
    }

    public function edit(Libro $libro)
    {
        return view('libros.edit', compact('libro'));
    }

    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'categoria' => 'required',
            'disponible' => 'required|boolean',
        ]);

        $libro->update($request->all());
        return redirect()->route('libros.index')->with('success', 'Libro actualizado con éxito.');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')->with('success', 'Libro eliminado con éxito.');
    }

    public function buscar(Request $request)
    {
        $titulo = $request->input('titulo');
        $autor = $request->input('autor');
        $categoria = $request->input('categoria');

        $query = Libro::query();

        if ($titulo) {
            $query->where('titulo', 'like', "%{$titulo}%");
        }

        if ($autor) {
            $query->where('autor', 'like', "%{$autor}%");
        }

        if ($categoria) {
            $query->where('categoria', 'like', "%{$categoria}%");
        }

        $libros = $query->get();

        return view('dashboard', compact('libros', 'titulo', 'autor', 'categoria'));
    }
}
