    @extends('layouts.app')

    @section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Préstamos</h1>
        <a href="{{ route('prestamos.create') }}" class="btn btn-primary">Nuevo Préstamo</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Libro</th>
                <th>Fecha Inicio</th>
                <th>Fecha Vencimiento</th>
                <th>Fecha Devolución</th>
                <th>Estado Multa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestamos as $prestamo)
            <tr>
                <td>{{ $prestamo->usuario->nombre }}</td>
                <td>{{ $prestamo->libro->titulo }}</td>
                <td>{{ $prestamo->fecha_inicio }}</td>
                <td>{{ $prestamo->fecha_vencimiento }}</td>
                <td>{{ $prestamo->fecha_devolucion ?? 'No devuelto' }}</td>
                <td>
                    @if($prestamo->tiene_multa_pendiente)
                        <span class="badge bg-danger">Multa pendiente</span>
                    @else
                        <span class="badge bg-success">Sin multas</span>
                    @endif
                </td>
                <td>
                    @if($prestamo->tiene_multa_pendiente)
                        <button class="btn btn-secondary btn-sm" disabled>Editar</button>
                    @else
                        <a href="{{ route('prestamos.edit', $prestamo) }}" class="btn btn-warning btn-sm">Editar</a>
                    @endif

                    <form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Eliminar préstamo?')" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
