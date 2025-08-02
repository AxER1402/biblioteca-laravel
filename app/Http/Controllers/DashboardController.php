<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\Multa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = Usuario::count();
        $totalLibros = Libro::count();
        $prestamosActivos = Prestamo::whereNull('fecha_devolucion')->count();
        $multasPendientes = Multa::where('pagada', 0)->count();

        return view('dashboard', compact(
            'totalUsuarios',
            'totalLibros',
            'prestamosActivos',
            'multasPendientes'
        ));
    }
}
