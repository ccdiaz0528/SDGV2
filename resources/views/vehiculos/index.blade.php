@extends('layouts.app-master')

@section('content')
    <div class="container fade-in-up" style="animation-delay: 0.2s;">
        <h1 class="slide-down mb-4" style="animation-delay: 0.4s;">Vehículos Registrados</h1>
        @if(session('success'))
            <div class="alert alert-success fade-in" style="animation-delay: 0.6s;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive zoom-in" style="animation-delay: 0.8s;">
            <table class="table table-bordered" style="animation-delay: 1s;">
                <thead class="fade-in-up" style="animation-delay: 1.2s;">
                    <tr>
                        <th class="border-end">Marca</th>
                        <th class="border-end">Placa</th>
                        <th class="border-end">Color</th>
                        <th class="border-end">Modelo</th>
                        <th class="border-end">Tipo de Documento</th>
                        <th class="border-end">Fecha de Vencimiento</th>
                        <th class="border-end">Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehiculos as $vehiculo)
                        <tr class="fade-in" style="animation-delay: {{ 1.4 + ($loop->index * 0.1) }}s;">
                            <td class="border-end">{{ $vehiculo->marca }}</td>
                            <td class="border-end">{{ $vehiculo->placa }}</td>
                            <td class="border-end">{{ $vehiculo->color }}</td>
                            <td class="border-end">{{ $vehiculo->modelo }}</td>
                            <td class="border-end fade-in-left" style="animation-delay: {{ 1.5 + ($loop->index * 0.1) }}s;">
                                @foreach($vehiculo->documentacion as $doc)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $doc->tipoDocumento?->nombre ?? 'Tipo de documento no disponible' }}</span>
                                        <a href="{{ route('documentacion.edit', $doc->id) }}" class="btn btn-secondary btn-sm ms-2 zoom-in" style="animation-delay: {{ 1.6 + ($loop->index * 0.1) }}s;">
                                            <img src="{{ asset('assets/editar.png') }}" alt="Editar" width="12" height="12">
                                        </a>
                                    </div>
                                @endforeach
                            </td>
                            <td class="border-end fade-in-left" style="animation-delay: {{ 1.7 + ($loop->index * 0.1) }}s;">
                                @foreach($vehiculo->documentacion as $doc)
                                    <div>{{ $doc->fecha_vencimiento }}</div>
                                @endforeach
                            </td>
                            <td class="border-end fade-in-left" style="animation-delay: {{ 1.8 + ($loop->index * 0.1) }}s;">
                                @foreach($vehiculo->documentacion as $doc)
                                    <div>{{ $doc->fecha_vencimiento >= now() ? 'Vigente' : 'No Vigente' }}</div>
                                @endforeach
                            </td>
                            <td class="fade-in-up" style="animation-delay: {{ 1.9 + ($loop->index * 0.1) }}s;">
                                <div class="d-flex flex-column gap-1">
                                    <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm w-100 zoom-in" style="animation-delay: {{ 2.0 + ($loop->index * 0.1) }}s;">
                                        Editar <img src="{{ asset('assets/editar.png') }}" alt="Editar" width="12" height="12">
                                    </a>
                                    <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este vehículo?');" class="d-inline zoom-in" style="animation-delay: {{ 2.1 + ($loop->index * 0.1) }}s;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            Eliminar <img src="{{ asset('assets/eliminar.png') }}" alt="Eliminar" width="15" height="15">
                                        </button>
                                    </form>
                                    <a href="{{ route('documentacion.create', $vehiculo->id) }}" class="btn btn-info btn-sm w-100 zoom-in" style="animation-delay: {{ 2.2 + ($loop->index * 0.1) }}s;">
                                        Diligenciar <img src="{{ asset('assets/doc.png') }}" alt="Documentación" width="18" height="18">
                                    </a>
                                    <a href="{{ route('vehiculos.generarDuplicado', $vehiculo->id) }}" class="btn btn-success btn-sm w-100 zoom-in" style="animation-delay: {{ 2.3 + ($loop->index * 0.1) }}s;">
                                        Duplicado <img src="{{ asset('assets/duplicado.png') }}" alt="Duplicado" width="15" height="15">
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="fade-in-up" style="animation-delay: 1.5s;">
                            <td colspan="8" class="text-center">No hay vehículos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
