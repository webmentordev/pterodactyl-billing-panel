<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public $password = null)
    {
        $this->order = $order;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('app.mail_address'), config('app.mail_name')),
            subject: '🎉 Order successfull!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.order.success',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
