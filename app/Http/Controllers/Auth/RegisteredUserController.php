<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Cliente;
use App\Http\Requests\RegisterRequest; // Ensure this file exists in the specified namespace
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaCuentaMail; // Ensure this class exists in the App\Mail namespace

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
 public function store(RegisterRequest $request)
{
    // Validar la información de registro
    $validatedData = $request->validated();

    // Crear el usuario con rol 'user'
    $user = User::create([
        'username' => $validatedData['username'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => 'user',
    ]);

    // Crear el cliente vinculado al usuario y asignarlo a una variable
    $cliente = Cliente::create([
        'user_id' => $user->id,
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'cedula' => $request->cedula,
        'telefono' => $request->telefono,
        'direccion' => $request->direccion,
    ]);

    // Disparar el evento Registered
    event(new Registered($user));

    // Autenticar al usuario
    auth()->login($user);

    // Enviar el correo pasando el objeto Cliente para que se muestre $cliente->nombre en la vista
    Mail::to($user->email)->send(new NuevaCuentaMail($cliente));

    // Redirigir al usuario a la página de verificación
    return redirect()->route('verification.notice')->with('success', '¡Registro exitoso! Por favor, verifica tu correo electrónico.');
}

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
