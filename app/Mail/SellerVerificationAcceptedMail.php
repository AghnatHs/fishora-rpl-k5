<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SellerVerificationAcceptedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $seller;

    public function __construct($seller)
    {
        $this->seller = $seller;
    }

    public function build()
    {
        return $this->subject('Seller Verification Approved')
            ->view('emails.verify-seller-accepted');
    }
}
