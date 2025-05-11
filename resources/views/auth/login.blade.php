@extends('layouts.app-master')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 8px;">

        <h2 class="text-center mb-4">Inicia Sesión</h2>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <!-- Usuario -->
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" placeholder="Usuario o Correo" id="inputUsername" value="{{ old('username') }}" required>
                <label for="inputUsername">Usuario o Correo</label>
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-floating mb-3 position-relative">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" id="inputPassword" required>
                <label for="inputPassword">Contraseña</label>

                <!-- Botón de ver contraseña -->
                <button type="button" id="togglePassword" class="btn btn-sm btn-outline-secondary position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); z-index: 10;">
                    <i class="fa fa-eye"></i>
                </button>

                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enlaces -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="/register">Crear tu cuenta</a>
                @if (Route::has('password.request'))
                    <a class="text-sm text-decoration-none" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Botón principal -->
            <button type="submit" class="btn btn-custom w-100 transition-hover">Iniciar Sesión</button>
        </form>
    </div>
</div>

<!-- Estilos -->
<style>
    .transition-hover {
        transition: all 0.3s ease-in-out;
    }

    .transition-hover:hover {
        transform: scale(1.03);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Modo oscuro opcional */
    body.dark-mode .card {
        background-color: #1f1f1f;
        color: #f1f1f1;
    }

    body.dark-mode .form-control {
        background-color: #2a2a2a;
        color: #fff;
        border-color: #444;
    }

    body.dark-mode .form-floating label {
        color: #ccc;
    }
</style>

<!-- Script -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('inputPassword');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endsection
