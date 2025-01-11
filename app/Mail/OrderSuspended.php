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

class OrderSuspended extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('app.mail_address'), config('app.mail_name')),
            subject: '💥 Server suspended, not deleted!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.order.suspended'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
