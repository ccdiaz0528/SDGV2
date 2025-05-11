@extends('layouts.app-master')

@section('content')
<div class="container d-flex justify-content-center align-items-center fade-in-up" style="min-height: 80vh; animation-delay: 0.2s;">
    <div class="card shadow p-4 zoom-in" style="width: 100%; max-width: 600px; border-radius: 8px; animation-delay: 0.4s;">
        <h1 class="text-center mb-4 slide-down" style="animation-delay: 0.6s;">Registrar Licencia</h1>

        <form action="{{ route('licencias.store') }}" method="POST">
            @csrf

            <div class="mb-3 form-floating fade-in" style="animation-delay: 0.8s;">
                <input type="text" name="numero_licencia" id="numero_licencia" class="form-control" placeholder="Número de Licencia" required>
                <label for="numero_licencia">Número de Licencia</label>
                @error('numero_licencia')
                    <div class="text-danger slide-left" style="animation-delay: 1s;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-floating fade-in" style="animation-delay: 1.2s;">
                <input type="date" name="fecha_expedicion" id="fecha_expedicion" class="form-control" placeholder="Fecha de Expedición" required>
                <label for="fecha_expedicion">Fecha de Expedición</label>
                @error('fecha_expedicion')
                    <div class="text-danger slide-left" style="animation-delay: 1.4s;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-floating fade-in" style="animation-delay: 1.6s;">
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" placeholder="Fecha de Vencimiento" required readonly>
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                @error('fecha_vencimiento')
                    <div class="text-danger slide-left" style="animation-delay: 1.8s;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 fade-in" style="animation-delay: 2s;">
                <label class="form-label slide-left" style="animation-delay: 2.1s;">Categorías de Licencia</label>
                @foreach($categorias as $categoria)
                    <div class="form-check fade-in" style="animation-delay: {{ 2.2 + ($loop->index * 0.1) }}s;">
                        <input class="form-check-input" type="checkbox" name="categorias[]" value="{{ $categoria->id }}" id="categoria_{{ $categoria->id }}">
                        <label class="form-check-label" for="categoria_{{ $categoria->id }}">{{ $categoria->nombre }} - {{ $categoria->descripcion }}</label>
                    </div>
                @endforeach
                @error('categorias')
                    <div class="text-danger slide-left" style="animation-delay: 2.6s;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom-register zoom-in w-100 mt-4" style="animation-delay: 2.8s;">Registrar Licencia</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('fecha_expedicion').addEventListener('change', function() {
        let fechaExpedicion = new Date(this.value);
        fechaExpedicion.setFullYear(fechaExpedicion.getFullYear() + 10);
        const year = fechaExpedicion.getFullYear();
        const month = String(fechaExpedicion.getMonth() + 1).padStart(2, '0');
        const day = String(fechaExpedicion.getDate()).padStart(2, '0');
        document.getElementById('fecha_vencimiento').value = `${year}-${month}-${day}`;
    });
</script>
@endsection
