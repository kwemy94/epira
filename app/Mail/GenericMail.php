<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $bodyMessage;
    public $signature;

    /**
     * Create a new message instance.
     */
    public function __construct($subjectText, $bodyMessage, $signature = null)
    {
        $this->subjectText = $subjectText;
        $this->bodyMessage = $bodyMessage;
        $this->signature = $signature ?? config('mail.default_signature', 'Cordialement,<br><strong>CHRE</strong>');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'dashboard.emails.contact_staff',
            with: [
                'messageBody' => $this->bodyMessage,
                'subjectText' => $this->subjectText,
                'signature' => $this->signature,
            ],
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
