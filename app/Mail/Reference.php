<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reference extends Mailable
{
    use Queueable, SerializesModels;

    public $reference;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reference)
    {
        $this->reference = $reference;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail to Reference Emails')
            ->from( 'contact@atthewhitehousecafe.com')
            ->view('mail.reference');
    }
}
