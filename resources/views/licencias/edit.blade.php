@extends('layouts.app-master')

@section('content')
<div class="container fade-in-up" style="animation-delay: 0.2s; padding-top: 2rem; padding-bottom: 2rem;">
    <div class="card shadow p-4 zoom-in" style="max-width: 600px; margin: 0 auto; border-radius: 8px; animation-delay: 0.4s;">
        <h1 class="text-center mb-4 slide-down" style="animation-delay: 0.6s;">Editar Licencia</h1>

        <form action="{{ route('licencias.update', $licencia->id) }}" method="POST" class="fade-in" style="animation-delay: 0.8s;">
            @csrf
            @method('PUT')

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1s;">
                <input type="text" name="numero_licencia" id="numero_licencia" class="form-control" value="{{ old('numero_licencia', $licencia->numero_licencia) }}" required>
                <label for="numero_licencia">Número de Licencia</label>
                @error('numero_licencia')
                    <small class="text-danger slide-left" style="animation-delay: 1.2s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1.4s;">
                <input type="date" name="fecha_expedicion" id="fecha_expedicion" class="form-control" value="{{ old('fecha_expedicion', $licencia->fecha_expedicion) }}" required>
                <label for="fecha_expedicion">Fecha de Expedición</label>
                @error('fecha_expedicion')
                    <small class="text-danger slide-left" style="animation-delay: 1.6s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-3 fade-in" style="animation-delay: 1.8s;">
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento', $licencia->fecha_vencimiento) }}" readonly>
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                @error('fecha_vencimiento')
                    <small class="text-danger slide-left" style="animation-delay: 2s;">{{ $message }}</small>
                @enderror
            </div>

            <h5 class="mt-4 slide-left" style="animation-delay: 2.2s;">Categorías</h5>
            @foreach($categorias as $categoria)
                <div class="form-check fade-in" style="animation-delay: {{ 2.4 + ($loop->index * 0.1) }}s;">
                    <input class="form-check-input" type="checkbox" name="categorias[]" id="categoria_{{ $categoria->id }}" value="{{ $categoria->id }}"
                        @if($licencia->categorias->contains($categoria->id)) checked @endif>
                    <label class="form-check-label" for="categoria_{{ $categoria->id }}">{{ $categoria->nombre }} - {{ $categoria->descripcion }}</label>
                </div>
            @endforeach
            @error('categorias')
                <div class="text-danger slide-left" style="animation-delay: {{ 2.4 + (count($categorias) * 0.1) }}s;">{{ $message }}</div>
            @enderror

            <div class="d-flex gap-2 mt-4" style="animation-delay: 2.8s;">
                <button type="submit" class="btn btn-custom-register zoom-in flex-fill" style="animation-delay: 3s;">Actualizar Licencia</button>
                <a href="{{ route('licencias.index') }}" class="btn btn-custom zoom-in flex-fill" style="animation-delay: 3.2s;">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('fecha_expedicion').addEventListener('change', function() {
        let fechaExp = new Date(this.value);
        fechaExp.setFullYear(fechaExp.getFullYear() + 10);
        const y = fechaExp.getFullYear();
        const m = String(fechaExp.getMonth() + 1).padStart(2, '0');
        const d = String(fechaExp.getDate()).padStart(2, '0');
        document.getElementById('fecha_vencimiento').value = `${y}-${m}-${d}`;
    });
</script>
@endsection
