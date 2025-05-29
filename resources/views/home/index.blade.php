@extends('layouts.app-master')

@section('content')
<div class="container py-5 fade-in-up">
    {{-- Hero Section --}}
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            @auth
                <h1 class="display-4 slide-right">¡Hola, {{ auth()->user()->username }}!</h1>
                <p class="lead text-muted fade-in" style="animation-delay: 0.3s;">Bienvenido al Sistema de Documentación de Vehículos (SDGV). Gestiona tus documentos de forma fácil y segura.</p>
            @else
                <h1 class="display-4 slide-right">¡Bienvenido a SDGV!</h1>
                <p class="lead text-muted fade-in" style="animation-delay: 0.3s;">Registra y controla la documentación de tus vehículos con alertas oportunas y notificaciones.</p>
            @endauth
        </div>
        <div class="col-md-6 text-center zoom-in" style="animation-delay: 0.5s;">
            <img src="{{ asset('assets/auto.png') }}" alt="Icono Vehículo" class="img-fluid" style="max-height: 180px;">
        </div>
    </div>

    {{-- Gallery Cards for Verified Users --}}
    @auth
    @if(auth()->user()->hasVerifiedEmail())
        @if(auth()->user()->role !== 'admin')
        <div class="row justify-content-center mb-5">
            <div class="col-sm-6 col-md-4 mb-3 fade-in-up" style="animation-delay: 0.4s;">
                <div class="card shadow-sm zoom-in" style="animation-delay: 0.6s;">
                    <img src="{{ asset('assets/auto.png') }}" class="card-img-top" alt="Vehículos" style="max-height: 120px; object-fit: contain;">
                    <div class="card-body text-center p-3">
                        <h6 class="card-title slide-left" style="animation-delay: 0.8s;">Mis Vehículos</h6>
                        <p class="card-text text-muted small fade-in" style="animation-delay: 1s;">Visualiza y administra tus vehículos.</p>
                        <a href="{{ route('vehiculos.index') }}" class="gallery-button w-100 zoom-in" style="animation-delay: 1.2s; text-decoration: none; ">Ver Vehículos</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mb-3 fade-in-up" style="animation-delay: 0.5s;">
                <div class="card shadow-sm zoom-in" style="animation-delay: 0.7s;">
                    <img src="{{ asset('assets/licencia.png') }}" class="card-img-top" alt="Licencias" style="max-height: 120px; object-fit: contain;">
                    <div class="card-body text-center p-3">
                        <h6 class="card-title slide-left" style="animation-delay: 0.9s;">Mis Licencias</h6>
                        <p class="card-text text-muted small fade-in" style="animation-delay: 1.1s;">Revisa y genera duplicados.</p>
                        <a href="{{ route('licencias.index') }}" class="gallery-button w-100 zoom-in" style="animation-delay: 1.3s; text-decoration: none; ">Ver Licencias</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @else
        <div class="alert alert-warning text-center mb-5 slide-left" style="animation-delay: 0.4s;">
            <p class="mb-2 fade-in" style="animation-delay: 0.6s;">Tu correo electrónico no está verificado.</p>
            <a href="{{ route('verification.notice') }}" class="btn btn-warning zoom-in" style="animation-delay: 0.8s;">Verificar Correo</a>
        </div>
    @endif
@endauth

    {{-- Info Sections --}}
    <div class="row fade-in-up" style="animation-delay: 0.3s;">
        <div class="col-md-6 mb-4 slide-left" style="animation-delay: 0.5s;">
            <div class="p-4 bg-light rounded shadow-sm zoom-in" style="animation-delay: 0.7s;">
                <h2 class="slide-right" style="animation-delay: 0.9s;">¿Por qué existe SDGV?</h2>
                <p class="fade-in" style="animation-delay: 1.1s;">Sin las herramientas correctas, gestionar documentos de tu vehículo puede ser complicado y costoso. Con SDGV recibirás recordatorios oportunos y tendrás todo centralizado.</p>
                <ul class="small fade-in" style="animation-delay: 1.3s;">
                    <li>Alertas de vencimiento</li>
                    <li>Notificaciones por correo</li>
                    <li>Acceso desde cualquier dispositivo</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 mb-4 slide-right" style="animation-delay: 0.6s;">
            <div class="p-4 bg-dark text-white rounded shadow-sm zoom-in" style="animation-delay: 0.8s;">
                <h2 class="slide-left" style="animation-delay: 1s;">Riesgos de documentación vencida</h2>
                <p class="fade-in" style="animation-delay: 1.2s;">Conducir sin documentos al día en Colombia puede acarrear:</p>
                <ul class="small fade-in" style="animation-delay: 1.4s;">
                    <li>Multas superiores a 10 salarios diarios legales vigentes</li>
                    <li>Inmovilización del vehículo y retiro de placa (Art. 131 CNT)</li>
                    <li>Negación de cobertura SOAT en accidentes</li>
                    <li>Riesgos de seguridad por falla mecánica</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
