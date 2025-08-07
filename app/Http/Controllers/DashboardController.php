<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\Multa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalUsuarios = Usuario::count();
        $totalLibros = Libro::count();
        $prestamosActivos = Prestamo::whereNull('fecha_devolucion')->count();
        $multasPendientes = Multa::where('pagada', 0)->count();

        // Para buscar libros (opcional, si tienes formulario de búsqueda en dashboard)
        $query = $request->input('query');
        $libros = null;

        if ($query) {
            $libros = Libro::where('titulo', 'like', "%$query%")
                ->orWhere('autor', 'like', "%$query%")
                ->orWhere('categoria', 'like', "%$query%")
                ->get();
        }

        return view('dashboard', compact(
            'totalUsuarios',
            'totalLibros',
            'prestamosActivos',
            'multasPendientes',
            'libros',
            'query'
        ));
    }
}
