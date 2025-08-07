<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Biblioteca</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
</head>
<body class="bg-light color-body-custom">

@if(Auth::check())
    <!-- Barra de navegación visible solo si está autenticado -->
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Biblioteca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    {{-- Solo Admin puede gestionar usuarios --}}
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">Usuarios</a>
                        </li>
                    @endif

                    {{-- Todos pueden ver libros --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('libros.*') ? 'active' : '' }}" href="{{ route('libros.index') }}">Libros</a>
                    </li>

                    {{-- Mostrar préstamos y multas según rol --}}
                    @if(in_array(auth()->user()->role, ['admin', 'maestro', 'alumno']))
                        <li class="nav-item">
                            @if(auth()->user()->role === 'alumno')
                                <a class="nav-link {{ request()->routeIs('prestamos.mis') ? 'active' : '' }}" href="{{ route('prestamos.mis') }}">Mi Historial</a>
                            @else
                                <a class="nav-link {{ request()->routeIs('prestamos.index') ? 'active' : '' }}" href="{{ route('prestamos.index') }}">Préstamos</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if(auth()->user()->role === 'alumno')
                                <a class="nav-link {{ request()->routeIs('multas.mis') ? 'active' : '' }}" href="{{ route('multas.mis') }}">Mis Multas</a>
                            @else
                                <a class="nav-link {{ request()->routeIs('multas.index') ? 'active' : '' }}" href="{{ route('multas.index') }}">Multas</a>
                            @endif
                        </li>
                    @endif

                    {{-- Botón de cierre de sesión --}}
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm ms-3">Cerrar Sesión</button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
@endif

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Evitar volver atrás en el navegador
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
        window.history.pushState(null, "", window.location.href);
    };
</script>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

</body>
</html>
