@extends('layouts.app-master')

@section('content')
<div class="container py-5 fade-in-up" style="animation-delay: 0.2s;">
    <h1 class="slide-down mb-4" style="animation-delay: 0.4s;">Licencias Registradas</h1>
    @if(session('success'))
        <div class="alert alert-success fade-in" style="animation-delay: 0.6s;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive zoom-in" style="animation-delay: 0.8s;">
        <table class="table table-bordered" style="animation-delay: 1s;">
            <thead class="fade-in-up" style="animation-delay: 1.2s;">
                <tr>
                    <th class="border-end">Número de Licencia</th>
                    <th class="border-end">Fecha de Expedición</th>
                    <th class="border-end">Fecha de Vencimiento</th>
                    <th class="border-end">Estado</th>
                    <th class="border-end">Categorías</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($licencias as $licencia)
                    <tr class="fade-in" style="animation-delay: {{ 1.4 + ($loop->index * 0.1) }}s;">
                        <td class="border-end">{{ $licencia->numero_licencia }}</td>
                        <td class="border-end">{{ $licencia->fecha_expedicion }}</td>
                        <td class="border-end">{{ $licencia->fecha_vencimiento }}</td>
                        <td class="border-end fade-in-left" style="animation-delay: {{ 1.5 + ($loop->index * 0.1) }}s;">
                            {{ $licencia->fecha_vencimiento >= now() ? 'Vigente' : 'No Vigente' }}
                        </td>
                        <td class="border-end fade-in-left" style="animation-delay: {{ 1.6 + ($loop->index * 0.1) }}s;">
                            @foreach($licencia->categorias as $categoria)
                                <span class="badge bg-secondary fade-in-up" style="animation-delay: {{ 1.7 + ($loop->parent->index * 0.1) }}s;">{{ $categoria->nombre }}</span>
                            @endforeach
                        </td>
                        <td class="fade-in-up" style="animation-delay: {{ 1.8 + ($loop->index * 0.1) }}s;">
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ route('licencias.edit', $licencia->id) }}" class="btn btn-warning btn-sm zoom-in" style="animation-delay: {{ 1.9 + ($loop->index * 0.1) }}s;">
                                    <img src="{{ asset('assets/editar.png') }}" alt="Editar" width="12" height="12"> Editar
                                </a>
                                <form action="{{ route('licencias.destroy', $licencia->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?');" class="d-inline zoom-in" style="animation-delay: {{ 2.0 + ($loop->index * 0.1) }}s;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <img src="{{ asset('assets/eliminar.png') }}" alt="Eliminar" width="15" height="15"> Eliminar
                                    </button>
                                </form>
                                <a href="{{ route('licencias.generarDuplicado', $licencia->id) }}" class="btn btn-success btn-sm zoom-in" style="animation-delay: {{ 2.1 + ($loop->index * 0.1) }}s;">
                                    <img src="{{ asset('assets/duplicado.png') }}" alt="Duplicado" width="15" height="15"> Duplicado
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="fade-in-up" style="animation-delay: 1.5s;">
                        <td colspan="6" class="text-center">No hay licencias registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
