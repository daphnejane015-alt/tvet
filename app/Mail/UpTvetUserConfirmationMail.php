<?php

namespace App\Mail;

use App\Models\UpTvetApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpTvetUserConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public UpTvetApplication $application;

    /**
     * Create a new message instance.
     */
    public function __construct(UpTvetApplication $application)
    {
        $this->application = $application;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengesahan Permohonan UP_TVET - TVET Malaysia',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.up_tvet_user_confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
