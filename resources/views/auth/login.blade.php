@extends('layouts.app-master')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">

    <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 8px;">


        <h1 class="text-center mb-4">Inicia Sesión</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" placeholder="Usuario o Correo" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('username') }}">
                <label for="exampleInputEmail1" class="form-label">Usuario o Correo</label>
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Campo de contraseña con toggle para visualizar -->
            <div class="mb-3 position-relative">
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" id="exampleInputPassword1">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                </div>
                <button type="button" id="togglePassword" class="btn btn-outline-secondary position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                    <i class="fa fa-eye"></i>
                </button>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <a href="/register">Crear tu cuenta</a>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <br>
            <button type="submit" class="btn btn-custom me-2 w-100">Iniciar Sesión</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('exampleInputPassword1');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            this.innerHTML = '<i class="fa fa-eye"></i>';
        }
    });
</script>

@endsection
