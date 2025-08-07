@extends('layouts.app')

@section('content')
<h1>📚 Panel Principal</h1>
<hr>

@php
    $userRole = auth()->user()->role ?? null;
@endphp

<div class="row mb-4">
    @if($userRole !== 'alumno' && $userRole !== 'profesor')
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text display-6">{{ isset($totalUsuarios) ? e($totalUsuarios) : '0' }}</p>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-light btn-sm">Ver</a>
                </div>
            </div>
        </div>
    @endif

    <!-- La card de Libros aparece para todos los usuarios autenticados -->
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Libros</h5>
                <p class="card-text display-6">{{ isset($totalLibros) ? e($totalLibros) : '0' }}</p>
                <a href="{{ route('libros.index') }}" class="btn btn-light btn-sm">Ver</a>
            </div>
        </div>
    </div>

    @if($userRole !== 'alumno' && $userRole !== 'profesor')
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Préstamos Activos</h5>
                    <p class="card-text display-6">{{ isset($prestamosActivos) ? e($prestamosActivos) : '0' }}</p>
                    <a href="{{ route('prestamos.index') }}" class="btn btn-light btn-sm">Ver</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Multas Pendientes</h5>
                    <p class="card-text display-6">{{ isset($multasPendientes) ? e($multasPendientes) : '0' }}</p>
                    <a href="{{ route('multas.index') }}" class="btn btn-light btn-sm">Ver</a>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Cards para "Mis Préstamos" y "Mis Multas" visibles para todos los usuarios autenticados -->
<div class="row mb-4 mis-cards-row">
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3 mis-card">
            <div class="card-body">
                <h5 class="card-title">Mis Préstamos</h5>
                <p class="card-text">Consulta tus préstamos activos y pasados.</p>
                <a href="{{ route('prestamos.mis') }}" class="btn btn-light btn-sm">Ver mis préstamos</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-secondary mb-3 mis-card">
            <div class="card-body">
                <h5 class="card-title">Mis Multas</h5>
                <p class="card-text">Revisa tus multas pendientes y pagadas.</p>
                <a href="{{ route('multas.mis') }}" class="btn btn-light btn-sm">Ver mis multas</a>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#buscarLibroModal">Buscar Libro</button>

<div class="modal fade" id="buscarLibroModal" tabindex="-1" aria-labelledby="buscarLibroModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="GET" action="{{ route('dashboard') }}">
        <div class="modal-header">
          <h5 class="modal-title" id="buscarLibroModalLabel">Buscar Libro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="query" class="form-label">Buscar por título, autor o categoría</label>
                <input type="text" class="form-control" id="query" name="query" placeholder="Escribe tu búsqueda...">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Buscar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@if(isset($libros))
    <h3>Resultados de búsqueda:</h3>
    @if($libros->isEmpty())
        <p>No se encontraron libros.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoría</th>
                    <th>Disponible</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($libros as $libro)
                    <tr>
                        <td>{{ e($libro->titulo) }}</td>
                        <td>{{ e($libro->autor) }}</td>
                        <td>{{ e($libro->categoria) }}</td>
                        <td>{{ $libro->disponible ? 'Sí' : 'No' }}</td>
                        <td>
                            @if($libro->disponible)
                                <button 
                                    class="btn btn-sm btn-success btn-reservar" 
                                    data-libro-id="{{ $libro->id }}" 
                                    data-libro-titulo="{{ $libro->titulo }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#reservarModal"
                                >
                                    Reservar
                                </button>
                            @else
                                <button class="btn btn-sm btn-secondary" disabled>No disponible</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endif

<!-- Modal para reservar libro -->
<div class="modal fade" id="reservarModal" tabindex="-1" aria-labelledby="reservarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('prestamos.store') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="reservarModalLabel">Reservar Libro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="libro_id" id="libro_id" value="">

        <div class="mb-3">
          <label for="libro_titulo" class="form-label">Libro</label>
          <input type="text" class="form-control" id="libro_titulo" disabled>
        </div>

        <div class="mb-3">
          <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
          <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required value="{{ date('Y-m-d') }}">
        </div>

        <div class="mb-3">
          <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
          <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento" required value="{{ date('Y-m-d', strtotime('+7 days')) }}">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const reservarModal = document.getElementById('reservarModal');
        reservarModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const libroId = button.getAttribute('data-libro-id');
            const libroTitulo = button.getAttribute('data-libro-titulo');

            document.getElementById('libro_id').value = libroId;
            document.getElementById('libro_titulo').value = libroTitulo;

            // Reiniciar fechas al abrir modal
            const hoy = new Date().toISOString().split('T')[0];
            document.getElementById('fecha_inicio').value = hoy;

            const fechaVenc = new Date();
            fechaVenc.setDate(fechaVenc.getDate() + 7);
            document.getElementById('fecha_vencimiento').value = fechaVenc.toISOString().split('T')[0];
        });
    });
</script>

@endsection
