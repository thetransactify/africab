<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductInStockMail extends Mailable
{
    use Queueable, SerializesModels;
    public $product;
    public $user;


    /**
     * Create a new message instance.
     */
    public function __construct($product, $user)
    {
        //
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function build()
        {
            return $this->subject('Product Back in Stock!')
                        ->view('emails.ProductInStock');
        }
}
