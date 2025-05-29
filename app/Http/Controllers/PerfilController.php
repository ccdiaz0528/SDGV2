<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    public function index()
    {
        $cliente = Auth::user()->cliente;

        return view('clientes.perfil', compact('cliente'));
    }

    public function update(Request $request)
    {

    $request->validate([
        'nombre' => 'required|string|max:40',
        'apellido' => 'nullable|string|max:40',
        'cedula' => 'required|string|max:20|unique:clientes,cedula,' . optional(Auth::user()->cliente)->id,
        'telefono' => 'nullable|numeric|min:1000000000|max:9999999999',
        'direccion' => 'nullable|string|max:80',
    ], [
        'cedula.unique' => 'La cédula ya está registrada. Por favor, ingrese un número diferente.',
        'telefono.numeric' => 'El campo teléfono debe contener solo números.',
        'telefono.min' => 'El campo telefono debe tener mínimo 10 dígitos',
        'telefono.max' => 'El campo telefono debe tener máximo 10 dígitos',
    ]);

    $cliente = Auth::user()->cliente;

    // Crear cliente si no existe
    if (!$cliente) {
        $cliente = Auth::user()->cliente()->create([]);
    }

    $cliente->update($request->only('nombre', 'apellido', 'cedula', 'telefono', 'direccion'));

    return redirect()->route('perfil')->with('success', '¡Información actualizada con éxito!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Verificar si el perfil existe
        if (!$user->perfil) {
            // Crear perfil vacío o con datos predeterminados
            $user->perfil()->create([
                // Agrega aquí los campos predeterminados si es necesario
            ]);
        }

        return view('perfil.edit', compact('user'));
    }
public function actualizarCredenciales(Request $request)
{
    $user = auth()->user();

    // 1. Validate current password
    $request->validate([
        'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
            if (!Hash::check($value, $user->password)) {
                $fail('La contraseña actual es incorrecta.');
            }
        }],
    ]);

    // 2. Validate new credentials
    $rules = [
        'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'], // 'nullable' allows it to be empty, 'confirmed' ensures password_confirmation matches
    ];

    $validatedData = $request->validate($rules);

    // 3. Update user data
    $user->username = $validatedData['username'];
    $user->email = $validatedData['email'];

    if ($request->filled('password')) { // Only update password if a new one is provided
        $user->password = Hash::make($validatedData['password']);
    }

    $user->save();

    return redirect()->back()->with('success_login', 'Credenciales de acceso actualizadas correctamente.');
}
}
