@extends('layouts.app')

@section('content')
<h1>Mi Historial de Préstamos</h1>

@if($prestamos->isEmpty())
    <p>No tienes préstamos registrados.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Libro</th>
            <th>Fecha Inicio</th>
            <th>Fecha Vencimiento</th>
            <th>Fecha Devolución</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prestamos as $prestamo)
        <tr>
            <td>{{ $prestamo->libro->titulo }}</td>
            <td>{{ $prestamo->fecha_inicio }}</td>
            <td>{{ $prestamo->fecha_vencimiento }}</td>
            <td>{{ $prestamo->fecha_devolucion ?? 'No devuelto' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
