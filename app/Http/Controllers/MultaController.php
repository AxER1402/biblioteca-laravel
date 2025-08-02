<?php

namespace App\Http\Controllers;

use App\Models\Multa;
use App\Models\Usuario;
use Illuminate\Http\Request;

class MultaController extends Controller
{
    public function index()
{
    $hoy = now()->toDateString();

    // Buscar préstamos vencidos sin devolución
    $prestamos_vencidos = \App\Models\Prestamo::with('libro')
        ->whereNull('fecha_devolucion')
        ->where('fecha_vencimiento', '<', $hoy)
        ->get();

    foreach ($prestamos_vencidos as $prestamo) {
        // Verificar si ya tiene multa generada para ese préstamo
        $existe_multa = Multa::where('usuario_id', $prestamo->usuario_id)
            ->where('motivo', 'LIKE', "%Préstamo vencido: {$prestamo->libro->titulo}%")
            ->exists(); // ✅ Ahora busca aunque ya esté pagada

        if (!$existe_multa) {
            // Crear multa automática
            Multa::create([
                'usuario_id' => $prestamo->usuario_id,
                'monto' => 10.00,
                'motivo' => 'Préstamo vencido: ' . $prestamo->libro->titulo,
                'pagada' => 0
            ]);
        }
    }

    // Mostrar todas las multas
    $multas = Multa::with('usuario')->get();
    return view('multas.index', compact('multas'));
}


    public function create()
    {
        $usuarios = Usuario::all();
        return view('multas.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'monto' => 'required|numeric|min:0',
            'motivo' => 'required',
            'pagada' => 'required|boolean'
        ]);

        Multa::create($request->all());
        return redirect()->route('multas.index')->with('success', 'Multa registrada con éxito.');
    }

    public function edit(Multa $multa)
    {
        $usuarios = Usuario::all();
        return view('multas.edit', compact('multa', 'usuarios'));
    }

    public function update(Request $request, Multa $multa)
{
    $request->validate([
        'usuario_id' => 'required|exists:usuarios,id',
        'monto' => 'required|numeric|min:0',
        'motivo' => 'required',
        'pagada' => 'required|boolean'
    ]);

    // Actualizar la multa existente
    $multa->update($request->all());

    return redirect()->route('multas.index')->with('success', 'Multa actualizada con éxito.');
}

    public function destroy(Multa $multa)
    {
        $multa->delete();
        return redirect()->route('multas.index')->with('success', 'Multa eliminada con éxito.');
    }
}
