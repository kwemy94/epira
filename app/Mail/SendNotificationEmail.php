<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification de création de compte',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if (isset($this->data['created_account'])) {
            return new Content(
                view: 'dashboard.users.account-created',
            );
        }
        return new Content(
            view: 'emails.contact-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->from("granttiwa0@gmail.com") // L'expéditeur
            ->subject("Message via le SMTP Google") // Le sujet
            ->view('emails.contact-email'); // La vue
    }
}
