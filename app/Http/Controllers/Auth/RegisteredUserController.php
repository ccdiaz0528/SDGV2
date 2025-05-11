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
        $user = User::create([  // Asignar el usuario a la variable $user
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'], // No encriptes aquí, el modelo se encargará de eso
            'role' => 'user',
        ]);

        // Crear el cliente vinculado al usuario
        Cliente::create([
            'user_id' => $user->id,  // Ahora puedes acceder a $user
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Autenticar al usuario automáticamente
        auth()->login($user);

        return redirect()->route('home.index')->with('success', '¡Registro exitoso!');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
