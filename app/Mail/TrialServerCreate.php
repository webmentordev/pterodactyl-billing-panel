<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Trial;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrialServerCreate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Trial $trial, public Order $order, public $password = null, public $isNew = false, public $newPassword = null)
    {
        $this->order = $order;
        $this->password = $password;
        $this->isNew = $isNew;
        $this->newPassword = $newPassword;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('app.mail_address'), config('app.mail_name')),
            subject: '✔ Approved, Free Trial Rust Server',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.trial.approved'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
