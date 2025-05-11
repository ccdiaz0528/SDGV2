@extends('layouts.app-master')

@section('content')
<div class="container d-flex justify-content-center align-items-center fade-in-up" style="min-height: 80vh; animation-delay: 0.2s;">
    <div class="card shadow p-4 zoom-in" style="width: 100%; max-width: 400px; border-radius: 8px; animation-delay: 0.4s;">
        <h1 class="slide-down" style="animation-delay: 0.6s;">Registrar Vehículo</h1>
        <form action="{{ route('vehiculos.store') }}" method="POST" class="mt-3">

            @csrf

            <div class="form-floating mb-3 fade-in" style="animation-delay: 0.8s;">
                <input type="text" name="marca" required placeholder="Marca" class="form-control" value="{{ old('marca') }}">
                <label for="marca">Marca</label>
                @error('marca')
                    <small class="text-danger slide-left" style="animation-delay: 1s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1s;">
                <input type="text" name="placa" required placeholder="Placa" class="form-control" oninput="this.value = this.value.toUpperCase()" value="{{ old('placa') }}">
                <label for="placa">Placa</label>
                @error('placa')
                    <small class="text-danger slide-left" style="animation-delay: 1.2s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1.2s;">
                <input type="text" name="color" required placeholder="Color" class="form-control" value="{{ old('color') }}">
                <label for="color">Color</label>
                @error('color')
                    <small class="text-danger slide-left" style="animation-delay: 1.4s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1.4s;">
                <input type="text" name="modelo" required placeholder="Modelo" class="form-control" value="{{ old('modelo') }}">
                <label for="modelo">Modelo</label>
                @error('modelo')
                    <small class="text-danger slide-left" style="animation-delay: 1.6s;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom-register zoom-in mt-3 w-100" style="animation-delay: 1.8s;">Registrar Vehículo</button>
        </form>
    </div>
</div>
@endsection
