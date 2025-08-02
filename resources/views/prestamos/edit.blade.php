@extends('layouts.app')

@section('content')
<h1>Editar Préstamo</h1>

<form action="{{ route('prestamos.update', $prestamo) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuario_id" class="form-control" required>
            @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ $prestamo->usuario_id == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }} ({{ ucfirst($usuario->tipo) }})
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Libro</label>
        <select name="libro_id" class="form-control" required>
            @foreach($libros as $libro)
            <option value="{{ $libro->id }}" {{ $prestamo->libro_id == $libro->id ? 'selected' : '' }}>
                {{ $libro->titulo }} - {{ $libro->autor }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Fecha de inicio</label>
        <input type="date" name="fecha_inicio" class="form-control" value="{{ $prestamo->fecha_inicio }}" required>
    </div>

    <div class="mb-3">
        <label>Fecha de vencimiento</label>
        <input type="date" name="fecha_vencimiento" class="form-control" value="{{ $prestamo->fecha_vencimiento }}" required>
    </div>

    <div class="mb-3">
        <label>Fecha de devolución</label>
        <input type="date" name="fecha_devolucion" class="form-control" value="{{ $prestamo->fecha_devolucion }}">
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection
