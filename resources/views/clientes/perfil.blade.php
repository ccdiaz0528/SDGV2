@extends('layouts.app-master')

@section('title', 'Perfil')

@section('content')
<div class="container d-flex justify-content-center align-items-center fade-in-up" style="min-height: 80vh;">
    <div class="card p-4" style="width: 100%; max-width: 600px; border-radius: var(--radius); box-shadow: var(--shadow-light); background: #fff;">
        <h2 class="project-title">Perfil del Cliente</h2>

        @if(session('success'))
            <div class="alert alert-success" style="border-radius: var(--radius);">
                {{ session('success') }}
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
@endsection
