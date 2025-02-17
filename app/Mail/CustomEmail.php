<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $body, public $subject)
    {
        $this->body = $body;
        $this->subject = $subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('app.mail_address'), config('app.mail_name')),
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.custom-email',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
