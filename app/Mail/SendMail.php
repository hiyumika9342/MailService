<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    private $emailAddressList;

    private $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailAddressList, $message)
    {
        $this->emailAddressList = $emailAddressList;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail_from_address'))
        ->subject('メール一斉送信です')
        ->to($this->emailAddressList)
        ->view('email.template')
        ->with(['sendMessage' => $this->message]);
    }
}
