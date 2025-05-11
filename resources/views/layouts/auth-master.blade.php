<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDGV</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    {{-- Tus estilos con variables, modo oscuro y animaciones --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>

<body class="fade-in-up light-mode">  {{-- Cambia a dark-mode si quieres forzar --}}

    {{-- Navbar animado --}}
    @include('layouts.partials.navbar')

    {{-- Contenedor principal con animación --}}
    <main class="form-container zoom-in" style="animation-delay:0.3s;">
        @yield('content')
    </main>

    {{-- Footer con entrada suave --}}
    <footer class="footer slide-up" style="animation-delay:0.5s;">
        <div class="footer-content text-center py-3">
            <p>© 2025 Sistema de Documentación de Vehículos. Todos los derechos reservados.</p>
            <p>Desarrollado con pasión por Cristian Díaz – Carlos Camacho.</p>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
