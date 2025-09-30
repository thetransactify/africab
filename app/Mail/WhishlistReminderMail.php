<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WhishlistReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

        public function build()
    {
        return $this->subject('Don’t forget your wishlist product!')
                    ->view('emails.remindermail')
                    ->with(['product' => $this->product]);
    }

  
}
