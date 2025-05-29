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
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('🚨 Aviso: Documentación próxima a vencer')
        ->view('emails.documentacion_vencimiento', [
            'user' => $notifiable,
            'documentacion' => $this->documentacion,
        ]);
}
}
