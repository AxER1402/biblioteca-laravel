@extends('layouts.app')

@section('content')
<h1>Editar Multa</h1>

<form action="{{ route('multas.update', $multa) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuario_id" class="form-control" required>
            @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ $multa->usuario_id == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Monto</label>
        <input type="number" step="0.01" name="monto" class="form-control" value="{{ $multa->monto }}" required>
    </div>

    <div class="mb-3">
        <label>Motivo</label>
        <textarea name="motivo" class="form-control" required>{{ $multa->motivo }}</textarea>
    </div>

    <div class="mb-3">
        <label>Pagada</label>
        <select name="pagada" class="form-control" required>
            <option value="1" {{ $multa->pagada ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ !$multa->pagada ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{ route('multas.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection
