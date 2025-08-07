@extends('layouts.app')

@section('content')
<h1>Mi Historial de Préstamos</h1>
<hr>

@if($prestamos->isEmpty())
    <div class="alert alert-info">
        No tienes préstamos registrados.
    </div>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Libro</th>
            <th>Fecha Inicio</th>
            <th>Fecha Vencimiento</th>
            <th>Fecha Devolución</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prestamos as $prestamo)
        <tr>
            <td>{{ $prestamo->libro->titulo }}</td>
            <td>{{ $prestamo->fecha_inicio }}</td>
            <td>{{ $prestamo->fecha_vencimiento }}</td>
            <td>{{ $prestamo->fecha_devolucion ?? 'No devuelto' }}</td>
            <td>
                @if($prestamo->fecha_devolucion)
                    <span class="badge bg-success">Devuelto</span>
                @else
                    <span class="badge bg-warning">En préstamo</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
