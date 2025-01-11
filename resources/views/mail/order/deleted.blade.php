<x-mail::message>
# Server Cancellation Notification

Unfortunately, due to the renewal date of your server being exceeded, we were compelled to cancel your order. As a result, your server, along with all associated resources included in the package—such as databases, configurations, server resources, and files uploaded via FTP—has been deleted.

<code class="order">ORDERID# {{ $order->id }}</code>

Thank you for your understanding.  

Best regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>