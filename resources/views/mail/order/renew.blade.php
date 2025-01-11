<x-mail::message>
# Order has been renewed
We’re pleased to inform you that your Rust server has been successfully renewed, and the expiration date has been
extended.

<code class="order">ORDERID# {{ $order->id }}</code>
# Next Expire Date
<code class="date">{{ $order->expire_at->format('D d M, Y h:i:s A') }} UTC</code>


If you have any questions or need assistance, feel free to reply to this email. We're always here
to help!

See you on the battlefield!  
Best regards,  
  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>