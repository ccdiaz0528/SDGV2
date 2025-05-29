@extends('layouts.app-master')

@section('title', 'Perfil')

@section('content')
<div class="container py-5 fade-in-up"> {{-- Added py-5 for top/bottom padding --}}
    <div class="row justify-content-center"> {{-- Use Bootstrap grid for layout --}}
        <div class="col-md-6 mb-4"> {{-- Column for Personal Profile --}}
            <div class="card p-4 h-100" style="border-radius: var(--radius); box-shadow: var(--shadow-light); background: #fff;">
                <h2 class="project-title mb-4">Perfil del Cliente</h2>

                @if(session('success_profile'))
                    <div class="alert alert-success" style="border-radius: var(--radius);">
                        {{ session('success_profile') }}
                    </div>
                @endif
                @if(session('error_profile'))
                    <div class="alert alert-danger" style="border-radius: var(--radius);">
                        {{ session('error_profile') }}
                    </div>
                @endif

                <form action="{{ route('perfil.guardar') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="nombre" class="text-muted">Nombre</label>
                        <input type="text" name="nombre" class="form-control" style="padding: 0.6rem 1rem;" value="{{ old('nombre', $cliente->nombre ?? '') }}" required>
                        @error('nombre')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellido" class="text-muted">Apellido</label>
                        <input type="text" name="apellido" class="form-control" style="padding: 0.6rem 1rem;" value="{{ old('apellido', $cliente->apellido ?? '') }}">
                        @error('apellido')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="cedula" class="text-muted">Cédula</label>
                        <input type="text" name="cedula" class="form-control" style="padding: 0.6rem 1rem;" value="{{ old('cedula', $cliente->cedula ?? '') }}" required>
                        @error('cedula')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="telefono" class="text-muted">Teléfono (Opcional)</label>
                        <input type="text" name="telefono" class="form-control" style="padding: 0.6rem 1rem;" value="{{ old('telefono', $cliente->telefono ?? '') }}">
                        @error('telefono')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="direccion" class="text-muted">Dirección (Opcional)</label>
                        <input type="text" name="direccion" class="form-control" style="padding: 0.6rem 1rem;" value="{{ old('direccion', $cliente->direccion ?? '') }}">
                        @error('direccion')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-custom-register w-100">Guardar Cambios</button>
                </form>
            </div>
        </div>

        <div class="col-md-6 mb-4"> {{-- Column for Login Data --}}
            <div class="card p-4 h-100" style="border-radius: var(--radius); box-shadow: var(--shadow-light); background: #fff;">
                <h2 class="project-title mb-4">Actualizar Datos de Acceso</h2>

                @if(session('success_login'))
                    <div class="alert alert-success" style="border-radius: var(--radius);">
                        {{ session('success_login') }}
                    </div>
                @endif
                @if(session('error_login'))
                    <div class="alert alert-danger" style="border-radius: var(--radius);">
                        {{ session('error_login') }}
                    </div>
                @endif

                <form action="{{ route('perfil.actualizar_credenciales') }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Use PUT method for updating resources --}}

                    <div class="form-group mb-3">
                        <label for="username" class="text-muted">Nombre de Usuario</label>
                        <input type="text" name="username" class="form-control" style="padding: 0.6rem 1rem;" value="{{ old('username', auth()->user()->username) }}" required>
                        @error('username')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="text-muted">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" style="padding: 0.6rem 1rem;" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="current_password" class="text-muted">Contraseña Actual (para confirmar cambios)</label>
                        <input type="password" name="current_password" class="form-control" style="padding: 0.6rem 1rem;" required>
                        @error('current_password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="text-muted">Nueva Contraseña (Opcional)</label>
                        <input type="password" name="password" class="form-control" style="padding: 0.6rem 1rem;">
                        <small class="form-text text-muted">Deja en blanco si no quieres cambiar la contraseña.</small>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password_confirmation" class="text-muted">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" style="padding: 0.6rem 1rem;">
                    </div>

                    <button type="submit" class="btn btn-custom-register w-100">Actualizar Credenciales</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
