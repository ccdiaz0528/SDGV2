<?php
// filepath: c:\laragon\www\SDGV2\app\Mail\DuplicadoVehiculoMail.php
namespace App\Mail;

use App\Models\Vehiculo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DuplicadoVehiculoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vehiculo;
    public $contenido; // Contenido HTML del duplicado

    /**
     * Create a new message instance.
     */
    public function __construct(Vehiculo $vehiculo, $contenido)
    {
        $this->vehiculo = $vehiculo;
        $this->contenido = $contenido;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Duplicado de Documentación del Vehículo'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.duplicado-vehiculo'
        );
    }

    /**
     * No se adjuntará ningún archivo.
     */
    public function attachments(): array
    {
        return [];
    }
}
