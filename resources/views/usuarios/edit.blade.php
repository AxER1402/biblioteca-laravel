@extends('layouts.app')

@section('content')
<h1>Editar Usuario</h1>

<form action="{{ route('usuarios.update', $usuario) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $usuario->nombre }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Correo</label>
        <input type="email" name="correo" value="{{ $usuario->correo }}" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Contraseña (dejar vacío para no cambiarla)</label>
    <input type="password" name="password" class="form-control" autocomplete="new-password">
</div>
    <div class="mb-3">
        <label>Rol</label>
        <select name="role" class="form-control" required>
            <option value="alumno" {{ $usuario->role == 'alumno' ? 'selected' : '' }}>Alumno</option>
            <option value="maestro" {{ $usuario->role == 'maestro' ? 'selected' : '' }}>Maestro</option>
            <option value="admin" {{ $usuario->role == 'admin' ? 'selected' : '' }}>Administrador</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection
