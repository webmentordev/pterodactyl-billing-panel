<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('app.mail_address'), config('app.mail_name')),
            subject: '🎉 Rust Servers Are Back in Stock – Get Yours Today!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
