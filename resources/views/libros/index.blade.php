@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Libros</h1>
    <a href="{{ route('libros.create') }}" class="btn btn-primary">Nuevo Libro</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($libros as $libro)
        <tr>
            <td>{{ $libro->titulo }}</td>
            <td>{{ $libro->autor }}</td>
            <td>{{ $libro->disponible ? 'Sí' : 'No' }}</td>
            <td>
                <a href="{{ route('libros.edit', $libro) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('libros.destroy', $libro) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar libro?')" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
