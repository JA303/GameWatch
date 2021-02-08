<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'contact@gameswatch.ir';
        $subject = 'From Contact Us Form';
        // $name = 'Game Watch';

        return $this->view('emails.contact')
                    ->from($address, $this->data['name'])
                    // ->cc($address, $name)
                    // ->bcc($address, $name)
                    ->replyTo($this->data['email'], $this->data['name'])
                    ->subject($subject)
                    ->with([ 'data' => $this->data]);
    }
}
