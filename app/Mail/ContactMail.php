<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from('FAIZANENTERPRISES.LOGISTICS@gmail.com')
                    ->subject($this->data['subject'])
                    ->view('emails.contact') // Create this view for the email content
                    ->with('data', $this->data);
    }
}
