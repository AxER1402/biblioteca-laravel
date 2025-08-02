@extends('layouts.app')

@section('content')
<h1>Editar Libro</h1>

<form action="{{ route('libros.update', $libro) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" value="{{ $libro->titulo }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <input type="text" name="autor" value="{{ $libro->autor }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Disponible</label>
        <select name="disponible" class="form-control">
            <option value="1" {{ $libro->disponible ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ !$libro->disponible ? 'selected' : '' }}>No</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{ route('libros.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection
