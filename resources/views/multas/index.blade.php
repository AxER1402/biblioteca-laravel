@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Multas</h1>
    <a href="{{ route('multas.create') }}" class="btn btn-primary">Nueva Multa</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Monto</th>
            <th>Motivo</th>
            <th>Pagada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($multas as $multa)
        <tr>
            <td>{{ $multa->usuario->nombre }}</td>
            <td>Q{{ number_format($multa->monto, 2) }}</td>
            <td>{{ $multa->motivo }}</td>
            <td>{{ $multa->pagada ? 'Sí' : 'No' }}</td>
            <td>
                <a href="{{ route('multas.edit', $multa) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('multas.destroy', $multa) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar multa?')" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
