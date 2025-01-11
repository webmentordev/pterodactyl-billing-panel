<x-mail::message>
# Refund Initiated and Server Deletion Confirmation
We have initiated the refund for your order. Please be advised that the server, along with all associated components—such as backups, databases, plugins, configurations, and any files stored via FTP—has been permanently deleted.


<code class="order">ORDERID# {{ $order->id }}</code>

The refunded amount may take up to 10 business days to appear on your statement or in the payment method used for the server purchase.

Thank you for your cooperation.  

Best Regards,  
**{{ config('app.name') }}**  
[support@rustdedicated.com](mailto:{{ config('app.mail_address') }})
</x-mail::message>
