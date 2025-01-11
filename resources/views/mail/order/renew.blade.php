<x-mail::message>
# Order Renewal Confirmation
We are pleased to inform you that your Rust server has been successfully renewed. The expiration date has been extended, ensuring uninterrupted service.

<code class="order">ORDERID# {{ $order->id }}</code>
# Next Expire Date
<code class="date">{{ $order->expire_at->format('D d M, Y h:i:s A') }} UTC</code>  

Thank you for choosing us!  

Best regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>