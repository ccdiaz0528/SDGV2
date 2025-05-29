<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VencimientoLicenciaNotification extends Notification
{
    use Queueable;

    protected $licencia;

    public function __construct($licencia)
    {
        $this->licencia = $licencia;
    }

    public function via($notifiable)
    {
        return ['mail']; // Enviar por correo
    }

    public function toMail($notifiable)
    {
        $fechaVenc = $this->licencia->fecha_vencimiento->format('d/m/Y');
        return (new MailMessage)
        ->subject('🔔 Aviso Importante: ¡Tu Licencia Está por Vencer!')
        ->greeting("Hola, {$notifiable->name}")
        ->line("Te informamos que tu licencia con número **{$this->licencia->numero_licencia}** vence el día **{$fechaVenc}**.")
        ->line("Por favor, realiza el proceso de renovación con anticipación para evitar inconvenientes.")
        ->action('Ir al sistema', url('/')) // Puedes cambiar la URL
        ->line('Gracias por utilizar nuestro sistema de gestión.')
        ->salutation('Atentamente, El equipo de soporte');
    }
}
