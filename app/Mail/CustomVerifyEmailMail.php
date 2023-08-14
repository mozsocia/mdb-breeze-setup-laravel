<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomVerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationUrl;
    protected $recipientEmail;

    /**
     * Create a new message instance.
     *
     * @param  string  $verificationUrl
     * @param  string  $recipientEmail
     * @return void
     */
    public function __construct($verificationUrl, $recipientEmail)
    {
        $this->verificationUrl = $verificationUrl;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->recipientEmail)
            ->subject('Verify Email Address moz')
            ->view('emails.verify_email_html'); // Use an HTML Blade view
    }
}
