@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-lg p-4" style="width: 450px;">
        <h3 class="text-center mb-4">Crear Cuenta</h3>

        {{-- Mensaje de éxito si el usuario fue creado --}}
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Juan Pérez" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" placeholder="usuario@correo.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Usuario</label>
                <select name="tipo" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option value="alumno" {{ old('tipo')=='alumno' ? 'selected' : '' }}>Alumno</option>
                    <option value="profesor" {{ old('tipo')=='profesor' ? 'selected' : '' }}>Profesor</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="********" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
            </div>

            <button class="btn btn-success w-100">Registrarse</button>

            <div class="text-center mt-3">
                <a class="letter-custom" href="{{ route('login') }}">Ya tengo cuenta</a>
            </div>
        </form>
    </div>
</div>
@endsection
