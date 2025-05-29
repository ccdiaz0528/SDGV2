<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DuplicadoLicenciaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $licencia;
    public $contenidoHtml;

    /**
     * Create a new message instance.
     */
    public function __construct($licencia, $contenidoHtml)
    {
        $this->licencia = $licencia;
        $this->contenidoHtml = $contenidoHtml;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Duplicado de Licencia de Tránsito')
                    ->html($this->contenidoHtml);
    }
}
