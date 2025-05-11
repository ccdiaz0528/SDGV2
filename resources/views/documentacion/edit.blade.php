@extends('layouts.app-master')

@section('content')
<br>
<div class="container d-flex justify-content-center align-items-center fade-in-up" style="animation-delay: 0.2s;">
    <div class="card shadow p-4 zoom-in" style="width: 100%; max-width: 400px; border-radius: 8px; animation-delay: 0.4s;">
        <h1 class="slide-down" style="animation-delay: 0.6s;">Editar Documentación</h1>

        <!-- Formulario para actualizar documentación -->
        <form action="{{ route('documentacion.update', $documento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group fade-in" style="animation-delay: 0.8s;">
                <label for="tipo_documento_id">Tipo de Documento</label>
                <select name="tipo_documento_id" id="tipo_documento_id" class="form-control" required>
                    <option value="">Selecciona un tipo</option>
                    @foreach($tiposDocumentos as $tipo)
                        <option value="{{ $tipo->id }}" {{ $documento->tipo_documento_id == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group fade-in" style="animation-delay: 1s;">
                <label for="fecha_expedicion">Fecha de Expedición</label>
                <input type="date" name="fecha_expedicion" id="fecha_expedicion" class="form-control" value="{{ $documento->fecha_expedicion }}" required>
                @error('fecha_expedicion')
                    <small class="text-danger slide-left">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group fade-in" style="animation-delay: 1.2s;">
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ $documento->fecha_vencimiento }}" required>
                @error('fecha_vencimiento')
                    <small class="text-danger slide-left">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group fade-in" style="animation-delay: 1.4s;">
                <label for="entidad_emisora">Entidad Emisora</label>
                <input type="text" name="entidad_emisora" id="entidad_emisora" class="form-control" value="{{ $documento->entidad_emisora }}" required>
                @error('entidad_emisora')
                    <small class="text-danger slide-left">{{ $message }}</small>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-custom-register zoom-in" style="animation-delay: 1.6s;">Actualizar Documentación</button>
        </form>
        <br>
        <form action="{{ route('documentacion.destroy', $documento->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta documentación?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-custom-delete zoom-in" style="animation-delay: 1.8s;">Eliminar Documentación</button>
        </form>
    </div>
</div>
<br>
<script>
    document.getElementById('fecha_expedicion').addEventListener('change', function() {
        // Obtener la fecha de expedición seleccionada
        let fechaExpedicion = new Date(this.value);

        // Añadir un año a la fecha de expedición
        fechaExpedicion.setFullYear(fechaExpedicion.getFullYear() + 1);

        // Formatear la nueva fecha para el campo de vencimiento (en formato "YYYY-MM-DD")
        let year = fechaExpedicion.getFullYear();
        let month = String(fechaExpedicion.getMonth() + 1).padStart(2, '0'); // Mes (0-11, se suma 1)
        let day = String(fechaExpedicion.getDate()).padStart(2, '0'); // Día

        // Actualizar el campo de fecha de vencimiento con el nuevo valor
        document.getElementById('fecha_vencimiento').value = `${year}-${month}-${day}`;
    });
</script>
@endsection
