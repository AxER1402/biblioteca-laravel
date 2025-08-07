<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Usuario;
use App\Models\Libro;
use App\Models\Multa;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function index()
{
    $prestamos = Prestamo::with(['usuario', 'libro'])->get();

    foreach ($prestamos as $prestamo) {
        $prestamo->tiene_multa_pendiente = Multa::where('usuario_id', $prestamo->usuario_id)
            ->where('pagada', 0)
            ->exists();
    }

    return view('prestamos.index', compact('prestamos'));
}

    public function create()
    {
        $usuarios = Usuario::all();
        $libros = Libro::where('disponible', 1)->get();
        return view('prestamos.create', compact('usuarios', 'libros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'fecha_inicio' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        Prestamo::create([
            'usuario_id' => auth()->id(), // usuario autenticado
            'libro_id' => $request->libro_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_vencimiento' => $request->fecha_vencimiento,
        ]);

        $libro = Libro::find($request->libro_id);
        $libro->disponible = 0;
        $libro->save();

        return redirect()->route('dashboard')->with('success', 'Reserva realizada con éxito.');
    }

    public function edit(Prestamo $prestamo)
{
    $multaPendiente = Multa::where('usuario_id', $prestamo->usuario_id)
        ->where('pagada', 0) // importante: comparar con 0
        ->exists();

    if ($multaPendiente) {
        return redirect()->route('prestamos.index')
            ->withErrors(['error' => 'No puede editar este préstamo hasta que se pague la multa pendiente.']);
    }

    $usuarios = Usuario::all();
    $libros = Libro::all();
    return view('prestamos.edit', compact('prestamo', 'usuarios', 'libros'));
}

    public function update(Request $request, Prestamo $prestamo)
{
    $multaPendiente = Multa::where('usuario_id', $prestamo->usuario_id)
        ->where('pagada', 0) // importante: comparar con 0
        ->exists();

    if ($multaPendiente) {
        return redirect()->route('prestamos.index')
            ->withErrors(['error' => 'No puede modificar este préstamo hasta que se pague la multa pendiente.']);
    }

    $request->validate([
        'usuario_id' => 'required|exists:usuarios,id',
        'libro_id' => 'required|exists:libros,id',
        'fecha_inicio' => 'required|date',
        'fecha_vencimiento' => 'required|date|after_or_equal:fecha_inicio',
        'fecha_devolucion' => 'nullable|date'
    ]);

    $prestamo->update($request->all());

    if ($request->fecha_devolucion) {
        $libro = Libro::find($request->libro_id);
        $libro->disponible = 1;
        $libro->save();
    }

    return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado con éxito.');
}

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado con éxito.');
    }
    public function misPrestamos()
{
    
    $usuarioId = auth()->id();

    // Traer todos los préstamos del usuario con su libro relacionado
    $prestamos = Prestamo::with('libro')
        ->where('usuario_id', $usuarioId)
        ->orderBy('fecha_inicio', 'desc')
        ->get();

    return view('prestamos.mis_prestamos', compact('prestamos'));
}

}
