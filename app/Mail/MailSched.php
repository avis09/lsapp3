<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSched extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_content)
    {
        $this->mail_content = $mail_content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('roelchristian.sevesa@benilde.edu.ph');
        $mail_content = $this->mail_content;
        return $this->from('roelchristian.sevesa@benilde.edu.ph')->subject($mail_content['title'])
            ->view('emails.sendConfirmation', compact('mail_content'));
    }
}
