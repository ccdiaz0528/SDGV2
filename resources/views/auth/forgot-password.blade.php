@extends('layouts.app-master')
@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">

    <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 8px;">


        <h1 class="text-center mb-4">Recuperar Contraseña</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
                <label for="exampleInputEmail1" class="form-label">Correo Electrónico</label>
            </div>

            <button type="submit" class="btn btn-custom me-2 w-100">Enviar Enlace de Recuperación</button>
        </form>
    </div>

</div>
@endsection
