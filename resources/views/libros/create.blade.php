@extends('layouts.app')

@section('content')
<h1>Nuevo Libro</h1>

<form action="{{ route('libros.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <input type="text" name="autor" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Disponible</label>
        <select name="disponible" class="form-control">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('libros.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection
