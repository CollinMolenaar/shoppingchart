<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use SerializesModels;

    public $cart;
    public $totalAmount;

    public function __construct($cart, $totalAmount)
    {
        $this->cart = $cart;
        $this->totalAmount = $totalAmount;
    }

    public function build()
    {
        return $this->view('emails.order')
            ->with([
                'cart' => $this->cart,
                'totalAmount' => $this->totalAmount,
            ]);
    }
}
