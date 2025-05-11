@extends('layouts.app-master')

@section('content')
<div class="container d-flex justify-content-center align-items-center fade-in-up" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: var(--radius); background: #fff; box-shadow: var(--shadow-light);">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h1 class="text-center mb-4" style="color: var(--text-dark);">{{ __('Restablecer Contraseña') }}</h1>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label" style="color: var(--text-dark);">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email"
                       placeholder="Ingrese su email"
                       value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label" style="color: var(--text-dark);">{{ __('Password') }}</label>
                <div class="input-group">
                    <input id="password" class="form-control" type="password" name="password"
                           placeholder="Ingrese su contraseña" required autocomplete="new-password">
                    <span class="input-group-text">
                        <button type="button" class="btn btn-link p-0" onclick="togglePassword('password', this)">
                            <i class="fa fa-eye" style="color: #000;"></i>
                        </button>
                    </span>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label" style="color: var(--text-dark);">{{ __('Confirm Password') }}</label>
                <div class="input-group">
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                           placeholder="Confirme su contraseña" required autocomplete="new-password">
                    <span class="input-group-text">
                        <button type="button" class="btn btn-link p-0" onclick="togglePassword('password_confirmation', this)">
                            <i class="fa fa-eye" style="color: #000;"></i>
                        </button>
                    </span>
                </div>
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom w-100">
                {{ __('Restablecer Contraseña') }}
            </button>
        </form>
    </div>
</div>

<script>
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

@endsection
