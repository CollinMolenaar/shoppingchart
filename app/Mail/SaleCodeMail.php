<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SaleCodeMail extends Mailable
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Your Sale Code')
            ->view('emails.salecode')
            ->with(['code' => $this->code]);
    }
}
