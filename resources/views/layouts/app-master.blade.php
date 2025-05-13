<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDGV</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <!-- Animate.css (opcional, facilita keyframes) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Tus estilos con variables y animaciones -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<bod y class="fade-in-up">  {{-- Clase global de entrada --}}

    @include('layouts.partials.navbar')  {{-- El navbar ya usa slide-in y zoom-in --}}

    <main class="container my-4">
        @yield('content')
    </main>

    <footer class="footer zoom-in" style="animation-delay: 0.2s;">
        <div class="footer-content text-center py-3">
            <p>© 2025 Sistema de Documentación de Vehículos. Todos los derechos reservados.</p>
            <p>Desarrollado con pasión por Cristian Diaz – Carlos Camacho.</p>
            <a href="mailto:cristiancamilodiaz0528@gmail.com" class="hover-underline">Soporte</a>
        </div>
    </footer>

    <!-- Bootstrap Bundle -->
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- (Opcional) AOS para scroll animations -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      // Inicializar AOS si lo usas
      AOS.init({ duration: 800, once: true });
    </script>
</bod>
</html>
