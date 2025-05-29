<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CategoriaLicencia;
use App\Models\Licencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class LicenciaController extends Controller
{
    public function create()
    {
        $categorias = CategoriaLicencia::all(); // Obtener todas las categorías
        return view('licencias.create', compact('categorias'));
    }

    public function store(Request $request)
{
    $request->validate([
        'numero_licencia' => 'required|string|regex:/^[0-9]+$/|min:8|max:10|unique:licencias',
        'fecha_expedicion' => [
            'required',
            'date',
            'before_or_equal:today', // Validación: la fecha de expedición debe ser hoy o antes
            function ($attribute, $value, $fail) {
                $añoIngresado = Carbon::parse($value)->year;
                $añoActual = now()->year;
                if ($añoIngresado > $añoActual) {
                    $fail('La fecha de expedición no puede ser superior al año actual.');
                }
            }
        ],
        'fecha_vencimiento' => 'required|date|after:fecha_expedicion',
        'categorias' => 'required|array|max:3',
        'categorias.*' => 'exists:categorias_licencias,id',
    ], [
        'numero_licencia.regex' => 'El número de licencia solo puede contener dígitos.',
        'numero_licencia.required' => 'El número de licencia es obligatorio.',
        'numero_licencia.max' => 'El número de licencia es de máximo 10 dígitos.',
        'numero_licencia.min' => 'El número de licencia es de mínimo 8 dígitos.',
        'numero_licencia.unique' => 'El número de licencia ya está en uso.',
        'fecha_expedicion.required' => 'La fecha de expedición es obligatoria.',
        'fecha_expedicion.before_or_equal' => 'La fecha de expedición no puede ser superior a la fecha actual.',
        'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
        'fecha_vencimiento.after' => 'La fecha de vencimiento debe ser posterior a la fecha de expedición.',
        'categorias.required' => 'Debes seleccionar al menos una categoría.',
        'categorias.max' => 'No puedes seleccionar más de 3 categorías para una licencia.',
        'categorias.*.exists' => 'Una de las categorías seleccionadas no es válida.',
    ]);

    // Guardar la licencia
    $licencia = new Licencia($request->all());
    $licencia->user_id = auth()->id();
    $licencia->estado = $request->fecha_vencimiento >= now() ? 'Vigente' : 'No Vigente';
    $licencia->save();

    if ($request->has('categorias')) {
        $licencia->categorias()->attach($request->categorias);
    }

    return redirect()->route('licencias.index')->with('success', 'Licencia registrada exitosamente.');
}

    public function index()
    {
        $licencias = Licencia::with('categorias')
                    ->where('user_id', auth()->id())
                    ->get();

        return view('licencias.index', compact('licencias'));
    }

    public function edit($id)
    {
        $licencia = Licencia::where('user_id', auth()->id())->findOrFail($id);
        $categorias = CategoriaLicencia::all();

        return view('licencias.edit', compact('licencia', 'categorias'));
    }

    public function update(Request $request, $id)
{
    $licencia = Licencia::where('user_id', auth()->id())->findOrFail($id);

    $request->validate([
        'numero_licencia' => 'required|string|regex:/^[0-9]+$/|min:8|max:10|unique:licencias,numero_licencia,' . $licencia->id,
        'fecha_expedicion' => [
            'required',
            'date',
            'before_or_equal:today', // Validación: la fecha de expedición debe ser hoy o antes
            function ($attribute, $value, $fail) {
                $añoIngresado = Carbon::parse($value)->year;
                $añoActual = now()->year;
                if ($añoIngresado > $añoActual) {
                    $fail('La fecha de expedición no puede ser superior al año actual.');
                }
            }
        ],
        'fecha_vencimiento' => 'required|date|after:fecha_expedicion',
        'categorias' => 'required|array|max:3',
        'categorias.*' => 'exists:categorias_licencias,id',
    ], [
        'numero_licencia.regex' => 'El número de licencia solo puede contener dígitos.',
        'numero_licencia.required' => 'El número de licencia es obligatorio.',
        'numero_licencia.max' => 'El número de licencia es de máximo 10 dígitos.',
        'numero_licencia.min' => 'El número de licencia es de mínimo 8 dígitos.',
        'numero_licencia.unique' => 'El número de licencia ya está en uso.',
        'fecha_expedicion.required' => 'La fecha de expedición es obligatoria.',
        'fecha_expedicion.before_or_equal' => 'La fecha de expedición no puede ser superior a la fecha actual.',
        'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
        'fecha_vencimiento.after' => 'La fecha de vencimiento debe ser posterior a la fecha de expedición.',
        'categorias.required' => 'Debes seleccionar al menos una categoría.',
        'categorias.max' => 'No puedes seleccionar más de 3 categorías para una licencia.',
        'categorias.*.exists' => 'Una de las categorías seleccionadas no es válida.',
    ]);

    $data = [
        'numero_licencia' => $request->numero_licencia,
        'fecha_expedicion' => $request->fecha_expedicion,
        'fecha_vencimiento' => $request->fecha_vencimiento,
        'estado' => $request->fecha_vencimiento >= now() ? 'Vigente' : 'No Vigente',
    ];

    $licencia->update($data);
    $licencia->categorias()->sync($request->categorias);

    return redirect()->route('licencias.index')->with('success', 'Licencia actualizada con éxito.');
}
    public function destroy($id)
    {
        $licencia = Licencia::where('user_id', auth()->id())->findOrFail($id);
        $licencia->delete();

        return redirect()->route('licencias.index')->with('success', 'Licencia eliminada correctamente');
    }

    public function generarDuplicado($id)
{
    // Obtener la licencia con sus categorías
    $licencia = Licencia::where('user_id', auth()->id())
                        ->with('categorias')
                        ->findOrFail($id);

    // Calcular días restantes
    $diasRestantes = now()->diffInDays($licencia->fecha_vencimiento, false);

    // Renderizar HTML desde la vista Blade
    $contenidoHtml = view('pdf.licencia', compact('licencia', 'diasRestantes'))->render();

    // Generar el PDF usando DomPDF
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.licencia', compact('licencia', 'diasRestantes'));

    // Nombre del archivo PDF
    $nombreArchivo = "duplicado_licencia_{$licencia->numero_licencia}.pdf";
    $rutaArchivo = storage_path("app/public/{$nombreArchivo}");

    // Guardar el PDF temporalmente
    $pdf->save($rutaArchivo);

    // Enviar correo con el contenido HTML del duplicado
    \Mail::to($licencia->user->email ?? auth()->user()->email)
         ->send(new \App\Mail\DuplicadoLicenciaMail($licencia, $contenidoHtml));

    // Devolver el archivo PDF como descarga
    return response()->download($rutaArchivo)->deleteFileAfterSend(true);
}
}
