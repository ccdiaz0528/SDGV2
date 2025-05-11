@extends('layouts.app-master')

@section('content')
<div class="container d-flex justify-content-center align-items-center fade-in-up" style="min-height: 80vh;">
  <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: var(--radius); background: #fff; box-shadow: var(--shadow-light);">

    <div class="mb-4 text-sm" style="color: var(--text-muted);">
      {{ __('Gracias por registrarte! Antes de comenzar, verifica tu correo electrónico haciendo clic en el enlace que te enviamos. Si no lo recibiste, te enviaremos otro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
      <div class="mb-4 font-medium text-sm" style="color: #28a745;">
        {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
      </div>
    @endif

    <div class="d-flex justify-content-between">
      <form method="POST" action="{{ route('verification.send') }}" class="w-100 me-2">
        @csrf
        <button type="submit" class="btn btn-custom w-100">
          {{ __('Reenviar Email de Verificación') }}
        </button>
      </form>
      <form method="POST" action="{{ route('logout') }}" class="w-100 ms-2">
        @csrf
        <button type="submit" class="btn btn-link text-muted">
          {{ __('Cerrar Sesión') }}
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
