<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'username.required' => 'El campo Correo o Usuario es obligatorio',
            'password.required' => 'El campo Contraseña es obligatorio',
            'password.min' => 'El campo Contraseña debe tener mínimo 8 caracteres',
        ];
    }

    /**
     * Intenta autenticar al usuario.
     */
    public function authenticate(): void
    {
        $credentials = $this->getCredentials();

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => __('auth.failed'), // puedes personalizar el mensaje
            ]);
        }

        $this->session()->regenerate();
    }

    /**
     * Devuelve las credenciales correctas para el intento de login.
     */
    public function getCredentials(): array
    {
        $username = $this->get('username');

        if ($this->isEmail($username)) {
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        }

        return [
            'username' => $username,
            'password' => $this->get('password')
        ];
    }

    /**
     * Verifica si el valor ingresado es un correo válido.
     */
    public function isEmail($value): bool
    {
        $factory = $this->container->make(ValidationFactory::class);

        return !$factory->make(['username' => $value], [
            'username' => 'email'
        ])->fails();
    }
}
