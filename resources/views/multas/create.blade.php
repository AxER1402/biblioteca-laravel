@extends('layouts.app')

@section('content')
<h1>Nueva Multa</h1>

<form action="{{ route('multas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuario_id" class="form-control" required>
            <option value="">Seleccione un usuario</option>
            @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Monto</label>
        <input type="number" step="0.01" name="monto" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Motivo</label>
        <textarea name="motivo" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Pagada</label>
        <select name="pagada" class="form-control" required>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('multas.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection
