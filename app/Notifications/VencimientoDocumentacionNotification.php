<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VencimientoDocumentacionNotification extends Notification
{
    use Queueable;

    protected $documentacion;

    public function __construct($documentacion)
    {
        $this->documentacion = $documentacion;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $fechaVenc = $this->documentacion->fecha_vencimiento->format('d/m/Y');
        return (new MailMessage)
                    ->subject('Aviso: Documentación por vencer')
                    ->greeting("Estimado/a {$notifiable->name},")
                    ->line("La documentación (ID: {$this->documentacion->id}) del vehículo vence el **{$fechaVenc}**.")
                    ->line('Por favor, asegúrese de tener todos los papeles al día antes de esa fecha.')
                    ->line('Atentamente, el equipo de administración.');
    }
}
