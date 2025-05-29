<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Licencia;
use App\Models\Documentacion;
use Carbon\Carbon;
use App\Notifications\VencimientoLicenciaNotification;
use App\Notifications\VencimientoDocumentacionNotification;

class NotificarVencimientos extends Command
{
    // Firma del comando Artisan
    protected $signature = 'notificar:vencimientos';

    // Descripción del comando
    protected $description = 'Notificar a usuarios sobre licencias y documentaciones que vencen en menos de 15 días';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{
     Log::info('Comando de notificaciones ejecutado.');
    // Fecha actual y fecha límite (15 días en el futuro)
    $hoy = Carbon::now();
    $limite = Carbon::now()->addDays(15);

    // 2.1. Obtener licencias por vencer en menos de 15 días
    $licencias = Licencia::where('fecha_vencimiento', '>=', $hoy)
                         ->where('fecha_vencimiento', '<=', $limite)
                         ->get();

    foreach ($licencias as $licencia) {
        $user = $licencia->user; // Relación licencia->user->email
        if ($user) {
            $user->notify(new VencimientoLicenciaNotification($licencia));
            $this->info("Notificación de licencia enviada a: {$user->email}");
        }
    }

    // 2.2. Obtener documentaciones por vencer en menos de 15 días
    $documentaciones = Documentacion::where('fecha_vencimiento', '>=', $hoy)
                                    ->where('fecha_vencimiento', '<=', $limite)
                                    ->get();

    foreach ($documentaciones as $doc) {
        // Relación documentacion->vehiculo->user->email
        $vehiculo = $doc->vehiculo;
        if ($vehiculo && $vehiculo->user) {
            $user = $vehiculo->user;
            $user->notify(new VencimientoDocumentacionNotification($doc));
            $this->info("Notificación de documentación enviada a: {$user->email}");
        }
    }
    $this->info("Se enviaron las notificaciones.");
}

}
