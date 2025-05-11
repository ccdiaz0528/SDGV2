@extends('layouts.app-master')

@section('content')
<div class="container d-flex justify-content-center align-items-center fade-in-up" style="min-height: 80vh; animation-delay: 0.2s;">
    <div class="card shadow p-4 zoom-in" style="width: 100%; max-width: 400px; border-radius: 8px; animation-delay: 0.4s;">
        <h1 class="slide-down" style="animation-delay: 0.6s;">Editar Vehículo</h1>
        <form action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="form-floating mb-3 fade-in" style="animation-delay: 0.8s;">
                <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca', $vehiculo->marca) }}" readonly>
                <label for="marca">Marca</label>
            </div>

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1s;">
                <input type="text" name="placa" id="placa" class="form-control" value="{{ old('placa', $vehiculo->placa) }}" readonly>
                <label for="placa">Placa</label>
            </div>

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1.2s;">
                <input type="text" name="color" id="color" class="form-control" value="{{ old('color', $vehiculo->color) }}" required>
                <label for="color">Color</label>
                @error('color')
                    <small class="text-danger slide-left" style="animation-delay: 1.4s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1.6s;">
                <input type="text" name="modelo" id="modelo" class="form-control" value="{{ old('modelo', $vehiculo->modelo) }}" readonly>
                <label for="modelo">Modelo</label>
            </div>

            <div class="d-flex gap-2" style="animation-delay: 1.8s;">
                <button type="submit" class="btn btn-custom-register zoom-in flex-fill" style="animation-delay: 2s;">Actualizar Vehículo</button>
                <a href="{{ route('vehiculos.index') }}" class="btn btn-custom zoom-in flex-fill" style="animation-delay: 2.2s;">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
