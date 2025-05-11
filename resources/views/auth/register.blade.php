@extends('layouts.app-master')

@section('title', 'Registro')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 fade-in-up" style="width: 100%; max-width: 600px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-light);">
        <h2 class="text-center mb-4">Registro de Usuario</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Información de Usuario -->
            <div class="mb-4">
                <h5 class="section-subtitle text-center mb-3">Información de Usuario</h5>
                <div class="row">
                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Nombre de Usuario" value="{{ old('username') }}" required>
                        <label for="username">Nombre de Usuario</label>
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-floating mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" value="{{ old('email') }}" required>
                        <label for="email">Correo Electrónico</label>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-floating mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <label for="password">Contraseña</label>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-floating mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required>
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Información del Cliente -->
            <div class="mb-4">
                <h5 class="section-subtitle text-center mb-3">Información del Cliente</h5>
                <div class="row">
                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
                        <label for="nombre">Nombre</label>
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" name="apellido" class="form-control" placeholder="Apellido" value="{{ old('apellido') }}">
                        <label for="apellido">Apellido</label>
                        @error('apellido')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" name="cedula" class="form-control" placeholder="Cédula" value="{{ old('cedula') }}">
                        <label for="cedula">Cédula</label>
                        @error('cedula')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" name="telefono" class="form-control" placeholder="Teléfono (Opcional)" value="{{ old('telefono') }}">
                        <label for="telefono">Teléfono (Opcional)</label>
                        @error('telefono')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" name="direccion" class="form-control" placeholder="Dirección (Opcional)" value="{{ old('direccion') }}">
                        <label for="direccion">Dirección (Opcional)</label>
                        @error('direccion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="gallery-button">Registrar</button>
        </form>
    </div>
</div>
@endsection
