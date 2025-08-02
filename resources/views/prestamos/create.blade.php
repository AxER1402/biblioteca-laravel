@extends('layouts.app')

@section('content')
<h1>Nuevo Préstamo</h1>

<form action="{{ route('prestamos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuario_id" class="form-control" required>
            <option value="">Seleccione un usuario</option>
            @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}">{{ $usuario->nombre }} ({{ ucfirst($usuario->tipo) }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Libro</label>
        <select name="libro_id" class="form-control" required>
            <option value="">Seleccione un libro disponible</option>
            @foreach($libros as $libro)
            <option value="{{ $libro->id }}">{{ $libro->titulo }} - {{ $libro->autor }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Fecha de inicio</label>
        <input type="date" name="fecha_inicio" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Fecha de vencimiento</label>
        <input type="date" name="fecha_vencimiento" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection
