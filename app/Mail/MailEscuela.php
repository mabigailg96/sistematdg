<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailEscuela extends Mailable
{
    use Queueable, SerializesModels;

    public $contenidoCorreo;
    public function __construct($contenidoCorreo)
    {
        $this -> contenidoCorreo = $contenidoCorreo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mensaje del Coordiandor de TDG')->view('mail.mensajeEscuela');
    }
}
