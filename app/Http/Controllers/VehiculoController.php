<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class VehiculoController extends Controller
{
    public function create()
    {
        return view('vehiculos.create'); // Vista para crear un vehículo
    }

    public function store(Request $request)
{
    $request->validate([
        'marca' => 'required|string|alpha|max:30',
        'placa' => [
            'required',
            'unique:vehiculos,placa',
            'regex:/^[A-Z]{3}[0-9]{3}$|^[A-Z]{3}[0-9]{2}[A-Z]$/'
        ],
        'color' => 'required|string|alpha|max:25',
        'modelo' => 'required|string|min:4|max:4',
    ], [
        'marca.alpha' => 'La marca solo puede contener letras.',
        'color.alpha' => 'El color solo puede contener letras.',
        'marca.required' => 'El campo marca es obligatorio.',
        'marca.string' => 'La marca debe ser un texto.',
        'marca.max' => 'La marca no puede tener más de 30 caracteres.',
        'placa.required' => 'El campo placa es obligatorio.',
        'placa.unique' => 'La placa ya ha sido registrada.',
        'placa.regex' => 'El formato de la placa es inválido. Debe ser 3 letras seguidas de 3 números para carros, o 3 letras, 2 números y 1 letra para motos.',
        'color.required' => 'El campo color es obligatorio.',
        'color.string' => 'El color debe ser un texto.',
        'color.max' => 'El color no puede tener más de 25 caracteres.',
        'modelo.required' => 'El campo modelo es obligatorio.',
        'modelo.string' => 'El modelo debe ser un texto.',
        'modelo.min' => 'El modelo debe tener exactamente 4 caracteres.',
        'modelo.max' => 'El modelo no puede tener más de 4 caracteres.',
    ]);

    $vehiculo = new Vehiculo();
    $vehiculo->marca = $request->marca;
    $vehiculo->placa = $request->placa;
    $vehiculo->color = $request->color;
    $vehiculo->modelo = $request->modelo;
    $vehiculo->user_id = Auth::id(); // Asigna el ID del usuario autenticado
    $vehiculo->save();

    return redirect()->route('vehiculos.index')->with('success', 'Vehículo registrado exitosamente.');
}

    public function index()
    {
       // Cargar vehículos del usuario autenticado con la documentación asociada
        $vehiculos = Vehiculo::with('documentacion')->where('user_id', auth()->id())->get();
        return view('vehiculos.index', compact('vehiculos'));
    }


    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('vehiculos.edit', compact('vehiculo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            //'marca' => 'required|string|max:30',
            'color' => 'required|string|max:35',
            //'modelo' => 'required|string|min:4|max:4',
            // No necesitas validar 'placa' ya que es readonly
        ]);

        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado con éxito.');
    }


    public function destroy($id)
{
    // Encuentra el vehículo por ID
    $vehiculo = Vehiculo::findOrFail($id);

    // Elimina el vehículo
    $vehiculo->delete();

    // Redirige a la lista de vehículos con un mensaje de éxito
    return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado correctamente.');
}







// filepath: c:\laragon\www\SDGV2\app\Http\Controllers\VehiculoController.php



public function generarDuplicado($id)
{
    // Obtener el vehículo y sus relaciones (documentación y usuario)
    $vehiculo = Vehiculo::with('documentacion.tipoDocumento', 'user')->findOrFail($id);

    // Generar el contenido HTML usando la vista 'pdf.vehiculo'
    // Este contenido se enviará en el cuerpo del correo
    $contenido = view('pdf.vehiculo', compact('vehiculo'))->render();

    // Generar el PDF a partir de la misma vista
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.vehiculo', compact('vehiculo'));

    // Nombre y ruta del archivo PDF
    $nombreArchivo = "Duplicado_Vehiculo_{$vehiculo->placa}.pdf";
    $rutaArchivo = storage_path("app/public/{$nombreArchivo}");

    // Guardar el PDF de forma temporal
    $pdf->save($rutaArchivo);

    // Enviar el correo con el contenido HTML (sin adjuntar el PDF)
    \Illuminate\Support\Facades\Mail::to($vehiculo->user->email)
        ->send(new \App\Mail\DuplicadoVehiculoMail($vehiculo, $contenido));

    // Retornar la descarga del PDF al usuario y eliminar el archivo después
    return response()->download($rutaArchivo)->deleteFileAfterSend(true);
}
}
