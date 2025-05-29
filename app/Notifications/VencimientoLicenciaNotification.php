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
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('🚨 Aviso: Licencia próxima a vencer')
        ->view('emails.licencia_vencimiento', [
            'user' => $notifiable,
            'licencia' => $this->licencia,
        ]);
}
}
