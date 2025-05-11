@extends('layouts.app-master') <!-- Asegúrate que coincide con tu layout -->

@section('content')
<div class="container d-flex justify-content-center align-items-center fade-in-up" style="min-height: 80vh; animation-delay:0.2s;">
    <div class="card shadow p-4 zoom-in" style="width:100%;max-width:500px;border-radius:8px;animation-delay:0.4s;">
        <h1 class="slide-down text-center mb-4" style="animation-delay:0.6s;">Diligenciar Documentación</h1>
        <p class="text-center small text-muted mb-4 zoom-in" style="animation-delay:0.8s;">Vehículo: {{ $vehiculo->marca }} {{ $vehiculo->placa }}</p>

        <form action="{{ route('documentacion.store') }}" method="POST" class="fade-in" style="animation-delay:1s;">
            @csrf
            <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">

            <div class="mb-3 form-floating fade-in" style="animation-delay:1.2s;">
                <select name="tipo_documento_id" class="form-select" id="tipo_documento_id" required>
                    <option value="" disabled selected>Selecciona tipo de documento</option>
                    @foreach($tiposDocumentos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
                <label for="tipo_documento_id">Tipo de Documento</label>
                @error('tipo_documento_id')
                    <small class="text-danger slide-left" style="animation-delay:1.4s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 form-floating fade-in" style="animation-delay:1.4s;">
                <input type="date" name="fecha_expedicion" id="fecha_expedicion" class="form-control" placeholder="Fecha de Expedición" required>
                <label for="fecha_expedicion">Fecha de Expedición</label>
                @error('fecha_expedicion')
                    <small class="text-danger slide-left" style="animation-delay:1.6s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 form-floating fade-in" style="animation-delay:1.6s;">
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" placeholder="Fecha de Vencimiento" readonly required>
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                @error('fecha_vencimiento')
                    <small class="text-danger slide-left" style="animation-delay:1.8s;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 form-floating fade-in" style="animation-delay:2s;">
                <input type="text" name="entidad_emisora" id="entidad_emisora" class="form-control" placeholder="Entidad Emisora" required>
                <label for="entidad_emisora">Entidad Emisora</label>
                @error('entidad_emisora')
                    <small class="text-danger slide-left" style="animation-delay:2.2s;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom-register zoom-in w-100 mt-3" style="animation-delay:2.4s;">Registrar Documentación</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('fecha_expedicion').addEventListener('change', function() {
        let fechaExp = new Date(this.value);
        fechaExp.setFullYear(fechaExp.getFullYear() + 1);
        const y = fechaExp.getFullYear();
        const m = String(fechaExp.getMonth()+1).padStart(2,'0');
        const d = String(fechaExp.getDate()).padStart(2,'0');
        document.getElementById('fecha_vencimiento').value = `${y}-${m}-${d}`;
    });
</script>
@endsection
