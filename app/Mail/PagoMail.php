<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Model\PagoConfirmar;

class PagoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pago;

    public function __construct(PagoConfirmar $pago)
    {
        $this->pago = $pago;
    }

    public function build()
    {
        return $this->view('mail.pago');
    }
}
