<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerVerifyEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $verificationLink;

    public function __construct(string $verificationLink)
    {
        $this->verificationLink = $verificationLink;
    }

    public function build()
    {
        return $this->subject('Verify Your Email Address')
            ->view('emails.verify-customer-email')
            ->with(['verificationLink' => $this->verificationLink]);
    }
}
